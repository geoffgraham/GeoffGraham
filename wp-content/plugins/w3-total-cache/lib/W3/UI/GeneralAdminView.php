<?php

if (!defined('W3TC')) {
    die();
}

w3_require_once(W3TC_LIB_W3_DIR . '/UI/PluginView.php');

class W3_UI_GeneralAdminView extends W3_UI_PluginView {
    /**
     * Current page
     *
     * @var string
     */
    var $_page = 'w3tc_general';

    /**
     * General tab
     *
     * @return void
     */
    function view() {
        global $current_user;
        $config_master = $this->_config_master;
        /**
         * @var $modules W3_ModuleStatus
         */
        $modules = w3_instance('W3_ModuleStatus');

        $pgcache_enabled = $modules->is_enabled('pgcache');
        $dbcache_enabled = $modules->is_enabled('dbcache');
        $objectcache_enabled = $modules->is_enabled('objectcache');
        $browsercache_enabled = $modules->is_enabled('browsercache');
        $minify_enabled = $modules->is_enabled('minify');
        $cdn_enabled = $modules->is_enabled('cdn');
        $cloudflare_enabled = $modules->is_enabled('cloudflare');
        $varnish_enabled = $modules->is_enabled('varnish');
        $fragmentcache_enabled = $modules->is_enabled('fragmentcache');

        $enabled = $modules->plugin_is_enabled();
        $enabled_checkbox = $modules->all_modules_enabled();

        $check_rules = w3_can_check_rules();
        $check_apc = function_exists('apc_store');
        $check_eaccelerator = function_exists('eaccelerator_put');
        $check_xcache = function_exists('xcache_set');
        $check_wincache = function_exists('wincache_ucache_set');
        $check_curl = function_exists('curl_init');
        $check_memcached = class_exists('Memcache');
        $check_ftp = function_exists('ftp_connect');
        $check_tidy = class_exists('tidy');

        $disc_enhanced_enabled = !(! $check_rules || (!$this->is_master() && w3_is_network() && $config_master->get_string('pgcache.engine') != 'file_generic'));

        $can_empty_file = $modules->can_empty_file();

        $can_empty_varnish = $modules->can_empty_varnish();

        $cdn_mirror_purge = w3_cdn_can_purge_all($modules->get_module_engine('cdn'));

        $cloudflare_signup_email = '';
        $cloudflare_signup_user = '';

        if (is_a($current_user, 'WP_User')) {
            if ($current_user->user_email) {
                $cloudflare_signup_email = $current_user->user_email;
            }

            if ($current_user->user_login && $current_user->user_login != 'admin') {
                $cloudflare_signup_user = $current_user->user_login;
            }
        }

        /**
         * @var $w3_cloudflare W3_CloudFlare
         */
        $w3_cloudflare = w3_instance('W3_CloudFlare');
        $cf_options = $w3_cloudflare->get_options();
        $cloudflare_seclvls = $cf_options['sec_lvl'];
        $cloudflare_devmodes = $cf_options['dev_mode'];

        $cloudflare_rocket_loaders = $cf_options['async'];
        $cloudflare_minifications = $cf_options['minify'];

        $cloudflare_seclvl = 'med';
        $cloudflare_devmode_expire = 0;
        $cloudflare_devmode = 0;
        $cloudflare_rocket_loader = 0;
        $cloudflare_minify = 0;

        if ($cloudflare_enabled && $this->_config->get_string('cloudflare.email') && $this->_config->get_string('cloudflare.key')) {
            $settings = $w3_cloudflare->get_settings();
            $cloudflare_seclvl = $settings['sec_lvl'];
            $cloudflare_devmode_expire = $settings['devmode'];
            $cloudflare_rocket_loader = $settings['async'];
            $cloudflare_devmode = ($cloudflare_devmode_expire ? 1 : 0);
            $cloudflare_minify = $settings['minify'];
            $can_empty_cloudflare = true;
        } else {
            $can_empty_cloudflare = false;
        }

        $file_nfs = ($this->_config->get_boolean('pgcache.file.nfs') || $this->_config->get_boolean('minify.file.nfs'));
        $file_locking = ($this->_config->get_boolean('dbcache.file.locking') || $this->_config->get_boolean('objectcache.file.locking') || $this->_config->get_boolean('pgcache.file.locking') || $this->_config->get_boolean('minify.file.locking'));

        w3_require_once(W3TC_LIB_NEWRELIC_DIR . '/NewRelicWrapper.php');
        $newrelic_conf_appname = NewRelicWrapper::get_wordpress_appname($this->_config, $this->_config_master,false);
        $newrelic_applications = array();
        $nerser = w3_instance('W3_NewRelicService');

        $new_relic_installed = $nerser->module_is_enabled();
        $new_relic_running = true;
        if ($this->_config->get_boolean('newrelic.enabled')) {

            $new_relic_configured = $this->_config->get_string('newrelic.api_key') &&
                $this->_config->get_string('newrelic.account_id');

            $newrelic_prefix = '';
            if ($new_relic_configured) {
                if (w3_is_network())
                    $newrelic_prefix = $this->_config->get_string('newrelic.appname_prefix');

                try {
                    $newrelic_applications = $nerser->get_applications();
                }catch(Exception $ex) {
                }
                $newrelic_application = $this->_config->get_string('newrelic.application_id');

            }
        }

        $licensing_visible = ((!w3_is_multisite() || is_network_admin()) && 
            !ini_get('w3tc.license_key') && 
            get_transient('w3tc_license_status') != 'host_valid');

        include W3TC_INC_DIR . '/options/general.php';
    }
}
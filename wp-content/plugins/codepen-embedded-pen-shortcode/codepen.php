<?php
/*
Plugin Name: CodePen Embedded Pens Shortcode
Description: Enables shortcode to embed Pens.
Version: 0.7.1
License: GPL
Author: Chris Coyier / CodePen
Author URI: http://codepen.io
*/

function createCodePenEmbed($atts, $content = null) {

  $cp_opts = get_option('codepen_embed_options', null);

  $setting_theme_id = $cp_opts['theme_id'];
  $setting_override_theme_id = $cp_opts['override_theme_id'];

  extract(shortcode_atts(array(
    'height'       => '250',
    'theme_id'     => '0',
    'slug_hash'    => '',
    'default_tab'  => 'result',
    'animations'   => 'run',
    'preview'      => false,
    'editable'     => false,
    'version'      => '2'
  ), $atts));

  if ($setting_override_theme_id) {
    $theme_to_use = $setting_override_theme_id;
  } else {
    if ($theme_id !== 0) {
      $theme_to_use = $theme_id;
    } else if ($setting_theme_id) {
      $theme_to_use = $setting_theme_id;
    } else {
      $theme_to_use = 0;
    }
  }

  if (!$slug_hash) {

    $error = "
    <div style='padding: 10px; margin: 20px 0; text-align: center; border: 1px solid red; background: #ffebeb; border-radius: 10px;'>
      <h3 style='margin: 0 0 10px 0;'>Uh oh!</h3>
      <p style='margin: 0;'>Something is wrong with your CodePen shortcode.</p>
    </div>";

    return $error;

  } else {

    $attrs = "";
    $attrs .= " data-height='" . $height . "'";
    $attrs .= " data-theme-id='" . $theme_to_use . "'";
    $attrs .= " data-slug-hash='" . $slug_hash . "'";
    $attrs .= " data-default-tab='" . $default_tab . "'";
    $attrs .= " data-animations='" . $animations . "'";
    $attrs .= " data-editable='" . $editable . "'";
    $attrs .= " data-embed-version='" . $version . "'";

    if ($preview) {
      $attrs .= " data-preview='true'";
    }

    $content = str_replace('&#8217;', "'", html_entity_decode($content));

    $embed =  "<p class='codepen' " . $attrs . ">\n";
    $embed .=   $content . $theme_id;
    $embed .= "</p>\n";

    $embed .= '<script async src="//codepen.io/assets/embed/ei.js"></script>';

    return $embed;

  }
}

add_shortcode('codepen_embed', 'createCodePenEmbed');



// Settings Stuff

class CodePenEmbedSettingsPage {

  private $options;

  public function __construct() {
    add_action('admin_menu', array($this, 'add_cp_embed_options_page'));
    add_action('admin_init', array($this, 'page_init'));
  }

  public function add_cp_embed_options_page() {
    add_options_page(
      'CodePen Embed Settings Admin',
      'CodePen Embeds',
      'manage_options',
      'my-setting-admin',
      array($this, 'create_admin_page')
    );
  }

  public function create_admin_page() {

    $this->options = get_option('codepen_embed_options'); ?>

    <div class="wrap">

        <?php screen_icon(); ?>

        <h2>CodePen Embedded Pen Settings</h2>

        <form method="post" action="options.php">

          <?php
            settings_fields('codpen_embed_options_group');
            do_settings_sections('my-setting-admin');
            submit_button();
          ?>

        </form>

    </div>

  <?php }

  public function page_init() {
    register_setting(
      'codpen_embed_options_group',
      'codepen_embed_options',
      array($this, 'sanitize')
    );

    add_settings_section(
      'setting_section_id',
      '', // string that prints out a header
      array($this, 'print_section_info'),
      'my-setting-admin'
    );

    add_settings_field(
      'theme_id',
      'Default Theme ID',
      array($this, 'id_number_callback'),
      'my-setting-admin',
      'setting_section_id'
    );

    add_settings_field(
      'override_theme_id',
      'Override Theme ID',
      array($this, 'override_id_number_callback'),
      'my-setting-admin',
      'setting_section_id'
    );
  }

  public function sanitize($input) {
    $new_input = array();

    if (isset($input['theme_id']))
      $new_input['theme_id'] = trim($input['theme_id']);
      //$new_input['theme_id'] = absint($input['theme_id']);

    if (isset($input['override_theme_id']))
      $new_input['override_theme_id'] = trim($input['override_theme_id']);
      //$new_input['override_theme_id'] = absint($input['override_theme_id']);

    return $new_input;
  }

  public function print_section_info() {
    print ''; // prints a <p> kinda deal
  }

  public function id_number_callback() {
    printf(
      '<input type="text" id="theme_id" name="codepen_embed_options[theme_id]" value="%s" />
       <p class="description">If you leave off <code>theme_id=""</code> on the shortcode, this theme will be applied as a fallback.</p>
      ',
      isset($this->options['theme_id']) ? esc_attr( $this->options['theme_id']) : ''
    );
  }

  public function override_id_number_callback() {
    printf(
      '<input type="text" id="theme_id" name="codepen_embed_options[override_theme_id]" value="%s" />
      <p class="description">No matter what you put for <code>theme_id=""</code> on the shortcode, this theme will override it. <code>0</code> (the default) will not override the theme.</p>
      ',
      isset($this->options['override_theme_id']) ? esc_attr( $this->options['override_theme_id']) : ''
    );
  }

}

if (is_admin())
  $codepen_embed_settings_page = new CodePenEmbedSettingsPage();

?>

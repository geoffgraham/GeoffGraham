<?php
/*
Plugin Name: Prettify Code Syntax
Plugin URI: http://www.frontendmatters.com/open-source/wordpress-plugins/prettify-code-syntax/
Description: Code syntax highlighter using Google Prettify, supporting the HTML5 recommendation, and caching plugins.
Version: 1.2.1
Author: Jesús Carrera
Author URI: http://www.frontendmatters.com/
License: GPL2 or later
*/
/*  Copyright 2013  Jesús Carrera  (email : jesus.carrera@frontendmatters.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


class PrettifyCodeSyntax {
	private $plugin_id, $plugin_url;

	function __construct() {
		$this->plugin_id = 'prettify-code-syntax';
		$this->plugin_url = plugins_url($this->plugin_id);
		$this->options = get_option('prettify_code_syntax');
		$this->language_modules = array(
			'css' => 'CSS',
			'sql' => 'SQL',
			'yaml' => 'YAML', 
			'vb' => 'Visual Basic', 
			'clj' => 'Clojure', 
			'scala' => 'Scala', 
			'tex' => 'Latek (TeX, LaTeX)', 
			'wiki' => 'WikiText', 
			'erlang' => 'Erlang', 
			'go' => 'Go', 
			'hs' => 'Haskell', 
			'lua' => 'Lua', 
			'ml' => 'OCAML, SML, F#', 
			'n' => 'Nemerle', 
			'proto' => 'Protocol Buffers', 
			'vhdl' => 'CHDL (VHDL)',
			'xq' => 'XQ (XQuery)', 
			'lisp' => 'Lisp, Scheme', 
			'dart' => 'Dart', 
			'llvm' => 'Llvm', 
			'mumps' => 'Mumps', 
			'pascal' => 'Pascal', 
			'r' => 'R, S', 
			'rd' => 'RD',
			'tcl' => 'TCL',

		);

		$this->styles = array(
			'default' => 'Default',
			'desert' => 'Desert',
			'sunburst' => 'Sunburst', 
			'sons-of-obsidian' => 'Sons of Obsidian',
			'bootstrap' => 'Bootstrap'

		);

  	add_action('admin_menu', array($this, 'menu'));
		add_action('admin_init', array($this, 'register_settings'));
		add_action('admin_enqueue_scripts', array($this, 'load_admin_scripts'));

		add_action('wp_enqueue_scripts', array($this, 'load_scripts'));
		add_action('wp_enqueue_scripts', array($this, 'load_styles'), 1000);

		add_filter('the_content', array($this, 'content_filter'));
		add_filter('comment_text', array($this, 'content_filter'));

		add_action('plugins_loaded', array($this, 'load_plugin_textdomain'));
  }

  public function menu() {
  	add_options_page(__('Prettify Code Syntax Options', $this->plugin_id), __('Prettify Code Syntax', $this->plugin_id), 'manage_options', $this->plugin_id, array($this, 'options'));
  }

  public function options() {
		if ( !current_user_can( 'manage_options' ) )  {
			wp_die(__('You do not have sufficient permissions to access this page.'));
		}
		include "views/options.php";
	}

	public function register_settings() { // whitelist options
	  register_setting('pcs_settings_group', 'prettify_code_syntax', array($this, 'settings_validate'));

	  add_settings_section('pcs_languages_section', false, array($this, 'languages_section_description'), 'pcs_languages');
	  add_settings_field('pcs_languages_extra_languages_field', __('Extra Languages', $this->plugin_id), array($this, 'languages_extra_languages_field_content'), 'pcs_languages', 'pcs_languages_section');

	  add_settings_section('pcs_style_section', false, array($this, 'style_section_description'), 'pcs_style');
	  add_settings_field('pcs_style_style_field', __('Style', $this->plugin_id), array($this, 'style_style_field_content'), 'pcs_style', 'pcs_style_section');
	}

	public function settings_validate($options) {
		$file = dirname(__FILE__).'/stylesheets/custom.css';
		$custom_css = file_get_contents($file);
		if ($custom_css != $options['style_custom']) {
			file_put_contents($file, $options['style_custom']);
		}
		return $options;
	}

	public function load_scripts() {

    wp_enqueue_script('prettify', WP_PLUGIN_URL.'/'.dirname(plugin_basename(__FILE__)).'/javascripts/prettify.js', false, false, true);

    foreach ($this->language_modules as $language => $name) {
    	if (!empty($this->options['languages_'.$language])) {
	    	wp_enqueue_script('prettify-'.$language, WP_PLUGIN_URL.'/'.dirname(plugin_basename(__FILE__)).'/javascripts/lang-'.$language.'.js', array('prettify'), false, true);
	    }
    }

    wp_enqueue_script('prettify-load', WP_PLUGIN_URL.'/'.dirname(plugin_basename(__FILE__)).'/javascripts/load.js', array('prettify'), false, true);
 	} 

 	public function load_styles() {
 		if (empty($this->options['style'])) {
 			$style = 'default';
 		} else {
 			$style = $this->options['style'];
 		}
 		wp_enqueue_style('prettify', WP_PLUGIN_URL.'/'.dirname(plugin_basename(__FILE__)).'/stylesheets/'.$style.'.css', false, false, 'all');
 	}

 	public function content_filter($content) {

 		$prettify_code = false;

 		$regex = '/(<pre\s+[^>]*?class\s*?=\s*?[",\'].*?prettyprint.*?[",\'].*?>)(.*?)(<\/pre>)/si';
 		$content = preg_replace_callback($regex, array($this, 'parse_content_pre'), $content);
 		$regex = '/(<code\s+[^>]*?class\s*?=\s*?[",\']\s*?prettyprint.*?[",\'].*?>)(.*?)(<\/code>)/si';
 		// print_r($content);
 		$content = preg_replace_callback($regex, array($this, 'parse_content_code'), $content);

 		return $content;
 		
	}

	public function parse_content_pre($matches) {

		$tags_open = $matches[1];
		$code = $matches[2];
		$tags_close = $matches[3];

		$regex = '/(<code.*?>)(.*?)(<\/code>)/si';
		preg_match($regex, $code, $matches);
		if(!empty($matches)) {
			$tags_open .= $matches[1];
			$code = $matches[2];
			$tags_close = $matches[3].$tags_close;
		}

 		
 		$parsed_code = htmlspecialchars($code, ENT_NOQUOTES, get_bloginfo('charset'), true);

		$parsed_code = str_replace('&amp;#038;', '&amp;', $parsed_code);
		return $tags_open.$parsed_code.$tags_close;
	}

	public function parse_content_code($matches) {
		// print_r($matches);
		$tags_open = $matches[1];
		$code = $matches[2];
		$tags_close = $matches[3];

		$parsed_code = htmlspecialchars($code, ENT_NOQUOTES, get_bloginfo('charset'), true);
		$parsed_code = str_replace('&amp;#038;', '&amp;', $parsed_code);
		return $tags_open.$parsed_code2.$tags_close;
	}

	public function load_admin_scripts() {
		wp_enqueue_script('admin-tabs', WP_PLUGIN_URL.'/'.dirname(plugin_basename(__FILE__)).'/javascripts/admin-tabs.js', array('jquery'), false, true);
	}

	public function languages_section_description() {
		include "views/languages-section-description.php";
	}

	public function languages_extra_languages_field_content() {
		include "views/languages-extra-languages-field-content.php";
	}

	public function style_section_description() {
		include "views/style-section-description.php";
	}

	public function style_style_field_content() {
		include "views/style-style-field-content.php";
	}

	public function load_plugin_textdomain() {
  	load_plugin_textdomain($this->plugin_id, false, dirname(plugin_basename(__FILE__)).'/languages/');
  }

}

new PrettifyCodeSyntax();





















?>
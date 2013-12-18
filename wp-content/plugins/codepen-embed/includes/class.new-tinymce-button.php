<?php
/**
  * New tinyMCE Button
  *
  * Creates a new tinyMCE button for the WordPress Visual Editor
  *
  *	@since 0.1.1
  */
class new_tinymce_btn {
	// Plublic variables
	public $button_args;
	/**
	  * Class onstructor
	  *
	  * @param string Seperator $seperator
	  * @param string Button Name $btn_name
	  * @param string JavaScript URL $js_file_url
	  *
	  *	@uses init()
	  *
	  *	@return new_tinymce_btn
	  *
	  *	@since 0.1.1
	  */
	function __construct($seperator, $btn_name, $js_file_url){
	  $this->button_args = array("seperator"=>$seperator,"name"=>$btn_name, "url"=>$js_file_url);
	  add_action('init', array(&$this,'add_tinymce_button'));
	}
	/**
	  * Register New Button
	  *
	  *	@param Buttons $buttons
	  *
	  *	@global string $button_args
	  *
	  *	@return wp_add_quicktags
	  *	@return $buttons
	  *
	  *	@since 0.1.1
	  */
	public function register_new_button($buttons) {
	   array_push($buttons, $this->button_args["seperator"],$this->button_args["name"]);
	   return $buttons;
	}
	/**
	  * New tinyMCE Plugin
	  *
	  *	Creates a new tintMCE plugin
	  *
	  *	@param Plugin Array $plugin_array
	  *
	  *	@global string $button_args
	  *
	  *	@return wp_add_quicktags
	  *	@return $plugin_array
	  *
	  *	@since 0.1.1
	  */
	public function add_new_tinymce_plugin($plugin_array) {
	   $plugin_array[$this->button_args['name']] = $this->button_args['url'];
	   return $plugin_array;
	}
	/**
	  * New tinyMCE Button
	  *
	  *	Creates a new tintMCE button
	  *
	  *	@global string $button_args
	  *
	  *	@uses current_user_can()
	  *	@uses get_user_option()
	  *	@uses mce_external_plugins()
	  *	@uses mce_buttons()
	  *
	  *	@return wp_add_quicktags
	  *
	  *	@since 0.1.1
	  */
	// Creates the new tinyMCE buttons
	public function add_tinymce_button() {
		// Doesn't work if user doesn't have permisions
	   if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
		 return;
	   if ( get_user_option('rich_editing') == 'true') {
		 add_filter('mce_external_plugins', array(&$this,'add_new_tinymce_plugin'));
		 add_filter('mce_buttons', array(&$this,'register_new_button')); 
	   }
	}
}
?>
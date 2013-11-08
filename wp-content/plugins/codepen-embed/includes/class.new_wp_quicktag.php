<?php
/**
  * Add Custom Quicktags
  *
  * Add custom quicktags to the WordPress Code Editor
  *
  *	@since 0.1.1
  */
class wp_add_quicktags{
	// Plublic variables
	var $quicktags_args;
	/**
	  * Class Constructor
	  *
	  * @param string ID $id
	  * @param string Display $display
	  * @param string arg1 ID $arg1
	  * @param string arg2 ID $arg2
	  * @param string ID $access_key
	  * @param string ID $title
	  * @param string ID $title
	  * @param int ID $priority
	  * @param string ID $instance
	  *
	  *	@uses admin_print_footer_scripts()
	  *
	  *	@return wp_add_quicktags
	  *
	  *	@since 0.1.1
	  */
	function __construct(	$id = false,
							$display= false,
							$arg1= false,
							$arg2= false,
							$access_key= false,
							$title= false,
							$priority= false,
							$instance= false
						) {
		// Create and array from the class parameters
		$this->quicktags_args = array(	"id" => $id,
										"display" => $display,
										"arg1" => $arg1,
										"arg2" => $arg2,
										"access_key" => $access_key,
										"title" => $title,
										"priority" => $priority,
										"instance" => $instance);
		// Initate add_quicktags() function
		add_action( 'admin_print_footer_scripts',array(&$this,'add_quicktags'));
	}
	/**
	  * Add Quicktags
	  *
	  * Outputs the JavaScript used to create a custom quicktag
	  *
	  *	@global string $quicktags_args
	  *
	  *	@return wp_add_quicktags
	  *
	  *	@since 0.1.1
	  */
	public function add_quicktags() {
		// Output the JavaScript
		ob_start();?>
			<script type="text/javascript">
				QTags.addButton( '<?php echo $this->quicktags_args['id']; ?>','<?php echo $this->quicktags_args['display']; ?>','<?php echo $this->quicktags_args['arg1']; ?>','<?php echo $this->quicktags_args['arg2']; ?>','<?php echo $this->quicktags_args['access_key']; ?>','<?php echo $this->quicktags_args['title']; ?>','<?php echo $this->quicktags_args['priority']; ?>','<?php echo $this->quicktags_args['instance']; ?>');
			</script>
		<?php echo ob_get_clean();
	}
}
?>
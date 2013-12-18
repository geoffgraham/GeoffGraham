<div class="wrap">
	<?php screen_icon(); ?>
	<h2><?php _e('Prettify Code Syntax', $this->plugin_id) ?></h2>
	<form method="post" action="options.php"> 
		<?php settings_fields( 'pcs_settings_group' ); ?>
		<div class="plugin-tabs">
			<h2 class="nav-tab-wrapper">
				<a class="nav-tab nav-tab-active" href="#pcs-section-languages"><?php _e('Languages', $this->plugin_id) ?></a>
				<a class="nav-tab" href="#pcs-section-style"><?php _e('Style', $this->plugin_id) ?></a>
			</h2>
			<div class="content-tab content-tab-active" id="pcs-section-languages">
				<?php do_settings_sections( 'pcs_languages'); ?>
			</div>
			<div class="content-tab" id="pcs-section-style">
				<?php do_settings_sections( 'pcs_style'); ?>
			</div>	
		</div>
		<?php submit_button(); ?>
	</form>
</div>
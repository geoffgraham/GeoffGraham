<?php
################################################################################
// CUSTOM POST TYPES
// Register post types and taxonomies
// @Portfolio
// @Testimony
// @Misc. Custom Post Type Magic
################################################################################

// Register Portfolio Posts
if ( ! function_exists( 'bta_add_portfolio' ) ) {
	function bta_add_portfolio() {
	
		global $bta_options;
	
		// "Portfolio" Custom Post Type
		$labels = array(
			'name' => _x( 'Portfolio', 'post type general name' ),
			'singular_name' => _x( 'Portfolio Item', 'post type singular name' ),
			'add_new' => _x( 'Add New' ),
			'add_new_item' => __( 'Add New Portfolio Item' ),
			'edit_item' => __( 'Edit Portfolio Item' ),
			'new_item' => __( 'New Portfolio Item' ),
			'view_item' => __( 'View Portfolio Item' ),
			'search_items' => __( 'Search Portfolio' ),
			'not_found' =>  __( 'No portfolio items found' ),
			'not_found_in_trash' => __( 'No portfolio items found in Trash' ), 
			'parent_item_colon' => ''
		);
		
		$portfolioitems_rewrite = get_option( 'bta_portfolioitems_rewrite' );
 		if( empty( $portfolioitems_rewrite ) ) { $portfolioitems_rewrite = 'portfolio'; }
		
		$args = array(
			'labels' => $labels,
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true, 
			'query_var' => true,
			'rewrite' => array( 'slug' => $portfolioitems_rewrite ),
			'capability_type' => 'post',
			'hierarchical' => true,
			'menu_position' => null, 
			'has_archive' => true, 
			'taxonomies' => array( 'portfolio-clients' ), 
			'supports' => array( 'title','editor','thumbnail' )
		);
		
		register_post_type( 'portfolio', $args );
		
		// "Work" Custom Taxonomy. Allows work to be grouped together.
		$labels = array(
			'name' => _x( 'Work Type', 'taxonomy general name' ),
			'singular_name' => _x( 'Work', 'taxonomy singular name' ),
			'search_items' =>  __( 'Work' ),
			'all_items' => __( 'All Work' ),
			'parent_item' => __( 'Parent Work Type' ),
			'parent_item_colon' => __( 'Parent Work Type:' ),
			'edit_item' => __( 'Edit Work Type' ), 
			'update_item' => __( 'Update Work Type' ),
			'add_new_item' => __( 'Add New Work Type' ),
			'new_item_name' => __( 'New Work Type' ),
			'menu_name' => __( 'Work Types' )
		); 	
		
		$args = array(
			'hierarchical' => true,
			'labels' => $labels,
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'work' )
		);
		
		register_taxonomy( 'work', array( 'portfolio' ), $args );
		
		// "Client" Custom Taxonomy. Designates a speaker for a particular portfolio post.
		$labels = array(
			'name' => _x( 'Clients', 'taxonomy general name' ),
			'singular_name' => _x( 'Client', 'taxonomy singular name' ),
			'search_items' =>  __( 'Client' ),
			'all_items' => __( 'All Clients' ),
			'parent_item' => __( 'Parent Client' ),
			'parent_item_colon' => __( 'Parent Client:' ),
			'edit_item' => __( 'Edit Client' ), 
			'update_item' => __( 'Update Client' ),
			'add_new_item' => __( 'Add New Client' ),
			'new_item_name' => __( 'New Client' ),
			'menu_name' => __( 'Clients' )
		); 	
		
		$args = array(
			'hierarchical' => true,
			'labels' => $labels,
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'clients' )
		);
		
		register_taxonomy( 'clients', array( 'portfolio' ), $args );
		
		// Add Meta Boxes for custom Portfolio data
		add_action( 'add_meta_boxes', 'add_portfolio_metaboxes' );
		// Add the Website Link Meta Boxes
		function add_portfolio_metaboxes() {
    	add_meta_box('portfolio_link', 'Hero Section Stuff', 'portfolio_link', 'portfolio', 'normal', 'low');
		}
		
		// The Portfolio Media Metabox
		function portfolio_link() {
   		global $post;
    
    	// Noncename needed to verify where the data originated
    	echo '<input type="hidden" name="portfoliometa_noncename" id="portfoliometa_noncename" value="' .
    	wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
    	
    	// Get the data if its already been entered
    	$subhead = get_post_meta($post->ID, '_subhead', true);
    	$summary = get_post_meta($post->ID, '_summary', true);
      $site = get_post_meta($post->ID, '_site', true);
    	$link = get_post_meta($post->ID, '_link', true);
    
    	// Echo out the field
    	echo '<p>Enter a catchy subhead:</p>';
    	echo '<input type="text" name="_subhead" value="' . $subhead  . '" class="widefat" />';
    	echo '<p>Enter the summary for this project:</p>';
    	echo '<textarea name="_summary" style="height:200px;" class="widefat" />'. $summary  .'</textarea>';
    	echo '<p>The URL for the site, if available</p>';
    	echo '<input type="text" name="_site" value="' . $site  . '" class="widefat" />';
    	echo '<p>The URL for the image flushed to the right of the summary.</p>';
    	echo '<input type="text" name="_link" value="' . $link  . '" class="widefat" />';
		}	
		
		// Save the Metabox Data
		function bta_save_portfolio_meta($post_id, $post) {
    	// verify this came from the our screen and with proper authorization,
    	// because save_post can be triggered at other times
    	if ( !wp_verify_nonce( $_POST['portfoliometa_noncename'], plugin_basename(__FILE__) )) {
    	return $post->ID;
    	}
    
    	// Is the user allowed to edit the post or page?
    	if ( !current_user_can( 'edit_post', $post->ID ))
        return $post->ID;
    	// OK, we're authenticated: we need to find and save the data
    	// We'll put it into an array to make it easier to loop though.
    	$portfolio_meta['_subhead'] = $_POST['_subhead'];
    	$portfolio_meta['_summary'] = $_POST['_summary'];
    	$portfolio_meta['_site'] = $_POST['_site'];
    	$portfolio_meta['_link'] = $_POST['_link'];
    	// Add values of $events_meta as custom fields
    	foreach ($portfolio_meta as $key => $value) { // Cycle through the $portfolio_meta array!
        if( $post->post_type == 'revision' ) return; // Don't store custom data twice
        $value = implode(',', (array)$value); // If $value is an array, make it a CSV (unlikely)
        if(get_post_meta($post->ID, $key, FALSE)) { // If the custom field already has a value
            update_post_meta($post->ID, $key, $value);
        } else { // If the custom field doesn't have a value
            add_post_meta($post->ID, $key, $value);
        }
        if(!$value) delete_post_meta($post->ID, $key); // Delete if blank
    	}
		}
		add_action('save_post', 'bta_save_portfolio_meta', 1, 2); // save the custom fields
		$portfolio_meta['_subhead'] = $_POST['_subhead'];
		$portfolio_meta['_summary'] = $_POST['_summary'];
		$portfolio_meta['_site'] = $_POST['_site'];
		$portfolio_meta['_link'] = $_POST['_link'];
	}
	
	add_action( 'init', 'bta_add_portfolio' );
}

// Register Testimony Posts
if ( ! function_exists( 'bta_add_testimony' ) ) {
	function bta_add_testimony() {
	
		global $bta_options;
	
		// "Testimony" Custom Post Type
		$labels = array(
			'name' => _x( 'Testimony', 'post type general name' ),
			'singular_name' => _x( 'Testimony Item', 'post type singular name' ),
			'add_new' => _x( 'Add New' ),
			'add_new_item' => __( 'Add New Testimony Item' ),
			'edit_item' => __( 'Edit Testimony Item' ),
			'new_item' => __( 'New Testimony Item' ),
			'view_item' => __( 'View Testimony Item' ),
			'search_items' => __( 'Search Testimony' ),
			'not_found' =>  __( 'No testimony items found' ),
			'not_found_in_trash' => __( 'No testimony items found in Trash' ), 
			'parent_item_colon' => ''
		);
		
		$testimonyitems_rewrite = get_option( 'bta_testimonyitems_rewrite' );
 		if( empty( $testimonyitems_rewrite ) ) { $testimonyitems_rewrite = 'testimony'; }
		
		$args = array(
			'labels' => $labels,
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true, 
			'query_var' => true,
			'rewrite' => array( 'slug' => $testimonyitems_rewrite ),
			'capability_type' => 'post',
			'hierarchical' => true,
			'menu_position' => null, 
			'has_archive' => true, 
			'taxonomies' => array( 'testimony-clients' ), 
			'supports' => array( 'title','editor','thumbnail' )
		);
		
		register_post_type( 'testimony', $args );
		
		// "Client" Custom Taxonomy. Designates a client for a particular Testimony post.
		$labels = array(
			'name' => _x( 'Clients', 'taxonomy general name' ),
			'singular_name' => _x( 'Client', 'taxonomy singular name' ),
			'search_items' =>  __( 'Client' ),
			'all_items' => __( 'All Clients' ),
			'parent_item' => __( 'Parent Client' ),
			'parent_item_colon' => __( 'Parent Client:' ),
			'edit_item' => __( 'Edit Client' ), 
			'update_item' => __( 'Update Client' ),
			'add_new_item' => __( 'Add New Client' ),
			'new_item_name' => __( 'New Client' ),
			'menu_name' => __( 'Clients' )
		); 	
		
		$args = array(
			'hierarchical' => true,
			'labels' => $labels,
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'clients' )
		);
		
		register_taxonomy( 'clients', array( 'testimony' ), $args );
		
		// Add Meta Boxes for custom testimony data
		add_action( 'add_meta_boxes', 'add_testimony_metaboxes' );
		// Add the Website Link Meta Boxes
		function add_testimony_metaboxes() {
    	add_meta_box('testimony_link', 'Testimony Meta', 'testimony_link', 'testimony', 'normal', 'low');
		}
		
		// The testimony Media Metabox
		function testimony_link() {
   		global $post;
    
    	// Noncename needed to verify where the data originated
    	echo '<input type="hidden" name="testimonymeta_noncename" id="testimonymeta_noncename" value="' .
    	wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
    	
    	// Get the data if its already been entered
      $image = get_post_meta($post->ID, '_image', true);
    	$link = get_post_meta($post->ID, '_link', true);
    
    	// Echo out the field
    	echo '<p>The URL for the client\'s photo</p>';
    	echo '<input type="text" name="_image" value="' . $image  . '" class="widefat" />';
    	echo '<p>The URL for the client, such as Twitter or something else.</p>';
    	echo '<input type="text" name="_link" value="' . $link  . '" class="widefat" />';
		}	
		
		// Save the Metabox Data
		function bta_save_testimony_meta($post_id, $post) {
    	// verify this came from the our screen and with proper authorization,
    	// because save_post can be triggered at other times
    	if ( !wp_verify_nonce( $_POST['testimonymeta_noncename'], plugin_basename(__FILE__) )) {
    	return $post->ID;
    	}
    
    	// Is the user allowed to edit the post or page?
    	if ( !current_user_can( 'edit_post', $post->ID ))
        return $post->ID;
    	// OK, we're authenticated: we need to find and save the data
    	// We'll put it into an array to make it easier to loop though.
    	$testimony_meta['_image'] = $_POST['_image'];
    	$testimony_meta['_link'] = $_POST['_link'];
    	// Add values of $events_meta as custom fields
    	foreach ($testimony_meta as $key => $value) { // Cycle through the $testimony_meta array!
        if( $post->post_type == 'revision' ) return; // Don't store custom data twice
        $value = implode(',', (array)$value); // If $value is an array, make it a CSV (unlikely)
        if(get_post_meta($post->ID, $key, FALSE)) { // If the custom field already has a value
            update_post_meta($post->ID, $key, $value);
        } else { // If the custom field doesn't have a value
            add_post_meta($post->ID, $key, $value);
        }
        if(!$value) delete_post_meta($post->ID, $key); // Delete if blank
    	}
		}
		add_action('save_post', 'bta_save_testimony_meta', 1, 2); // save the custom fields
		$testimony_meta['_image'] = $_POST['_image'];
		$testimony_meta['_link'] = $_POST['_link'];
	}
	
	add_action( 'init', 'bta_add_testimony' );
}

// Misc. Custom Post Type Magic
/* -------------------------------------------------------------------------- */
 
// Get taxonomies terms links
function custom_taxonomies_terms_links() {
	global $post, $post_id;
	// get post by post id
	$post = &get_post($post->ID);
	// get post type by post
	$post_type = $post->post_type;
	// get post type taxonomies
	$taxonomies = get_object_taxonomies($post_type);
	foreach ($taxonomies as $taxonomy) {
		// get the terms related to post
		$terms = get_the_terms( $post->ID, $taxonomy );
		if ( !empty( $terms ) ) {
			$out = array();
			foreach ( $terms as $term )
				$out[] = '<a href="' .get_term_link($term->slug, $taxonomy) .'">'.$term->name.'</a>';
			$return = join( ', ', $out );
		}
		return $return;
	}
}
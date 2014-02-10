<?php
/**
 * WORDPRESS THUMBNAILS
 * Remove thumbnail images from post archives
 * ----------------------------------------------------------------------------
 */

add_filter('intermediate_image_sizes_advanced','stop_thumbs');
function stop_thumbs($sizes){
      return array();
}
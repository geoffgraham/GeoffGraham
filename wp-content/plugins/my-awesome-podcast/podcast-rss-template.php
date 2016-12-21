<?php
/*
Template Name: Podcast RSS
*/

// Query the Podcast Custom Post Type and fetch the latest 100 posts
$args = array( 'post_type' => 'podcasts', 'posts_per_page' => 100 );
$loop = new WP_Query( $args );

// Output the XML header
header('Content-Type: '.feed_content_type('rss-http').'; charset='.get_option('blog_charset'), true);
echo '<?xml version="1.0" encoding="'.get_option('blog_charset').'"?'.'>';
?>

<?php // Start the iTunes RSS Feed: https://www.apple.com/itunes/podcasts/specs.html ?>
<rss xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd" version="2.0">
  
  <?php 
    // The information for the podcast channel 
    // Mostly using get_bloginfo() here, but these can be custom tailored, as needed
  ?>
  <channel>
    <title><?php echo get_bloginfo('name'); ?></title>
    <link><?php echo get_bloginfo('url'); ?></link>
    <language><?php echo get_bloginfo ( 'language' ); ?></language>
    <copyright><?php echo date('Y'); ?> <?php echo get_bloginfo('name'); ?></copyright>
    
    <itunes:author><?php echo get_bloginfo('name'); ?></itunes:author>
    <itunes:summary><?php echo get_bloginfo('description'); ?></itunes:summary>
    <description><?php echo get_bloginfo('url'); ?></description>
    
    <itunes:owner>
      <itunes:name><?php echo get_bloginfo('name'); ?></itunes:name>
      <itunes:email><?php echo get_bloginfo('admin_email'); ?></itunes:email>
    </itunes:owner>
    
    <itunes:image href="http://your-site.com/path/to/podcast/image.png" />
    
    <itunes:category text="Technology">
      <itunes:category text="Tech News"/>
    </itunes:category>
    
    <?php // Start the loop for Podcast posts
    while ( $loop->have_posts() ) : $loop->the_post(); ?>
    <item>
      <title><?php the_title_rss(); ?></title>
      <itunes:author><?php echo get_bloginfo('name'); ?></itunes:author>
      <itunes:summary><?php the_excerpt_rss(); ?></itunes:summary>
      <?php // Retrieve just the URL of the Featured Image: http://codex.wordpress.org/Function_Reference/wp_get_attachment_image_src
      if (has_post_thumbnail( $post->ID ) ): ?>
        <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); ?>
        <itunes:image href="<?php echo $image[0]; ?>" />
      <?php endif; ?>
      
      <?php // Get the file field URL and filesize
     		$attachment_id = get_field('podcast_file');
    		$fileurl = wp_get_attachment_url( $attachment_id );
    		$filesize = filesize( get_attached_file( $attachment_id ) );
     	?>
      
      <enclosure url="<?php echo $fileurl; ?>" length="<?php echo $filesize; ?>" type="audio/mpeg" />
      <guid><?php echo $fileurl; ?></guid>
      <pubDate><?php the_time( 'D, d M Y G:i:s T') ?></pubDate>
      <itunes:duration><?php the_field('podcast_duration'); ?></itunes:duration>
    </item>
    <?php endwhile; ?>
  
  </channel>

</rss>
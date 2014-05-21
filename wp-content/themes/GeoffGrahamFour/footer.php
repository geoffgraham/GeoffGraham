<?php
/**
 * @package WordPress
 * @subpackage GeoffGrahamFour
 * @since GeoffGrahamFour 1.0
 */
?>

<?php include ('sidebar-email-newsletter.php'); ?>

<footer>
  <div class="wrapper">
    <a href="#" class="back-to-top" aria-hidden="true" data-icon="&#xe008;"></a>
    <div class="copyright">
      &copy; <?php bloginfo('name'); ?>
    </div>
    <nav class="footer" role="navigation">
      <?php wp_nav_menu( array('menu' => 'primary') ); ?>
    </nav>
    <nav class="footer" role="social">
      <ul>
        <li>
          <a alt="Follow Geoff Graham on Twitter" href="http://twitter.com/geoffreygraham" aria-hidden="true" data-icon="&#xe000;" onClick="_gaq.push(['_trackEvent', 'Social', 'Click', 'Twitter', 1, false]);"></a>
        </li>
        <li>
          <a alt="See Geoff Graham on LinkedIn" href="http://www.linkedin.com/in/geoffreyjgraham" aria-hidden="true" data-icon="&#xe001;" onClick="_gaq.push(['_trackEvent', 'Social', 'Click', 'LinkedIn', 1, false]);"></a>
        </li>
        <li>
          <a alt="Check out Geoff Graham on Codepen" href="https://codepen.io/geoffgraham" aria-hidden="true" data-icon="&#xe002;" onClick="_gaq.push(['_trackEvent', 'Social', 'Click', 'CodePen', 1, false]);"></a>
        </li>
        <li>
          <a alt="Subscribe to Geoff Graham Blog RSS" href="<?php bloginfo('rss_url'); ?>" aria-hidden="true" data-icon="&#xe004;" onClick="_gaq.push(['_trackEvent', 'Social', 'Click', 'RSS', 1, false]);"></a>
        </li>
      </ul>
    </nav>
  </div><!-- wrapper -->
</footer>

</div>

<?php wp_footer(); ?>

<?php // Initialize scripts conditionally

if ( is_front_page() ) {	
echo '<script>';
  echo '$(".hero h1").fitText(1.0, { minFontSize: "30px", maxFontSize: "75px" });';
  echo '$(".hero h2").fitText(1.0, { minFontSize: "20px", maxFontSize: "45px" });';
  echo '$(".hero h1").lettering();';
echo '</script>';
}

if ( is_single() ) {
echo '<script>';
  echo '$("h1").fitText(1.0, { minFontSize: "24px", maxFontSize: "100px" });';
  echo '$("h1").lettering();';
  echo '$("h1").lettering("words");';
	echo '$("h1").lettering("words").children("span").lettering();';
  echo '$(".module").fitVids();';
echo '</script>';
}

if ( is_page_template( 'contact.php' ) || is_post_type_archive('portfolio') ) {
echo '<script>';
  echo '$("h1").fitText(1.0, { minFontSize: "65px", maxFontSize: "200px" });';
  echo '$("h1").lettering();';
echo '</script>';
}

if ( is_page_template( 'about.php' ) || is_page( 'progress' )  ) {
echo '<script>';
  echo '$("h1").fitText(1.0, { minFontSize: "24px", maxFontSize: "100px" });';
  echo '$("h1").lettering();';
echo '</script>';
}

if ( is_404() ) {
echo '<script>';
  echo '$("h1").fitText(1.0, { minFontSize: "25px", maxFontSize: "300px" });';
  echo '$("h1").lettering();';
echo '</script>';
}

?>

<?php // Google Analytics ?>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', <?php if (true == of_get_option('meta_google_analytics_id')) {
	  echo '"'.of_get_option("meta_google_analytics_id").'"';
	} ?>, <?php if (true == of_get_option('meta_google_analytics_property')) {
	  echo '"'.of_get_option("meta_google_analytics_property").'"';
	} ?>);
  ga('send', 'pageview');

</script>
	
</body>

</html>

<?php
/**
 * @package WordPress
 * @subpackage GeoffGrahamFour
 * @since GeoffGrahamFour 1.0
 */
?>

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
          <a alt="Follow Geoff Graham on Twitter" href="http://twitter.com/geoffreygraham" aria-hidden="true" data-icon="&#xe000;"></a>
          </li>
        <li>
          <a alt="See Geoff Graham on LinkedIn" href="http://www.linkedin.com/in/geoffreyjgraham" aria-hidden="true" data-icon="&#xe001;"></a>
        </li>
        <li>
          <a alt="Check out Geoff Graham on Codepen" href="https://codepen.io/geoffgraham" aria-hidden="true" data-icon="&#xe002;"></a>
        </li>
        <li>
          <a alt="Subscribe to Geoff Graham Blog RSS" href="<?php bloginfo('rss_url'); ?>" aria-hidden="true" data-icon="&#xe004;"></a>
        </li>
      </ul>
    </nav>
  </div><!-- wrapper -->
</footer>

	</div>

	<?php wp_footer(); ?>

<!-- Google Analytics -->
	 
<script>

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-XXXXXX-XX']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'stats.g.doubleclick.net/dc.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
	
</body>

</html>

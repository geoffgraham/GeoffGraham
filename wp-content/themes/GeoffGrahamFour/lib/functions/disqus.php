<?php
/**
 * DISQUS
 * Adds Google Analytics event tracking to the Disqus plugin.
 * ----------------------------------------------------------
 */

function hook_disqus_config(){

if( ! is_singular() ) return;

?>
<script type="text/javascript">
    function disqus_config() {
        this.callbacks.onNewComment = [function(comment) {
            ga('send', 'event', 'Disqus', 'New Comment', comment.id);
        }];
    }
</script>
<?php   
}

add_action( 'wp_footer', 'hook_disqus_config' );
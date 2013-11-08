<form action="<?php bloginfo('siteurl'); ?>" id="searchform" method="get">
    <div>
        <label for="s" class="screen-reader-text"><?php _e('Search for:','geoffgraham'); ?></label>
        <input type="search" id="s" name="s" value="" />
        
        <input type="submit" value="<?php _e('Search','geoffgraham'); ?>" id="searchsubmit" />
    </div>
</form>
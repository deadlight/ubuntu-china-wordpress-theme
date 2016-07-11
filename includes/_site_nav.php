<?php
$current_tax = basename(get_permalink());
?>
<ul class="main-nav topic-nav no-bullets">
    <li class="<?php //if ( $current_tax == "" ) : echo ' active'; endif; ?>">
        <a href="/phone-and-tablet">Ubuntu手机和平板电脑</a><?/* Phone and tablet */ ?>
    </li>
    <li class="<?php //if ( $current_tax == "" ) : echo ' active'; endif; ?>">
        <a href="/internet-of-things">IoT</a><?/* IoT */ ?>
    </li>
    <li class="<?php //if ( $current_tax == "" ) : echo ' active'; endif; ?>">
        <a href="/kylin">Ubuntu Kylin</a><?/* Ubuntu Kylin */ ?>
    </li>
    <li class="<?php //if ( $current_tax == "" ) : echo ' active'; endif; ?>">
        <a href="/cloud-and-server">Ubuntu 云</a><?/* Ubuntu cloud */ ?>
    </li>
    <li class="<?php //if ( $current_tax == "" ) : echo ' active'; endif; ?>">
        <a href="/videos">Videos</a><?/* Videos */ ?>
    </li>
</ul>

<form class="header-search" method="get" action="<?php bloginfo('url'); ?>/">
    <label class="off-left" for="s"><?php _e('Search:'); ?></label>
    <input class="form-text" type="search" autocomplete="off" placeholder="Search" name="s" id="s" />
    <button type="submit"><img src="//assets.ubuntu.com/sites/ubuntu/1218/u/img/search-white.svg" alt="Search" height="28" /></button>
</form>

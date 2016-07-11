<?php
// Add default posts and comments RSS feed links to <head>.
add_theme_support( 'automatic-feed-links' );
// end add default posts and comments RSS feed links to <head>.

function myFeedExcluder($query) {
 if ($query->is_feed) {
   $query->set('cat','-1554,-1551,-1552,-1553,-344,-347,-346,-345');
 }
return $query;
}
add_filter('pre_get_posts','myFeedExcluder');
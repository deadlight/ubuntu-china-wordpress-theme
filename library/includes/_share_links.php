<?php
	$post_type = get_post_type_object( get_post_type($post));
	$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
	$cat_name = get_category(get_query_var('cat'))->name;
?>
<div id="share">
	<div> 
		<h2>Share 
		<?php if(is_single() ) : ?>this <?php if('post' == get_post_type()) : ?>article<?php endif;?><?php if('event' == get_post_type()) : ?>event<?php endif;?><?php if('e-book' == get_post_type()) : ?>e-book<?php endif;?><?php echo $post_type->labels->title_friendly; ?><?php elseif (is_home()) : ?>this website<?php elseif (is_search()) : ?> these search results
		<?php else : ?>this page<?php endif; ?>:
		</h2>
		<ul class="no-bullets">
			<li>
				<a id="share-facebook" class="share" href="http://www.facebook.com/sharer.php?s=100&amp;p[url]=<?php echo urlencode( the_permalink( $post->ID ) ); ?>&p[title]=<?php echo urlencode(the_title()); ?>&amp;p[summary]=<?php echo urlencode(get_excerpt()); ?>&amp;p%5Bimages%5D%5B0%5D=<?php $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array( 300,300 ), false, '' ); echo $src[0]; ?>?utm_source=<?php the_title(); ?>&amp;utm_medium=external+link&amp;utm_content=facebook+share+link">Facebook</a>	
			</li>
			<li>
				<a id="share-twitter" class="share" href="http://twitter.com/share?text=<?php if(is_single() ) : ?><?php echo urlencode(the_title()); ?><?php else : ?><?php single_tag_title(); ?><?php endif ; ?>&url=<?php if(is_single() ) : ?><?php echo urlencode( wp_get_shortlink( $post->ID ) ); ?><?php else : ?><?php echo "http://" . $_SERVER['HTTP_HOST']  . $_SERVER['REQUEST_URI']; ?><?php endif; ?>&hashtags=ubuntu?utm_source=<?php the_title(); ?>&amp;utm_medium=external+link&amp;utm_content=twitter+share+link" title="Share on Twitter" rel="nofollow">Twitter</a>
			</li>
			<li>
				<a id="share-googleplus" class="share" href="https://plus.google.com/share?url=<?php urlencode(wp_get_shortlink());?>?utm_source=<?php the_title(); ?>&amp;utm_medium=external+link&amp;utm_content=google+share+link">Google+</a>
			</li>
			<li>
				<a id="share-email" class="share" title="Share '<?php the_title(); ?>' via Email" href="mailto:?subject=Saw%20this%20and%20thought%20of%20you&amp;body=
				<?php if(is_single() ) : ?>
					I've just read '<?php single_post_title(); ?>' on the Ubuntu Resources website and thought you would like it. Check it out: <?php the_permalink(); ?>
				<?php elseif( is_tax('topic') ) : ?>
					I've just visited the '<?php single_tag_title(); ?>' section on the Ubuntu Resources website and thought you would like it. Check it out: <?php echo "http://" . $_SERVER['HTTP_HOST']  . $_SERVER['REQUEST_URI']; ?>
				<?php elseif(is_home() ): ?>
					I've just visited the Ubuntu Resources website and thought you would like it. Check it out: <?php bloginfo('url'); ?>
				<?php elseif (is_search()) : ?>
					I've just searched for '<?php /* Search Count */ $allsearch = &new WP_Query("s$s&showposts=-1"); $key = wp_specialchars($s, 1); $count = $allsearch->post_count; _e(''); _e(''); echo $key; _e(''); 
	?>' on the Ubuntu Resources website and thought I'd share the results with you. Check them out: <?php echo "http://" . $_SERVER['HTTP_HOST']  . $_SERVER['REQUEST_URI']; ?>
				<?php else : ?>
					I've just visited the '<?php single_tag_title(); ?>' section on the Ubuntu Resources website and thought you would like it. Check it out: <?php echo "http://" . $_SERVER['HTTP_HOST']  . $_SERVER['REQUEST_URI']; ?>
				<?php endif; ?>&amp;utm_source=<?php the_title(); ?>&amp;utm_medium=external+link&amp;utm_content=facebook+share+link">Email</a>
			</li>
		</ul>
	</div>
</div><!-- /#share -->

<!--<script>
// create social networking pop-ups
(function() {
    // link selector and pop-up window size
    var Config = {
        Link: "a.share",
        Width: 500,
        Height: 500
    };
 
    // add handler links
    var slink = document.querySelectorAll(Config.Link);
    for (var a = 0; a < slink.length; a++) {
        slink[a].onclick = PopupHandler;
    }
 
    // create popup
    function PopupHandler(e) {
 
        e = (e ? e : window.event);
        var t = (e.target ? e.target : e.srcElement);
 
        // popup position
        var
            px = Math.floor(((screen.availWidth || 1024) - Config.Width) / 2),
            py = Math.floor(((screen.availHeight || 700) - Config.Height) / 2);
 
        // open popup
        var popup = window.open(t.href, "social", 
            "width="+Config.Width+",height="+Config.Height+
            ",left="+px+",top="+py+
            ",location=0,menubar=0,toolbar=0,status=0,scrollbars=1,resizable=1");
        if (popup) {
            popup.focus();
            if (e.preventDefault) e.preventDefault();
            e.returnValue = false;
        }
 
        return !!popup;
    }
 
}());
</script>-->
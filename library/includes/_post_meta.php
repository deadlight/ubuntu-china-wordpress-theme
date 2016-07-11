<p class="article-meta"><time datetime="<?php the_time('Y-m-d') ?>" ><?php the_time('j') ?><?php the_time(' F Y') ?>,</time> by <a href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>" title="View <?php if(get_the_author_meta('first_name',$uid)): ?><?php the_author_meta('first_name',$uid); ?><?php else : ?><?php the_author_meta('display_name',$uid); ?><?php endif; ?>'s bio and posts"><span><?php the_author_meta('first_name',$uid); ?> <?php the_author_meta('last_name',$uid); ?></span></a></p>
<!-- <?php if(get_the_author_meta('user_photo', $uid)): ?>	
    <img src="<?php bloginfo('url'); ?>/wp-content/uploads/<?php the_author_meta('user_photo',$uid); ?>" alt="<?php the_author_meta('first_name',$uid); ?>'s photo" class="avatar avatar-140 photo" width="70" height="70" />
  <?php else : ?>
    	<?php echo get_avatar( get_the_author_meta('user_email'), 48 ); ?>
<?php endif; ?> -->

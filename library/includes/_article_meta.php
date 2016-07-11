<div class="article-meta">
	<ul class="no-bullets">
		<?
			$category = get_the_category(); 
			if (!($cat->cat_name=='featured')) echo '<li><a href="'.get_category_link($category[0]->term_id ).'" title="View all '.$category[0]->cat_name.' posts">'.$category[0]->cat_name.'</a></li>';
		?>
		<?php echo get_the_term_list( $post->ID, 'topic', '<li class="test">', '</li><li>', '</li>' ); ?>
	
	<!--<?php 
		if (get_post_type() == 'post'): 
			echo '<li><a href="/news">News</a></li>'; 
		else : 
			$post_type = get_post_type_object(get_post_type($post)); 
			echo '<li><a href="">' .$post_type->labels->singular_name. '</a></li>';
		endif; 
	?>-->
	</ul>
	<p class="article-meta"><?php $atr=get_the_author_ID(); if ($atr != 12): ?>
		<?php if (get_post_type() != 'event') : ?>
		<time datetime="<?php the_time('Y-m-d') ?>">
			<?php the_time('j') ?><?php the_time(' F Y') ?>
		</time>
		<?php endif; ?> 
	<?php endif; ?> 
	</p>
</div><!-- /.article-meta -->
		<div class="single-post-cats">
		<h2 class="accessibility-aid">Posted under:</h2>
			<?php if(is_single() ) : ?>
				<?php get_template_part("library/includes/_post_cats"); ?>
			<?php elseif ( is_home() || is_page( 'Webinars' ) || is_author() || is_search() ) : ?>
			<?php else : ?>
				<?php $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); ?> <span><?php single_cat_title(); ?></span>
			<?php endif; ?>
		</div>

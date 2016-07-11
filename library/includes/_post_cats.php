					<ul class="no-bullets clearfix inline smaller">
							<?php
							foreach((get_the_category()) as $category) {
							    if (($category->cat_name != 'Featured') && ($category->cat_name != 'E-book') && ($category->cat_name != 'Gated')) { ?>
							    	<li><a href="<?php echo get_category_link( $category->term_id ); ?>?utm_source=<?php the_title(); ?>&amp;utm_medium=internal+link&amp;utm_content=<?php echo $category->name; ?>"><?php echo $category->name; ?></a></li>
							    <?php	}
							    }
							?>	
						<?php
						$terms = wp_get_post_terms( get_the_ID(), 'topic');
						foreach ($terms as $term) {
						//Always check if it's an error before continuing. get_term_link() can be finicky sometimes
						$term_link = get_term_link( $term, 'topic' );
						if( is_wp_error( $term_link ) )
						continue;?>
							<li><a href="<?php echo $term_link; ?>?utm_source=<?php the_title(); ?>&amp;utm_medium=internal+link&amp;utm_content=<?php echo $category->name; ?>"><?php echo $term->name; ?></a></li>
						<?php } ?>
						</ul>

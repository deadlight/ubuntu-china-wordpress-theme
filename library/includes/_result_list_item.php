<?php if ( is_search() ) : ?>
<?php $title = get_the_title(); $keys= explode(" ",$s); $title = preg_replace('/('.implode('|', $keys) .')/iu', '<strong class="search-term">\0</strong>', $title); ?>
<?php $excerpt = get_the_excerpt(); $keys= explode(" ",$s); $excerpt = preg_replace('/('.implode('|', $keys) .')/iu', '<strong class="search-term">\0</strong>', $excerpt); ?>
<?php endif; ?>				
					<li class="row article <?php if(($postCount++ == 1)) { echo ' featured-article'; } ?>"> 
					<?php if(has_post_thumbnail()) : ?>
						<div class="article-image three-col">
						<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
						</div>
						<div class="five-col last-col">
					<?php endif; ?>	
					<h2><a href="<?php the_permalink() ?>"><?php if ( is_search() ) : echo $title; else : echo  the_title(); endif; ?></a></h2>
						<?php get_template_part("library/includes/_article_meta"); ?>
			<?php if('event' == get_post_type()) : ?>
				<?php 
					$current_time = current_time('mysql'); 
					list( $today_year, $today_month, $today_day, $hour, $minute, $second ) = split( '([^0-9])', $current_time );
					$current_timestamp = $today_year . $today_month . $today_day . $hour . $minute;
					// Gets the event start month from the meta field
					$start_nummonth = get_post_meta( $post->ID, '_start_month', true );
					$start_month = get_post_meta( $post->ID, '_start_month', true );
					// Converts the month number to the month name
					$start_month = $wp_locale->get_month( $start_month );
					// Gets the event start day
					$start_day = get_post_meta( $post->ID, '_start_day', true );
					// Gets the event start year
					$start_year = get_post_meta( $post->ID, '_start_year', true );
					// Gets the event start hour
					$start_hour = get_post_meta( $post->ID, '_start_hour', true );
					// Gets the event start minute
					$start_minute = get_post_meta( $post->ID, '_start_minute', true );
					$end_nummonth = get_post_meta( $post->ID, '_end_month', true );
					$end_month = get_post_meta( $post->ID, '_end_month', true );
					// Converts the month number to the month name
					$end_month = $wp_locale->get_month( $end_month );
					// Gets the event start day
					$end_day = get_post_meta( $post->ID, '_end_day', true );
					// Gets the event start year
					$end_year = get_post_meta( $post->ID, '_end_year', true );
					// Gets the event start hour
					$end_hour = get_post_meta( $post->ID, '_end_hour', true );
					// Gets the event start minute
					$end_minute = get_post_meta( $post->ID, '_end_minute', true );
					$location = get_post_meta( $post->ID, '_event_location', true );
					$registration = get_post_meta( $post->ID, '_event_registration', true );
				?>
				</p>
				<dl class="event-details clearfix">
				<dt class="accessibility-aid">Location:</dt>
				<?php if ( $location ) : ?><dd class="location" itemprop="location" itemscope itemtype="http://schema.org/PostalAddress"><?php echo $location; ?></dd><?php endif; ?>
				<dt class="accessibility-aid">Date:</dt>
				<dd>
					<?php if ($start_day != $end_day && $start_month == $end_month) : ?>
						<?php echo $start_day . '-' . $end_day . ' ' . $start_month . ' ' . $end_year; ?>
					<?php endif; ?>
					<?php if ($start_month != $end_month) : ?>
						<?php echo $start_day . ' ' . $start_month . ' - ' .$end_day . ' ' . $end_month . ' ' . $end_year; ?>
					<?php endif; ?>
					<?php if ($start_day == $end_day) : ?>
						<?php echo $start_day. ' ' . $start_month . ' ' . $end_year; ?>
					<?php endif; ?>
					<span class="accesibilty-aid">
						<time itemprop="startDate" datetime="<?php echo $start_year .'-' . $start_nummonth . '-' . $start_day . 'T' . $start_hour . ':' . $start_minute; ?>"></time></dd>
						<time itemprop="endDate" datetime="<?php echo $end_year .'-' . $end_nummonth . '-' . $end_day . 'T' . $end_hour . ':' . $end_minute; ?>"></time>
					</span>
				</dd>
			</dl>
		<?php endif; // event ?>
					<?php if(has_post_thumbnail()) : ?>
						<p><?php if ( is_search() ) : echo $excerpt; else : echo the_excerpt(); endif; ?></p>
					</div>
					<?php else : ?>
						<p><?php if ( is_search() ) : echo $excerpt; else : echo the_excerpt(); endif; ?></p>
					<?php endif; ?>
					</li>
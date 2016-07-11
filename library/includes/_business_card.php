<?php
wp_reset_query();
$queried_object = get_queried_object();  
$term_slug = $queried_object->slug; 
$custom_taxterms = wp_get_object_terms( $post->ID, 'topic', array('fields' => 'ids') );

    $args=array(
      'post_type' => 'productbusinesscard',
      'tax_query' => array(
		    array(
		        'taxonomy' => 'topic',
		        'field' => 'id',
		        'terms' => $custom_taxterms
		    )
		),
      'post_status' => 'publish',
      'posts_per_page' => 1,
      'order' => 'ASC',
      'caller_get_posts'=> 1
    );

    $my_query = null;
    $my_query = new WP_Query($args);
    if( $my_query->have_posts() ) {
      while ($my_query->have_posts()) : $my_query->the_post(); ?>
      <?php echo $title; ?>
		<div class="glossary-box box box-highlight <?php echo ' promo-', $queried_term; ?>">
			<h2><span>What is&hellip;</span><?php the_title(); ?></h2>
			<?php the_content(); ?>
		</div>
        
<?php endwhile; } wp_reset_query(); ?>
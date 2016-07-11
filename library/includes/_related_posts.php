<div class="related-posts clearfix">
<h2>You may also be interested in</h2>
<ul class="list clearfix no-bullets">
<?php
	wp_reset_query();
	$max_articles = 3;  // How many articles to display
	$tags = wp_get_post_tags($post->ID);
	$cnt = 0;
	
	if ($tags) {
		$tag_ids = array();
		foreach($tags as $individual_tag) $tag_ids[0] = $individual_tag->term_id;
		
		$args=array(
		'tag__in' => $tag_ids,
		'post__not_in' => array($post->ID),
		'showposts'=> $max_articles, // Number of related posts that will be shown.
		'caller_get_posts'=> 1
		);
		$my_query = new wp_query($args);
		if( $my_query->have_posts() ) {
		while ($my_query->have_posts()) {
		$my_query->the_post();
		$cnt++; 
?>
 <li>
	 <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
	 <?php get_template_part("library/includes/_post_cats"); ?>
	 </li>
 <?php
 }
 }
}

if ($cnt < $max_articles) {

$categories = get_the_category($post->ID);
if ( $categories ) {
	$categories = array();
	foreach($categories as $individual_category) $category_ids[0] = $individual_category->term_id;
	
	$args=array(
	'category__in' => $category_ids,
	'post__not_in' => array($post->ID),
	'showposts'=> $max_articles, // Number of related posts that will be shown.
	'caller_get_posts'=> 1
	); 
	$my_query = new wp_query($args);
	if( $my_query->have_posts() ) {
	while ($my_query->have_posts()) {
	$my_query->the_post();
	$cnt++; 
	if ($cnt > $max_articles) break;
 ?>
 <li>
	 <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
	 <?php get_template_part("library/includes/_post_cats"); ?>
 </li>
 <?php
 }
 }
}
}
wp_reset_query();
?>
</ul>
</div>
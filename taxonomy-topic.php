<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * Category Template
 *
 *
 * @file           taxonomy-topic.php
 * @package        Ubuntu blog theme
 * @author         Canonical Web Team
 * @copyright      2012 Canonical Ltd
 * @license
 * @version        Release: 1.0
 * @filesource     wp-content/themes/insights-theme/category.php
 * @link           http://codex.wordpress.org/Theme_Development#Archive_.28category.php.29
 * @since          available since Release 1.0
 */

 /* Template Name: Topics */
?>

<?php get_header();
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1; // Needed for pagination
	$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
	$tax = get_query_var( 'topic' );
	$post = $wp_query->get_queried_object();
	$current_tax = $term->slug;
?>

<div class="row row-hero cat-page-title no-border">
	<h1 class="cat-title inner-wrapper no-border"><?php wp_title(''); ?></h1>
</div>

<?php
/* ============== pull in business card ============== */
  wp_reset_query();
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1; // Needed for pagination
	$query = new WP_Query( array(
	'posts_per_page' => 1,
	'topic' => $current_tax,
  'post_type' => 'productbusinesscard',
  'post_status' => 'publish',
  'post__not_in' => $do_not_duplicate,
	'paged'=>$paged
	));
?>

<?php if ($query->have_posts()) : ?>

<?php
	while( $query->have_posts() ):
	$query->the_post();
	$do_not_duplicate[] = $post->ID ?>
			<div class="row glossary-box glossary-box-<?php echo strtolower(wp_title( '', false, 'right' )); ?> no-border<?php if( is_single() ) : echo ' box box-highlight'; endif; ?>">
				<div class="inner-wrapper">
					<div class="clearfix">
						<?php the_content(); ?>
					</div>
				</div>
			</div>

<?php endwhile; ?>

<?php endif; // if have_posts ends

/* ============== end pull in business card ============== */
?>

<?php
/* ============== pull in featured ============== */
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1; // Needed for pagination
	$query = new WP_Query( array(
	'posts_per_page' => 1,
	'topic' => $current_tax,
	'meta_key' => 'dbt_checkbox_featured',
  'post_type' => 'any',
	'paged'=>$paged
	));
?>
<?php if ($query->have_posts()) : ?>
	<div class="row featured-article">
		<div class="inner-wrapper">
			<div class="eight-col no-margin-bottom">
				<h2>Editor's pick</h2>
				<ul class="no-bullets">
				<?php
					while( $query->have_posts() ):
					$query->the_post();
					$do_not_duplicate[] = $post->ID ?>
					<?php if ('event' == get_post_type()) : ?>
						<?php get_template_part("includes/_event_meta"); ?>
					<?php else : ?>
						<?php get_template_part("content_home"); ?>
					<?php endif ; ?>
				<?php endwhile; ?>
				</ul>
			</div><!-- /.eight-col -->
		</div><!-- /.inner-wrapper -->
	</div><!-- /.row -->
<?php else : ?>
<?php
// The Query
	$new_query = new WP_Query( array(
	'posts_per_page' => 1,
	'topic' => $current_tax,
  'post_type' => 'any',
	'paged'=>$paged
	));
?>
	<div class="row featured-article">
		<div class="inner-wrapper">
			<div class="eight-col no-margin-bottom">
				<ul class="no-bullets">
				<?php while( $new_query->have_posts() ): $new_query->the_post(); ?>
					<?php if ('event' == get_post_type()) : ?>
						<?php get_template_part("includes/_event_meta"); ?>
					<?php else : ?>
						<?php get_template_part("content_home"); ?>
					<?php endif ; ?>
				<?php endwhile; wp_reset_postdata(); ?>
				</ul>
			</div><!-- /.eight-col -->
		</div><!-- /.inner-wrapper -->
	</div><!-- /.row -->

<?php endif; // if have_posts ends
/* ============== end pull in featured ============== */
?>

<div class="article-list">
<?php
/* ============== pull in latest events ============== */
  wp_reset_query();
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1; // Needed for pagination
	$query = new WP_Query( array(
	'posts_per_page' => 2,
	'post_type' => 'event',
	'topic' => $current_tax,
  'post__not_in' => $do_not_duplicate,
	'paged'=>$paged
	));
?>

<?php if ($query->have_posts()) : ?>
	<div class="row">
		<div class="inner-wrapper">
			<div class="eight-col no-margin-bottom">
				<h2>Upcoming and recent <span><?php echo strtolower(wp_title( '', false, 'right' )); ?></span> events</h2>
				<ul class="no-bullets">
				<?php
					while( $query->have_posts() ):
					$query->the_post();
					$do_not_duplicate[] = $post->ID ?>
					<li>
						<?php get_template_part("/includes/_event_meta"); ?>
					</li>
				<?php endwhile; ?>
				</ul>
			</div><!-- /.eight-col -->
		</div><!-- /.inner-wrapper -->
	</div><!-- /.row -->
<?php endif; // if have_posts ends

/* ============== end pull in latest events ============== */
?>

<?php
/* ============== pull in latest cloud articles ============== */
  wp_reset_query();
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1; // Needed for pagination
	$query = new WP_Query( array(
	'posts_per_page' => 2,
	'topic' => $current_tax,
	'category_name' => 'news,press-releases',
  'post_type' => 'any',
  'post__not_in' => $do_not_duplicate,
	'paged'=>$paged
	));
?>

<?php if ($query->have_posts()) : ?>
	<div class="row">
		<div class="inner-wrapper">
			<div class="eight-col no-margin-bottom">
				<h2>Latest <span><?php echo strtolower(wp_title( '', false, 'right' )); ?></span> news</h2>
				<ul class="no-bullets">
				<?php
					while( $query->have_posts() ):
					$query->the_post();
					$do_not_duplicate[] = $post->ID ?>
					<?php if ('event' == get_post_type()) : ?>
						<?php get_template_part("includes/_event_meta"); ?>
					<?php else : ?>
						<?php get_template_part("content_home"); ?>
					<?php endif ; ?>
				<?php endwhile; ?>
				</ul>
			</div><!-- /.eight-col -->
		</div><!-- /.inner-wrapper -->
	</div><!-- /.row -->
<?php endif; // if have_posts ends

/* ============== end pull in latest cloud articles ============== */
?>

<?php
/* ============== pull in most viewed articles ============== */
  wp_reset_query();
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1; // Needed for pagination
	$query = new WP_Query( array(
	'posts_per_page' => 2,
	'topic' => $current_tax,
  'post_type' => 'any',
  'post__not_in' => $do_not_duplicate,
  'meta_key' => 'post_views_count',
  'orderby' => 'meta_value_num',
	'paged'=>$paged
	));
?>

<?php if ($query->have_posts()) : ?>
	<div class="row">
		<div class="inner-wrapper">
			<div class="eight-col no-margin-bottom">
				<h2>Most viewed in <span><?php echo strtolower(wp_title( '', false, 'right' )); ?></span></h2>
				<ul class="no-bullets">
				<?php
					while( $query->have_posts() ):
					$query->the_post();
					$do_not_duplicate[] = $post->ID ?>
					<?php if ('event' == get_post_type()) : ?>
						<?php get_template_part("includes/_event_meta"); ?>
					<?php else : ?>
						<?php get_template_part("content_home"); ?>
					<?php endif ; ?>
				<?php endwhile; ?>
				</ul>
			</div><!-- /.eight-col -->
		</div><!-- /.inner-wrapper -->
	</div><!-- /.row -->
<?php endif; // if have_posts ends
/* ============== end pull in most viewed articles ============== */
?>

<?php /* ============== links to all topics ============== */ ?>
	<div class="row row-resource-list">
		<div class="inner-wrapper">
			<div class="twelve-col no-margin-bottom">
				<h2>All <?php echo strtolower(wp_title( '', false, 'right' )); ?> resources</h2>
				<ul class="no-bullets no-margin-bottom">
				<?php
					// get all the categories from the database
					$cats = get_categories();
					// loop through the categries
						foreach ($cats as $cat) :
							// setup the cateogory ID
							$cat_id= $cat->term_id;
							// create a custom wordpress query
							query_posts("topic=$current_tax&cat=$cat_id&posts_per_page=1");
							// start the wordpress loop!
					      if (have_posts()) : while (have_posts()) : the_post();
									echo "<li><a href='/topic/" . $current_tax . "?cat=".$cat_id."'>".$cat->name." (" .$wp_query->found_posts . ")</a></li>";
					      ?>
								<?php endwhile; endif; // done our wordpress loop. Will start again for each category ?>
						<?php endforeach; // done the foreach statement ?>
				</ul>
			</div><!-- /.eight-col -->
		</div><!-- /.inner-wrapper -->
	</div><!-- /.row -->
<?php /* ============== end links to all topics ============== */ ?>

<?php
/* ============== pull in topic specific cta ============== */
  wp_reset_query();
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1; // Needed for pagination
	$query = new WP_Query( array(
	'posts_per_page' => 1,
	'topic' => $current_tax,
  'post_type' => 'topiccta',
  'post__not_in' => $do_not_duplicate,
	'paged'=>$paged
	));
?>
<?php if ($query->have_posts()) : ?>
	<div class="row contextual-footer">
		<div class="inner-wrapper">
			<div class="eight-col no-margin-bottom">
				<ul class="no-bullets">
				<?php
					while( $query->have_posts() ):
					$query->the_post();
					$do_not_duplicate[] = $post->ID ?>
					<li>
						<h2><?php the_title(); ?></h2>
						<?php the_content(); ?>
					</li>
				<?php endwhile; ?>
				</ul>
			</div><!-- /.eight-col -->
		</div><!-- /.inner-wrapper -->
	</div><!-- /.row -->
<?php endif; // if have_posts ends

/* ============== end pull in topic specific cta ============== */
  wp_reset_query();
?>

</div><!-- /.article-list -->

<?php get_footer(); ?>

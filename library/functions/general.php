<?php
// post types - add new post types here and at the top of post-types.php
$post_types = array('whitepaper', 'post', 'ebook', 'video', 'attachment', 'casestudy', 'infographic', 'webinar', 'event', 'case-study', 'presskits');

function fb_change_search_url_rewrite() {
	if ( is_search() && ! empty( $_GET['s'] ) ) {
		wp_redirect( home_url( "/search/" ) . urlencode( get_query_var( 's' ) ) );
		exit();
	}	
}
add_action( 'template_redirect', 'fb_change_search_url_rewrite' );

/**
 * Customize Event Query using Post Meta
 * 
 * @link http://www.billerickson.net/customize-the-wordpress-query/
 * @param object $query data
 *
 */
function ep_event_query( $query ) {

	// http://codex.wordpress.org/Function_Reference/current_time
	$current_time = current_time('mysql'); 
	list( $today_year, $today_month, $today_day, $hour, $minute, $second ) = split( '([^0-9])', $current_time );
	$current_timestamp = $today_year . $today_month . $today_day . $hour . $minute;

	global $wp_the_query;
	
	if ( $wp_the_query === $query && !is_admin() && is_post_type_archive( 'event' ) ) {
		$meta_query = array(
			array(
				'key' => '_start_eventtimestamp',
				'value' => $current_timestamp,
				'compare' => '>'
			)
		);
		$query->set( 'meta_query', $meta_query );
		$query->set( 'orderby', 'meta_value_num' );
		$query->set( 'meta_key', '_start_eventtimestamp' );
		$query->set( 'order', 'ASC' );
		$query->set( 'posts_per_page', '5' );
	}

}

add_action( 'pre_get_posts', 'ep_event_query' );

// replace "current-cat-" with class "active"
function current_to_active($text){
	$replace = array(
		// List of classes to replace with "active"
		'current-cat-parent' => 'active',
		'current-cat' => 'active',
	);
	$text = str_replace(array_keys($replace), $replace, $text);
		return $text;
	}
add_filter ('wp_list_categories','current_to_active');
// end replace "current-cat-" with class "active"

// general
$the_ga_code = $ga_conversion;

// Add custom taxonomies and custom post types counts to dashboard
add_action( 'right_now_content_table_end', 'my_add_counts_to_dashboard' );

function my_add_counts_to_dashboard() {
    $showTaxonomies = 0;
    // Custom taxonomies counts
    if ($showTaxonomies) {
        $taxonomies = get_taxonomies( array( '_builtin' => false ), 'objects' );
        foreach ( $taxonomies as $taxonomy ) {
            $num_terms  = wp_count_terms( $taxonomy->name );
            $num = number_format_i18n( $num_terms );
            $text = _n( $taxonomy->labels->singular_name, $taxonomy->labels->name, $num_terms );
            $associated_post_type = $taxonomy->object_type;
            if ( current_user_can( 'manage_categories' ) ) {
                $num = '<a href="edit-tags.php?taxonomy=' . $taxonomy->name . '&post_type=' . $associated_post_type[0] . '">' . $num . '</a>';
                $text = '<a href="edit-tags.php?taxonomy=' . $taxonomy->name . '&post_type=' . $associated_post_type[0] . '">' . $text . '</a>';
            }
            echo '<td class="first b b-' . $taxonomy->name . 's">' . $num . '</td>';
            echo '<td class="t ' . $taxonomy->name . 's">' . $text . '</td>';
            echo '</tr><tr>';
        }
    }
    // Custom post types counts
    $post_types = get_post_types( array( '_builtin' => false ), 'objects' );
    foreach ( $post_types as $post_type ) {
        $num_posts = wp_count_posts( $post_type->name );
        $num = number_format_i18n( $num_posts->publish );
        $text = _n( $post_type->labels->singular_name, $post_type->labels->name, $num_posts->publish );
        if ( current_user_can( 'edit_posts' ) ) {
            $num = '<a href="edit.php?post_type=' . $post_type->name . '">' . $num . '</a>';
            $text = '<a href="edit.php?post_type=' . $post_type->name . '">' . $text . '</a>';
        }
        echo '<td class="first b b-' . $post_type->name . 's">' . $num . '</td>';
        echo '<td class="t ' . $post_type->name . 's">' . $text . '</td>';
        echo '</tr>';

        if ( $num_posts->pending > 0 ) {
            $num = number_format_i18n( $num_posts->pending );
            $text = _n( $post_type->labels->singular_name . ' pending', $post_type->labels->name . ' pending', $num_posts->pending );
            if ( current_user_can( 'edit_posts' ) ) {
                $num = '<a href="edit.php?post_status=pending&post_type=' . $post_type->name . '">' . $num . '</a>';
                $text = '<a href="edit.php?post_status=pending&post_type=' . $post_type->name . '">' . $text . '</a>';
            }
            echo '<td class="first b b-' . $post_type->name . 's">' . $num . '</td>';
            echo '<td class="t ' . $post_type->name . 's">' . $text . '</td>';
            echo '</tr>';
        }
    }
}

// prevent business cards from apearing in search results
function searchfilter($query) {
    if ($query->is_search) {
        $query->set('post_type',array('whitepaper', 'ebook', 'post', 'video', 'attachment', 'casestudy', 'infographic', 'checklists', 'webinar', 'event', 'presskits'));
    }
return $query;
}
add_filter('pre_get_posts','searchfilter');
// end prevent business cards from apearing in search results

// add class to pagination links
add_filter('next_posts_link_attributes', 'posts_link_attributes_1');
add_filter('previous_posts_link_attributes', 'posts_link_attributes_2');

function posts_link_attributes_1() {
    return 'class="prev-post"';
}
function posts_link_attributes_2() {
    return 'class="next-post"';
}
// end add class to pagination links

// force display-name of users to Firstname Lastname
function force_pretty_displaynames() {
    $current_user = wp_get_current_user();
    if ($current_user->display_name != $current_user->first_name." ".$current_user->last_name){ 
       update_user_meta($current_user->ID, 'display_name', $current_user->first_name." ".$current_user->last_name);
    }

}
add_action('admin_head','force_pretty_displaynames');
// end force display-name of users to Firstname Lastname

// set max image
if ( ! isset( $content_width ) ) $content_width = 540;
// end set max image

// get category to output as list
function the_category_unlinked($separator = ' ') {
    $categories = (array) get_the_category();
    $thelist = '';
    foreach($categories as $category) {    // concate
        $thelist .= $separator . $category->category_nicename;
    }
    echo $thelist;
}
// end get category to output as list

add_action( 'pre_get_posts', 'wpse7687_pre_get_posts' );
function wpse7687_pre_get_posts( &$wp_query ) {
    if ( $wp_query->is_category && 'latest-news' == $wp_query->get_queried_object()->slug ) {
        $wp_query->set( 'posts_per_page', 4 );
    }
}

add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 100, 100, true );
add_theme_support( 'automatic-feed-links' );

if (function_exists('register_sidebar'))
    register_sidebar();

// This theme uses wp_nav_menu() in one location.
register_nav_menu( 'primary-products', __( 'Products and services menu', 'Insights PLUS' ) );
register_nav_menu( 'primary-categories', __( 'Category menu', 'Insights PLUS' ) );


// limit titles to 70 characters long
function gb_limit_title() {
    ?>
    <script type="text/javascript">
        jQuery(document).ready( function($) 
        {
            $('#title').keyup( function() 
            {
                var $this = $(this);
                if($this.val().length > 70)
                    $this.val($this.val().substr(0, 70));           
            });           
        });     
    </script>
    <?php 
}
add_action('admin_head', 'gb_limit_title');
// end limit titles to 70 characters long

// remove 'Press and 'Product business card' from categories
// 245 = press
// 180 = product business card
function gb_remove_press() {
    ?>
    <script type="text/javascript">
			jQuery(document).ready( function($) {
				$("#categorychecklist #category-245, #categorychecklist #category-180").hide();
			});     
    </script>
    <?php 
}
add_action('admin_head', 'gb_remove_press');
// end remove 'Press' from categories

// Removes ul class from wp_nav_menu
function remove_ul ( $menu ){
    return preg_replace( array( '#^<ul[^>]*>#', '#</ul>$#' ), '', $menu );
}
add_filter( 'wp_nav_menu', 'remove_ul' );

function get_excerpt(){
$excerpt = get_the_content();
$excerpt = preg_replace(" (\[.*?\])",'',$excerpt);
$excerpt = strip_shortcodes($excerpt);
$excerpt = strip_tags($excerpt);
$excerpt = substr($excerpt, 0, 120);
$excerpt = substr($excerpt, 0, strripos($excerpt, " "));
$excerpt = trim(preg_replace( '/\s+/', ' ', $excerpt));
$excerpt = $excerpt.'&hellip;';
return $excerpt;
}

// add link to read more link to article excerpt function
function new_excerpt_more($more) {
	global $post;
	return '&hellip;';
}
add_filter('excerpt_more', 'new_excerpt_more');
// end add link to read more link to article excerpt function

// get popular posts based on view count
function getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0 View";
    }
    return $count.' Views';
}
function setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
// end get popular posts based on view count

// redirect to single post if there is one post in category/tag 
/*function stf_redirect_to_post(){
    global $wp_query;
  
    // If there is one post on archive page
    if( is_archive() && $wp_query->post_count == 1 ){
        // Setup post data
        the_post();
        // Get permalink
        $post_url = get_permalink();
        // Redirect to post page
        wp_redirect( $post_url );
    }  
  
} add_action('template_redirect', 'stf_redirect_to_post');
*/
// end redirect to single post if there is one post in category/tag 

// remove unnecessary items from wp_head
remove_action( 'wp_head', 'feed_links_extra', 3 ); // Display the links to the extra feeds such as category feeds
remove_action( 'wp_head', 'feed_links', 2 ); // Display the links to the general feeds: Post and Comment Feed
remove_action( 'wp_head', 'rsd_link' ); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action( 'wp_head', 'wlwmanifest_link' ); // Display the link to the Windows Live Writer manifest file.
remove_action( 'wp_head', 'index_rel_link' ); // index link
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); // prev link
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 ); // start link
remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 ); // Display relational links for the posts adjacent to the current post.
remove_action( 'wp_head', 'wp_generator' ); // Display the XHTML generator that is generated on the wp_head hook, WP version
// end remove unnecessary items from wp_head

/*
if(strstr($_SERVER['REQUEST_URI'], 'wp-admin/post-new.php')) {
ob_start('one_category_only');
}
function one_category_only($content) {
$content = str_replace('type="checkbox" ', 'type="radio" ', $content);
return $content;
}
*/

if ( ! class_exists('WP_No_Taxonomy_Base') ) {

	class WP_No_Taxonomy_Base {

		public function __construct() {
			add_filter( 'template_redirect', array( $this, 'redirect' ) );
			add_filter( 'term_link', array( $this, 'correct_term_link' ), 10, 3 );

			add_action( 'admin_init', array( $this, 'settings_init' ) );
			add_action( 'current_screen', array( $this, 'settings_save' ) );

			add_action( 'created_category', array( $this, 'flush_rules' ) );
			add_action( 'delete_category', array( $this, 'flush_rules' ) );
			add_action( 'edited_category', array( $this, 'flush_rules' ) );

			add_filter( 'category_rewrite_rules', array( $this, 'add_rules' ) );
		}

		public function flush_rules() {
			global $wp_rewrite;

			$wp_rewrite->flush_rules();
		}


		public function redirect() {
			global $wp, $wp_query;

			if( is_category() || is_tag() || is_tax() ) {
				$taxonomies = get_option('WP_No_Taxonomy_Base');
				$taxonomy   = get_queried_object()->taxonomy;

				/** Bail */
				if( ! $taxonomies )
					return false;

				if( in_array( $taxonomy, $taxonomies ) ) {
					$url = home_url( $wp->request );

					if( strrpos( $url, '/' . $taxonomy . '/' ) ) {
						$new_url = str_replace( '/' . $taxonomy . '/', '/', $url );

						wp_redirect( $new_url, 301 );
						die();
					}
				}
			}
		}

		public function correct_term_link( $link, $feed, $taxonomy ) {
			$taxonomies = get_option('WP_No_Taxonomy_Base');

			if( $taxonomies ) {
				if( in_array( $taxonomy, $taxonomies ) )
					$link = str_replace( $taxonomy . '/', '', $link );
			}

			return $link;
		}


		public function add_rules( $rules ) {
			/**
			 * @todo 
			 *
			 * Create rewrite rules for terms when 
			 * they are nested under a parent term.
			 *
			 * Example: 
			 * http://#{base_url}/#{parent_term}/#{child_term}
			 *
			 * -------------------------------------------- */

			$taxonomies = get_option('WP_No_Taxonomy_Base');

			/** Time to bail. */
			if( ! $taxonomies )
				return $rules;

			$args  = array( 'hide_empty' => false );

			/**
			 * Loop em.
			 * -------------------------------------------- */
			foreach( $taxonomies as $taxonomy ) {
				$categories = get_terms( $taxonomy, $args );

				foreach( $categories as $category ) {
					$slug = $category->slug;

					$feed_rule  = sprintf( 'index.php?taxonomy=%s&term=%s&feed=$matches[1]'  , $taxonomy , $slug );
					$paged_rule = sprintf( 'index.php?taxonomy=%s&term=%s&paged=$matches[1]' , $taxonomy , $slug );
					$base_rule  = sprintf( 'index.php?taxonomy=%s&term=%s'                   , $taxonomy , $slug );

					$rules[ $slug . '/(?:feed/)?(feed|rdf|rss|rss2|atom)/?$' ] = $feed_rule;
					$rules[ $slug . '/page/?([0-9]{1,})/?$' ]                  = $paged_rule;
					$rules[ $slug . '/?$' ]                                    = $base_rule;
				}
			}

			return $rules;
		}

		public function settings_init() {
			load_plugin_textdomain( 'wp-no-taxonomy-base', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
			
			add_settings_section( 
				'wp-no-taxonomy-base-settings', 
				__('Taxonomy Base', 'wp-no-taxonomy-base'), 
				array( $this, 'show_description'), 
				'permalink'
			);

			$taxonomies = get_taxonomies( array( 'public' => true ), 'objects' );

			foreach( $taxonomies as $taxonomy ) {
				add_settings_field(
					'wp-no-taxonomy-base-settings-' . $taxonomy->name, // id
					$taxonomy->label,
					array( $this, 'show_page'), // display callback
					'permalink', // settings page
					'wp-no-taxonomy-base-settings', // settings section
					array( 'taxonomy' => $taxonomy )
				);
			}
		}

		public function settings_save( $screen ) {
			if( 'options-permalink' == $screen->base && isset( $_POST['wp-no-taxonomy-base-nonce'] ) ) {
				if( wp_verify_nonce( $_POST['wp-no-taxonomy-base-nonce'], 'wp-no-taxonomy-base-update-taxonomies' ) ) {
					update_option( 'WP_No_Taxonomy_Base', ( isset( $_POST['WP_No_Taxonomy_Base'] ) ) ? $_POST['WP_No_Taxonomy_Base'] : array() );
				}
			}
		}

		public function show_description() {
			echo '<p>' . __('You can remove the base from all registered taxonomies. Just select the taxonomies to remove their respective bases from your permalinks.', 'wp-no-taxonomy-base') . '</p>';
			wp_nonce_field( 'wp-no-taxonomy-base-update-taxonomies', 'wp-no-taxonomy-base-nonce' );
		}
		
		public function show_page( $args ) {
			$taxonomy  = $args['taxonomy'];
			$selected  = get_option( 'WP_No_Taxonomy_Base', array() );
			$id        = esc_attr( 'wp-no-taxonomy-base-' . $taxonomy->name );
			$cpts      = array();

			if( ! $selected )
				$selected = array();

			$active    = in_array( $taxonomy->name, $selected ) ? 'checked="checked"' : '';

			foreach( $taxonomy->object_type as $object_type ) {
				$cpts[] = get_post_type_object( $object_type );
			}

			$cpt_names = implode( ', ', wp_list_pluck( $cpts, 'label' ) );

			printf(
				'
					<input type="checkbox" id="' . $id . '" name="WP_No_Taxonomy_Base[]" value="%s" %s />
					<label for="' . $id . '"> %s </label>
				',
				$taxonomy->name,
				$active,
				sprintf( __('Activate to remove Slug %s from Post Type(s) %s', 'wp-no-taxonomy-base'), '<code><b>' . $taxonomy->rewrite['slug'] . '</b></code>', '<i>' . $cpt_names . '</i>' )
			);

		}

	} // END class WP_No_Taxonomy_Base

	$wp_no_taxonomy_base = new WP_No_Taxonomy_Base();

} // END if class_exists
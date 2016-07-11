<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * Single Template
 *
 *
 * @file           single.php
 * @package        Ubuntu blog theme 
 * @author         Canonical Web Team 
 * @copyright      2012 Canonical Ltd
 * @license
 * @version        Release: 1.0
 * @filesource     wp-content/themes/insights-theme/single.php
 * @link           http://codex.wordpress.org/Theme_Development#Footer_.28footer.php.29
 * @since          available since Release 1.0
 */
 
get_header(); 
	$field = 'dbt_ga_tracking_label';
	$ga_conversion = get_post_meta($post->ID, $field, TRUE);
	$the_ga_code = $ga_conversion;
	$key = 'postVideo';
	$video_content = get_post_meta($post->ID, $key, TRUE);
	$lock = 'dbt_checkbox_gated';
	$gated_content = get_post_meta($post->ID, $lock, TRUE);
	$posted = $_GET['posted'];
	$postdate = get_the_time('sgymd');
	$postid = get_the_ID();
	$post_type = get_post_type_object( get_post_type($post) );
	global $wpdb;
	global $posted;
	$attachment_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_parent = '$post->ID' AND post_status = 'inherit' AND post_type='attachment' ORDER BY post_date DESC LIMIT 1");
	$articlecat = $category = get_the_category()->category_nicename; 
	$category = get_the_category();
	$category = $category[0]->category_nicename;
	$firstCategory = $category[0]->category_description;
	$registration = get_post_meta( $post->ID, '_event_registration', true );
	$press_cats = array('press-releases', 'news');
?>

<?php if ( has_tag( 'cloud-chatter') ) : ?><div class="row glossary-box glossary-box-chatter-cloud no-border">
    <div class="inner-wrapper">
        <div class="seven-col no-margin-bottom">
            <h1 itemprop="name"><?php the_title(); ?></h1>
            <?php get_template_part("includes/_post_meta"); ?>
            <p class="intro clear"><?php echo get_the_excerpt(); ?></p>
        </div>
    </div>
</div><?php endif; ?>		

<div class="row no-border">
<div class="inner-wrapper">
<?php if(($posted == $postdate . $postid)): // for gated content ?>
<div class="alert">
	<p>Thank you! Your download should start automatically. If it doesn't, <a class="" href="<?php echo wp_get_attachment_url( $attachment_id ); ?>">download now</a>.</p>
</div><!-- /.alert -->
<?php endif; // end if(($posted == $postdate . $postid)) ?>
<?php $digest = $_GET['digest']; if($digest != ''): ?>
<div class="alert">
	<p>Thank you for subscribing! You will begin receiving emails as new content is posted. <br />You may unsubscribe any time by clicking the link in the email.</p>
</div><!-- /.alert -->
<?php endif; // end if(($posted == $postdate . $postid)) ?>

<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
<?php if(!current_user_can('administrator')){ echo setPostViews(get_the_ID()); } ?>
			
<div class="content eight-col no-margin-bottom">
	<div class="box eight-col box-highlight">
		<?php if ( !has_tag( 'cloud-chatter') ) : ?><h1 itemprop="name"<?php if(in_category( $press_cats )) echo ' class="heading-has-time"'; ?>><?php the_title(); ?></h1><?php endif; ?>
		<?php if( ($category != 'events') && !has_tag( 'cloud-chatter')) : ?>
			<?php get_template_part("includes/_post_meta"); ?>
			<div class="eight-col">
        <?php get_template_part("includes/_share_links"); ?>
      </div>
		<?php endif ; ?>
		<?php if ($category == 'events') : ?>
			<?php get_template_part("/includes/_event_meta"); ?>
			<div class="eight-col">
        <?php get_template_part("includes/_share_links"); ?>
      </div>
		<?php endif ; ?>
		<?php if(has_post_thumbnail()) : ?>
		<div itemprop="image" class="article-image">
		<?php if ( is_mobile_phone() ) : ?>
			<?php the_post_thumbnail('small'); ?>
		<?php else : ?>
		<?php if ($category == 'events') : else : ?>
			<?php the_post_thumbnail('large'); ?>
		<?php endif ; endif ; ?>
		</div><!-- /.article-image -->
		<?php endif ; ?>
		<?php //if(the_post_thumbnail_caption()) : echo "<p>", the_post_thumbnail_caption(), "</p>"; endif ; ?>
			<?php if('post' != get_post_type() && $gated_content == 'on') { the_content(); } ?>
			<?php if(($gated_content == 'on') && ($posted != $postdate . $postid)) { ?>
					<?php if($posted == $postdate . $postid ) { // check if the form has been posted ?>
					<?php } else { // show this if the form has not been posted ?>
					<?php if('post' == get_post_type()) the_excerpt(); ?>
					<div id="gated-content">
						<p>Please enter your details to view '<?php the_title(); ?>'</p>						
					<?php $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); ?><?php echo $term->name; ?>
						
					<?php $theurl = rtrim(get_permalink(),'/'); ?>
					<div class="eight-col">
<?php 
    if ( is_tax( 'cloud' )) :
        $form_id = '1079'; // cloud
    elseif ( is_tax( 'server' )) :
        $form_id = '1074'; // server
    elseif ( is_tax( 'desktop' )) :
        $form_id = '1075'; // desktop
    endif;
?>

<style>
/* Your style here */
span.mktError span.mktFormMsg { position: relative; left: 68px !important; } 
</style>

<script src="/js/mktFormSupport.js"></script>
    
<script>
  var formEdit = false;

  var socialSignOn = {
    isEnabled: false,
    enabledNetworks: [''],
    cfId: '',
    codeSnippet: ''
  };
</script>

<script>
var profiling = {
  isEnabled: true,
  numberOfProfilingFields: 2,
  alwaysShowFields: ['NewsletterOpt-In', 'Company', 'LastName', 'FirstName',  'mktDummyEntry']
};
var mktFormLanguage = 'English'
</script>
<script> function mktoGetForm() {return document.getElementById('mktForm_<?php echo $form_id; ?>'); }</script>

<form class="lpeRegForm formNotEmpty" method="post" enctype="application/x-www-form-urlencoded" action="https://pages.canonical.com/index.php/leadCapture/save" id="mktForm_<?php echo $form_id; ?>" name="mktForm_<?php echo $form_id; ?>">
    
    <ul class='mktLblLeft'>
        <li class='mktField' style="display: none;">
            <label>utm_campaign:</label>
            <span class='mktInput'>
                <input class='mktFormHidden' name="utm_campaign" id="utm_campaign" type='hidden' value="" />
                <span class='mktFormMsg'></span>
            </span>
        </li>
        <li class='mktField' style="display: none;">
            <label>utm_medium:</label>
            <span class='mktInput'>
                <input class='mktFormHidden' name="utm_medium" id="utm_medium" type='hidden' value="blank" />
                <span class='mktFormMsg'></span>
            </span>
        </li>
        <li class='mktField' style="display: none;">
            <label>utm_source:</label>
            <span class='mktInput'>
                <input class='mktFormHidden' name="utm_source" id="utm_source" type='hidden' value="Blank" />
                <span class='mktFormMsg'></span>
            </span>
        </li>
        <li class='mktFormReq mktField'>
            <label>First name:</label>
            <span class='mktInput'>
                <input class='mktFormText mktFormString mktFReq' name="FirstName" id="FirstName" type='text' value=""  maxlength='255' tabIndex='4' />
                <span class='mktFormMsg'></span>
            </span>
        </li>
        <li class='mktFormReq mktField'>
            <label>Last name:</label>
            <span class='mktInput'>
                <input class='mktFormText mktFormString mktFReq' name="LastName" id="LastName" type='text' value=""  maxlength='255' tabIndex='5' />
                <span class='mktFormMsg'></span>
            </span>
        </li>
        <li class='mktFormReq mktField'>
            <label>Company name:</label>
            <span class='mktInput'>
                <input class='mktFormText mktFormString mktFReq' name="Company" id="Company" type='text' value=""  maxlength='255' tabIndex='6' />
                <span class='mktFormMsg'></span>
            </span>
        </li>
        <li class='mktFormReq mktField'>
            <label>Job Role:</label>
            <span class='mktInput'>
                <select class='mktFormSelect mktFReq' name="Job_Role__c" id="Job_Role__c" size='1'   tabIndex='7'>
                    <option value='Please select' selected='selected'>Please select</option>
                    <option value='Business and Project Management'>Business and Project Management</option>
                    <option value='Database Development and Administration'>Database Development and Administration</option>
                    <option value='Education'>Education</option>
                    <option value='Enterprise Systems Analysis &amp; Integration'>Enterprise Systems Analysis &amp; Integration</option>
                    <option value='Hardware Operations and Management'>Hardware Operations and Management</option><option value='Home User'>Home User</option>
                    <option value='Individual'>Individual</option>
                    <option value='Network Design and Administration'>Network Design and Administration</option>
                    <option value='Owner/Self Employed'>Owner/Self Employed</option>
                    <option value='Press and Communications'>Press and Communications</option>
                    <option value='Programming/Software Engineering'>Programming/Software Engineering</option><option value='Smartphone User'>Smartphone User</option>
                    <option value='Technical Support'>Technical Support</option>
                    <option value='Technical Writing'>Technical Writing</option>
                    <option value='Ubuntu Enthusiast'>Ubuntu Enthusiast</option>
                    <option value='Web Development and Administration'>Web Development and Administration</option>
                </select>
                <span class='mktFormMsg'></span>
            </span>
        </li>
        <li class='mktFormReq mktField'>
            <label>Email Address:</label>
            <span class='mktInput'>
                <input class='mktFormText mktFormEmail mktFReq' name="Email" id="Email" type='text' value=""  maxlength='255' tabIndex='8' />
                <span class='mktFormMsg'></span>
            </span>
        </li>
        <li class='mktField'>
            <label>Currently Using Ubuntu:</label>
            <span class='mktInput'>
                <input class='mktFormText mktFormPicklist' name="CurrentlyUsingUbuntu" id="CurrentlyUsingUbuntu" type='text' value=""  maxlength='255' tabIndex='9' />
                <span class='mktFormMsg'></span>
            </span>
        </li>
        <li class='mktField'>
            <label>Number of Employees:</label>
            <span class='mktInput'>
                <select class='mktFormSelect' name="num_employees__c" id="num_employees__c" size='1'   tabIndex='10'>
                    <option value='None' selected='selected'>None</option>
                    <option value='&lt;500'>&lt;500</option>
                    <option value='501-1000'>501-1000</option>
                    <option value='1001-2000'>1001-2000</option>
                    <option value='2001-5000'>2001-5000</option>
                    <option value='5000+'>5000+</option>
                </select>
                <span class='mktFormMsg'></span>
            </span>
        </li>
        <li class='mktField mktLblRight'>
            <span class='mktInput mktLblRight'>
                <input class='mktFormCheckbox' name="NewsletterOpt-In" id="NewsletterOpt-In" type='checkbox' value="1"   tabIndex='11' />
                <label>I would like to receive occasional news from Canonical by email.                                         </label>&nbsp;
                <span class='mktFormMsg'></span>
            </span>
        </li>
        <li id='mktFrmButtons' class="clear">
            <input id='mktFrmSubmit' type='submit' value='Submit' name='submitButton' onclick='formSubmit(document.getElementById("mktForm_<?php echo $form_id; ?>")); return false;' />&nbsp;
            <input style='display: none;' id='mktFrmReset' type='reset' value='Clear' name='resetButton' onclick='formReset(document.getElementById("mktForm_<?php echo $form_id; ?>")); return false;' />
        </li>
    </ul>
  
    <span style="display:none;"><input type="text" name="_marketo_comments" value="" /></span>
    <input type="hidden" name="lpId" value="1214" />
    <input type="hidden" name="subId" value="30" />
    <input type="hidden" name="munchkinId" value="066-EOV-335" />
    <input type="hidden" name="kw" value="" />
    <input type="hidden" name="cr" value="" />
    <input type="hidden" name="searchstr" value="" />
  
<?php
// Get terms for post
$terms = get_the_terms( $post->ID , 'topic' );
if ($terms) :
	foreach( $terms as $term ) :
		echo '<input type="hidden" name="lpurl" value="https://pages.canonical.com/confirmed-download-'.$term->slug. '.html?cr={creative}&amp;kw={keyword}" />';
	unset($term);
endforeach;
endif;
?>
    <input type="hidden" name="formid" value="<?php echo $form_id; ?>" />
    <input type="hidden" name="returnURL" value="<?php the_permalink() ?>?posted=<?php echo $postdate . $postid; ?>" />
    <input type="hidden" name="retURL" value="<?php the_permalink() ?>?posted=<?php echo $postdate . $postid; ?>" />
    <input type="hidden" name="returnLPId" value="-1" />
    <input type="hidden" name="_mkt_disp" value="return" />
    <input type="hidden" name="_mkt_trk" value="id:066-EOV-335" />
</form>

<script src="/js/mktFormSupport.js"></script>

<script>
    function formSubmit(elt) {
        return Mkto.formSubmit(elt);
    }
    function formReset(elt) {
        return Mkto.formReset(elt);
    }
</script>

</div>
					</div><!-- /#gated-content -->
					<?php } // end if market_form completed ?>
					
<?php } elseif(($gated_content == 'on' && $posted == $postdate . $postid)) { // show this if is gated and the form has been posted ?>

		<?php if ( get_post_meta($post->ID, 'postVideo', true) ) : ?>
					<div class="new-video-wrapper"><iframe class="post-video" width="596" height="335" src="https://www.youtube.com/embed/<?php echo $video_content; ?>?rel=0&showinfo=0" frameborder="0" allowfullscreen></iframe></div>
					<?php the_content(); ?>
		<?php else : ?>
		<?php if('post' == get_post_type()) : ?>
					<div itemprop="description" class="eight-col"><?php the_content(); ?></div>
					<div id="download-item">
						<p><a class="link-cta-ubuntu" href="<?php echo wp_get_attachment_url( $attachment_id ); ?>">Download  <?php $term_id = the_category_ID($echo=false); $saved_data = get_tax_meta($term_id,'ba_singular'); echo $saved_data; ?></a></p>
					</div>
		<?php else : ?>
					<iframe width="1" height="1" frameborder="0" src="<?php echo wp_get_attachment_url( $attachment_id ); ?>"></iframe>
		<?php endif; ?>
		<?php endif; // if video  ?>
			<?php } else { // show this if the post is not gated ?>
		<?php if ( get_post_meta($post->ID, 'postVideo', true) ) : ?>
				<?php if ( !empty( $post->post_excerpt ) ) :	the_excerpt(); else : false; endif; ?>
					<div class="new-video-wrapper"><iframe class="post-video" width="596" height="335" src="https://www.youtube.com/embed/<?php echo $video_content; ?>?rel=0&showinfo=0" frameborder="0" allowfullscreen></iframe></div>
					<div itemprop="description" class="eight-col"><?php the_content(); ?></div>
		<?php elseif('post' == get_post_type() || 'presskits' == get_post_type()) : ?>
					<div itemprop="description" class="eight-col"><?php the_content(); ?></div>
					<?php if ($category != 'news') : ?>
						<?php $attachments = get_children( array('post_parent' => get_the_ID(), 'post_type' => 'attachment') ); if ( $attachments ) : if (! wp_attachment_is_image($attachment_id) ) : ?>
					<div id="download-item">
						<p><a class="link-cta-ubuntu" href="<?php echo wp_get_attachment_url( $attachment_id ); ?>?utm_source=<?php the_title(); ?>&amp;utm_medium=download+link&amp;utm_content=<?php echo $post_type->labels->title_friendly, ''; ?>">Download  <?php $term_id = the_category_ID($echo=false); $saved_data = get_tax_meta($term_id,'ba_singular'); echo $saved_data; ?></a></p>
					</div><?php endif; endif; endif; // end if ( $attachments ) ?>
		<?php else : ?>
					<div itemprop="description" class="eight-col"><?php the_content(); ?></div>
		<?php if(!$gated_content && $posted) : ?>
					<iframe width="1" height="1" src="<?php echo wp_get_attachment_url( $attachment_id ); ?>" style='display:none;'></iframe>
		<?php else : ?>
						<?php $attachments = get_children( array('post_parent' => get_the_ID(), 'post_type' => 'attachment') );
							if ( $attachments ) : ?>
					<div id="download-item">
						<p><a class="link-cta-ubuntu" href="<?php echo wp_get_attachment_url( $attachment_id ); ?>?utm_source=<?php the_title(); ?>&amp;utm_medium=download+link&amp;utm_content=<?php echo $post_type->labels->title_friendly, ''; ?>">Download <?php single_cat_title(); ?></a></p>
					</div><?php endif ; // end if ( $attachments ) ?>
		<?php endif; ?>
		<?php endif; // if video  ?>
<?php } // end if gated ?>
<?php if('event' == get_post_type()) : ?>
<?php 
	$current_time = current_time('mysql'); 
	list( $today_year, $today_month, $today_day, $hour, $minute, $second ) = split( '([^0-9])', $current_time );
	$current_timestamp = $today_year . $today_month . $today_day . $hour . $minute;
	$event_timestamp = get_post_meta( $post->ID, '_start_eventtimestamp', true ); ?>
	<?php if(($current_timestamp <= $event_timestamp) && $registration) : ?>
	<div id="download-item">
		<p><a itemprop="url" class="link-cta-ubuntu" href="<?php echo $registration; ?>">Register now</a></p>
	</div>
	<?php endif; ?>
<?php endif; // if event ?>

<?php $user_login = get_the_author_meta('user_login', $curauth->ID); ?>
<?php if($user_login != 'canonical') : ?>
<?php if(get_the_author_meta('user_job_title', $uid)) : ?><div id="hcard-<?php the_author_meta('first_name',$uid); ?>-<?php the_author_meta('last_name',$uid); ?>" class="eight-col vcard<?php if(get_the_author_meta('user_photo', $uid)) echo ' has-avatar '; ?>">
  <h3>About the author</h3>
  <?php if(get_the_author_meta('user_photo', $uid)) : ?><div><span class="image-wrap avatar" style="width: auto; height: auto;"><img src="<?php bloginfo('url'); ?><?php the_author_meta('user_photo',$uid); ?>" alt="<?php the_author_meta('first_name',$uid); ?>'s photo" class="avatar-156 photo" width="156" height="156" /></span></div><?php endif; ?>
  <div><p><?php the_author_meta('user_description',$uid); ?></p>
  <p><a href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>">More articles by <?php the_author_meta('first_name',$uid); ?></a></p></div>
</div><?php endif; ?><?php endif; ?>
<?php get_template_part("includes/_cat_headings"); ?>

	</div><!-- /.box -->
<?php get_template_part("includes/_related_posts"); ?>
</div><!-- /.eight-col -->

<aside id="sidebar" class="four-col last-col instapaper_ignore">
  <?php $attachments = get_children( array('exclude'     => get_post_thumbnail_id(), 'post_parent' => get_the_ID(), 'post_type' => 'attachment') ); if ((( $attachments )) && ($category == 'news')) : ?>

<?php get_template_part("includes/_downloads"); ?>

<?php $pressLinks = preg_split("/\\r\\n|\\r|\\n/", get_post_meta($post->ID, 'dbt_press_links', true ) );

if ( get_post_meta($post->ID, 'dbt_press_links', true) ) :  ?>
	<div class="box box-highlight press-release-videos four-col clearfix">
		<h2>Links</h2>
		<ul class="no-bullets">
	<?php foreach ( $pressLinks as $pressLink ) : ?>
		 <li>
			 <?php echo $pressLink; ?>
     </li>
	<?php endforeach; ?>
		</ul>
	</div>
<?php endif; ?>

<?php 
	if ( get_post_meta($post->ID, 'postVideo', true) ) : 
		get_template_part("includes/_videos"); 
	endif; 
?>

<?php 
$press_contact = make_clickable(get_post_meta( get_the_ID(), 'dbt_press_contact', true ));

// check if the custom field has a value
if( ! empty( $press_contact ) ) {
    echo '<div class="box box-highlight four-col">';
    echo '<h2>Contact details</h2>';
    echo wpautop( $press_contact, false );  
    echo '</div>';
} ?>

<?php else : ?>
<?php endif; // if category press-releases ends ?>
<?php endwhile; // while have_posts ends ?>
<?php endif; // if have_posts ends ?>

<?php if (($category == 'news') &&  (( $attachments ) && (! wp_attachment_is_image($attachment_id) )) ) : ?>
<?php endif; // if ($category == array('news','press-releases')) ?>

<?php
/* ============== pull in topic specific cta ============== */
  wp_reset_query();
  $topic_list = wp_get_post_terms($post->ID, 'topic', array("fields" => "slugs"));
  $current_tax = $topic_list[0];
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1; // Needed for pagination
	$query = new WP_Query( array(
    'posts_per_page'  => 3,
    'topic'           => $current_tax,
    'post_type'       => 'topiccta',
    'post__not_in'    => $do_not_duplicate,
    'paged'           => $paged
	));
?>
<?php if ($query->have_posts()) : ?>
		<?php 
			while( $query->have_posts() ): 
			$query->the_post(); 
			$do_not_duplicate[] = $post->ID;
			$slug = basename(get_permalink()); ?>
      <div id="rtp-rhc" class="box box-highlight contextual-footer four-col">
	<div class"box-<?php echo $current_tax; ?> box-<?php echo $slug; ?> four-col">
		<ul class="no-bullets">
			<li>
				<h2><a href="<?php echo get_the_excerpt(); ?>"><?php the_title(); ?></a></h2>
				<?php the_content(); ?>
			</li>					
		</ul>
	</div><!-- /.box --></div>
		<?php endwhile; ?>
<?php endif; // if have_posts ends 
wp_reset_query(); 
/* ============== end pull in topic specific cta ============== */ ?>

<?php get_template_part("includes/_digest"); ?>

 <div class="box box-highlight four-col">
    	<h2>All <?php $term_list = wp_get_post_terms($post->ID, 'topic', array("fields" => "names"));
echo strtolower($term_list[0]); wp_reset_query();?>&nbsp;resources</h2>
    	<ul class="no-bullets no-margin-bottom">
    	<?php	wp_reset_query();

        $topic_list = wp_get_post_terms($post->ID, 'topic', array("fields" => "slugs"));
    		// get all the categories from the database
    		$current_tax = $topic_list[0];
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
    			<?php endforeach; wp_reset_query(); // done the foreach statement and reset the mofo ?>
          <li><a href="/topic/<?php echo $current_tax; ?>">View all <?php 
echo strtolower($term_list[0]); wp_reset_query();?>&nbsp;resources</a></li>
    	</ul>
</div>

</aside><!-- /.instapaper_ignore -->

</div><!-- /.inner-wrapper -->
</div><!-- /.row --> 

<?php // dynamic_sidebar( 'search-sidebar' ); ?>	

<?php get_footer(); ?>

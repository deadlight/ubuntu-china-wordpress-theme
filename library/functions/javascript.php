<?php
/* 
	Contents:
		add jquery
		add google plus and marketo for single only (atm)
		add facebook social gubbin's
		add ie conditional html5 shim to header
		add infinite Scroll and masonry
		add author javascript
		add google analytics
		add marketo to footer
*/
if(is_admin()) {  
    wp_enqueue_script('jquery-ui-datepicker');  
    wp_enqueue_style('jquery-ui-custom', get_template_directory_uri().'/css/jquery-ui-custom.css');  
}  

// add jquery
function my_init() {
	if (!is_admin()) {
		wp_deregister_script('jquery');
		wp_register_script('jquery', get_template_directory_uri() . '/library/js/jquery.min.js', false, '1.9.1', true);
		wp_enqueue_script('jquery');
		
    	// load masonry jquery		
		wp_register_script( 'jquery_masonry',  get_template_directory_uri() . '/library/js/jquery.masonry.min.js', array('jquery'),null,true );
				
    	// load infinite scroll jquery		
		wp_register_script( 'infinite_scroll',  get_template_directory_uri() . '/library/js/jquery.infinitescroll.min.js', array('jquery'),null,true );

    	// load cookie jquery  		
		wp_register_script( 'jquery_cookie',  get_template_directory_uri() . '/library/js/jquery.cookie.js', array('jquery'),null,true );

    	// load manual-trigger.js jquery		
		wp_register_script( 'infinite_scroll_trigger',  get_template_directory_uri() . '/library/js/manual-trigger.js', array('jquery'),null,true );
		    if( ! is_singular() ) {
		        wp_enqueue_script('infinite_scroll');
		        wp_enqueue_script('infinite_scroll_trigger');
		        wp_enqueue_script('jquery_masonry');
		    }
		        wp_enqueue_script('jquery_cookie');
		// *Load this last* load a JS file for Ubuntu: js/core.js
		wp_enqueue_script('ubuntu_core', get_bloginfo('template_url') . '/library/js/core.js', array('jquery'), '1.0', true);
		
		wp_enqueue_script('ubuntu_global', get_bloginfo('template_url') . 'http://assets.ubuntu.com/sites/ubuntu/latest/u/js/global.js', array('global'), '1.0', true);
		
	}
}
add_action('wp_footer', 'my_init');
// end add jquery


function add_brighttalk() {
	if (is_page('webinars')) {
		echo '';
	}
}
add_action( 'wp_footer', 'add_brighttalk' );

// add google plus and marketo for single only (atm)
function wpse53364() {
    if( !is_admin() && is_single() ) {
    	// load google plus button js
		wp_register_script('plusone', 'https://apis.google.com/js/plusone.js', false,'1', true);		wp_enqueue_script('plusone');
    }
}
add_action( 'wp_enqueue_scripts', 'wpse53364' );
// end add google plus and marketo

// add ie conditional html5 shim to header
function add_ie_html5_shim () {
	global $is_IE;
	if ($is_IE);
		echo '<!--[if lt IE 9]>';
    	echo '<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>';
		echo '<![endif]-->';
}
add_action('wp_head', 'add_ie_html5_shim');
// end add ie conditional html5 shim to header
    
// add google analytics to footer
function add_google_analytics() {
	if (!is_admin()) { ?>
        <!-- google analytics -->
				<script>
				  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
				  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
				  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
				  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
				
				  ga('create', 'UA-1018242-45', 'ubuntu.com');
				  ga('send', 'pageview');
				</script>
    <?php
    }
}
add_action('wp_footer', 'add_google_analytics');
// end add google analytics to footer

// add munchkin to footer
function add_munchkin_tracking() {
	if (!is_admin()) { ?>
<!-- marketo -->
    <script>
			(function() {
			  function initMunchkin() {
			    Munchkin.init('066-EOV-335',  {cookieAnon: false});
			  }
			  var s = document.createElement('script');
			  s.type = 'text/javascript';
			  s.async = true;
			  s.src = document.location.protocol + '//munchkin.marketo.net/munchkin.js';
			  s.onreadystatechange = function() {
			    if (this.readyState == 'complete' || this.readyState == 'loaded') {
			      initMunchkin();
			    }
			  };
			  s.onload = initMunchkin;
			  document.getElementsByTagName('body')[0].appendChild(s);
			})();    
		</script>
		
    <?php
    }
}
add_action('wp_footer', 'add_munchkin_tracking');
// end add munchkin to footer

?>
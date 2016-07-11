<?php
$prefix = 'dbt_';

$meta_box = array(
    'id' => 'my-meta-box',
    'title' => 'Custom post meta',
    'pages' => $post_types, // multiple post types, accept custom post types
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
        array(
            'name' => 'Enter Google conversion label e.g: tSwUCKDsugMQ4L7f4gM',
            'id' => $prefix . 'ga_tracking_label',
            'type' => 'text'
        ),
				array(
            'name' => 'Tick checkbox if featured post',
            'id' => $prefix . 'checkbox_featured',
            'type' => 'checkbox'
        ),
        array(
            'name' => 'Tick checkbox if gated',
            'id' => $prefix . 'checkbox_gated',
            'type' => 'checkbox'
        )
    )
); 

 
add_action('admin_menu', 'mytheme_add_box');

// Add meta box
function mytheme_add_box() {
    global $meta_box;

    foreach ($meta_box['pages'] as $page) {
        add_meta_box($meta_box['id'], $meta_box['title'], 'mytheme_show_box', $page, $meta_box['context'], $meta_box['priority']);
    }
}

// Callback function to show fields in meta box
function mytheme_show_box() {
    global $meta_box, $post;

    // Use nonce for verification
    echo '<input type="hidden" name="mytheme_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

    echo '<table class="form-table">';

    foreach ($meta_box['fields'] as $field) {
        // get current post meta data
        $meta = get_post_meta($post->ID, $field['id'], true);

        echo '<tr>',
                '<th style="width:20%"><label for="', $field['id'], '">', $field['name'], '</label></th>',
                '<td>';
        switch ($field['type']) {
        
            case 'checkbox':
				echo '<input type="checkbox" name="', $field['id'], '" id="', $field['id'], '"', $meta ? ' checked="checked"' : '', ' />';
                break;
            case 'text' :
				echo '<input type="text" name="'. $field['id']. '" id="'. $field['id'] .'" value="'. ($meta ? $meta : $field['default']) . '" size="30" style="width:40%" />'. $field['desc'];
              break;
        }
        echo    '<td>',
            '</tr>';
    }

    echo '</table>';
}

add_action('save_post', 'mytheme_save_data');

// Save data from meta box
function mytheme_save_data($post_id) {
    global $meta_box;

    // verify nonce
    if (!wp_verify_nonce($_POST['mytheme_meta_box_nonce'], basename(__FILE__))) {
        return $post_id;
    }

    // check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }

    // check permissions
    if ('page' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id)) {
            return $post_id;
        }
    } elseif (!current_user_can('edit_post', $post_id)) {
        return $post_id;
    }

    foreach ($meta_box['fields'] as $field) {
        $old = get_post_meta($post_id, $field['id'], true);
        $new = $_POST[$field['id']];

        if ($new && $new != $old) {
            update_post_meta($post_id, $field['id'], $new);
        } elseif ('' == $new && $old) {
            delete_post_meta($post_id, $field['id'], $old);
        }
    }
}

// add youtube metabox
add_action('admin_menu', 'insights_meta_boxes');
function insights_meta_boxes() {
    if ( function_exists('add_meta_box') ) { 
        add_meta_box('post_id', 'YouTube', 'custom_post_video', 'video', 'normal', 'high');
        //add_meta_box('post_id', 'YouTube', 'custom_post_video', 'video', 'normal', 'high');
    }
}

//Adds the youtube box in admin
function custom_post_video() {
    global $post;
    ?>
    <div class="inside">
        <p>
        	<label for="postVideo">Code</label>
        	<input type="text" name="postVideo" id="postVideo" value="<?php echo get_post_meta($post->ID, 'postVideo', true); ?>">
        </p>
        <p>Enter the YouTube video 11 digit code here e.g from this url http://www.youtube.com/watch?v=D6z6hn6wZlg you need the 11 digits after ?v= i.e <strong>D6z6hn6wZlg</strong></p>
    </div>
<?php
}

add_action('save_post', 'custom_add_save');

function custom_add_save($postID){
    if (!defined('DOING_AUTOSAVE') && !DOING_AUTOSAVE) {
        return $postID;
    }
    else
    {
        // called after a post or page is saved and not on autosave
        if($parent_id = wp_is_post_revision($postID))
        {
        $postID = $parent_id;
        }
        if ($_POST['postVideo']) 
        {
            update_custom_meta($postID, $_POST['postVideo'], 'postVideo');
        }
        else
        {
            update_custom_meta($postID, '', 'postVideo');
        }
    }

  }
    function update_custom_meta($postID, $newvalue, $field_name) {
    // To create new meta
    if(!get_post_meta($postID, $field_name)){
    add_post_meta($postID, $field_name, $newvalue);
    }else{
    // or to update existing meta
    update_post_meta($postID, $field_name, $newvalue);
    }
}

?>
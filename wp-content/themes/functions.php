<?php 

add_theme_support( 'menus' );

// add custom header image
$args = array(
	'width'         => 940,
	'height'        => 100,
	'default-image' => get_template_directory_uri() . '/images/header.jpg',
	'uploads'       => true,
);
add_theme_support( 'custom-header', $args );

// Add Custom Meta Box To Posts
$prefix = 'custom_meta_';

$meta_box = array(
    'id' => 'my-meta-box',
    'title' => 'Featured Video',
    'page' => 'post',
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
        array(
            'name' => __('Paste Video Embed Code'),
            'desc' => __('Enter Vimeo, YouTube or other embed code to display a featured video. (600px by 340px Featured Slider)'),
            'id' => $prefix . 'video',
            'type' => 'textarea',
            'std' => ''
        ),
    )
);

add_action('admin_menu', 'mytheme_add_box');

	function register_my_menus() {
  		register_nav_menus(
    		array(
      			'main-nav' => __( 'Main Nav' )
    			)
  		);	
	}
	add_action( 'init', 'register_my_menus' );

// Add meta box
function mytheme_add_box() {
    global $meta_box;
    
    add_meta_box($meta_box['id'], $meta_box['title'], 'mytheme_show_box', $meta_box['page'], $meta_box['context'], $meta_box['priority']);
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
            case 'textarea':
                echo '<textarea name="', $field['id'], '" id="', $field['id'], '" cols="60" rows="8" style="width:97%">', $meta ? $meta : $field['std'], '</textarea>', '<br />', $field['desc'];
                break;
        }
        echo     '<td>',
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

// Add thumbnail support
if ( function_exists('add_theme_support') )
add_theme_support('post-thumbnails');
add_image_size( 'home-feature', 600, 340, true ); // Homepage Featured Image
add_image_size( 'home-thumbnail', 320, 220, true ); // Homepage Thumbnails
add_image_size( 'category-thumbnail', 480, 330, true ); // Category Middle Image
add_image_size( 'page-feature', 960, 100, true ); // Featured Page Banner

// add the_breadcrumb() call 
function the_breadcrumb() {
	$url = $_SERVER["REQUEST_URI"];
	$urlArray = array_slice(explode("/",$url), 0, -1);

	// Set $dir to the first value
	$dir = array_shift($urlArray);
	echo '<a href="/">Home</a>';
	foreach($urlArray as $text) {
		$dir .= "/$text";
		echo ' > <a href="'.$dir.'">' . ucwords(strtr($text, array('_' => ' ', '-' => ' '))) . '</a>';
	}
}

	$preset_widgets = array (
	    'primary_widget_area'  => array( 'search', 'pages', 'categories', 'archives' ),
	    'secondary_widget_area'  => array( 'links', 'meta' )
	);
	if ( isset( $_GET['activated'] ) ) {
	    update_option( 'sidebars_widgets', $preset_widgets );
	}
	// update_option( 'sidebars_widgets', NULL );
	
	// Check for static widgets in widget-ready areas
	function is_sidebar_active( $index ){
	  global $wp_registered_sidebars;

	  $widgetcolums = wp_get_sidebars_widgets();

	  if ($widgetcolums[$index]) return true;

	    return false;
	} // end is_sidebar_active

?>
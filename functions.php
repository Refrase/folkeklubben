<?php

  add_theme_support( 'menus' );
  add_theme_support( 'post-thumbnails' );

  // Styling
  function folkeklubben_theme_styles() {

    // PROD
    // wp_enqueue_style( 'style_bundle', get_template_directory_uri() . '/dist/css/style.min.css' );

    wp_enqueue_style( 'style', get_template_directory_uri() . '/style.css', array( 'style_bundle' ) );
  } add_action( 'wp_enqueue_scripts', 'folkeklubben_theme_styles' );

  // Scripts
  function folkeklubben_theme_js() {

    // DEV
    wp_enqueue_script( 'main_js', get_template_directory_uri() . '/js/main.js', array(), null, true );
    // Making the rest url dynamically available to the JavaScript
    // And the ACF options page (where custom colors can be set)
    wp_localize_script( 'main_js', 'wp', array(
      'rest_root' => esc_url_raw( rest_url() ),
      'routes'    => rest_theme_routes(),
      'colors'    => rest_theme_colors()
    ));

    // PROD
    // wp_enqueue_script( 'main_min_js', get_template_directory_uri() . '/dist/js/main.min.js', array(), '', true );
    // // Making the rest url dynamically available to the JavaScript
    // // And the ACF options page (where custom colors can be set)
    // wp_localize_script( 'main_min_js', 'wp', array(
    //   'rest_root' => esc_url_raw( rest_url() ),
    //   'routes'    => rest_theme_routes(),
    //   'colors'    => rest_theme_colors()
    // ));

  } add_action( 'wp_enqueue_scripts', 'folkeklubben_theme_js' );

  function rest_theme_routes() {
  	$routes = array();
  	$query = new WP_Query( array(
  		'post_type'      => 'any',
  		'post_status'    => 'publish',
  		'posts_per_page' => -1,
  	));
  	if ( $query->have_posts() ) {
  		while ( $query->have_posts() ) {
  			$query->the_post();
  			$routes[] = array(
  				'id'   => get_the_ID(),
  				'type' => get_post_type(),
  				'slug' => basename( get_permalink() ),
  			);
  		}
  	}
  	wp_reset_postdata();
  	return $routes;
  }

  // Enabling ACF options page
  if( function_exists('acf_add_options_page') ) {
    acf_add_options_page(
      array(
        'page_title' 	=> 'Colors',
        'menu_title'	=> 'Colors',
        'menu_slug'	  => 'app-colors',
        'icon_url'    => 'dashicons-admin-appearance',
        'capability'	=> 'edit_posts',
        'redirect'		=> false
      )
    );
  }

  function rest_theme_colors() {
    if( have_rows('app_colors', 'option') ) {
      while( have_rows('app_colors', 'option') ) {
        the_row();
        $colors[] = array(
          'name'  => get_sub_field('color_name'),
          'color' => get_sub_field('color'),
          'color_original' => get_sub_field('color_original_value')
        );
      }
    }
    return $colors;
  }

  // Disable possibility of changing theme
  add_action('admin_init', 'remove_theme_menus');
  function remove_theme_menus() {
    global $submenu;
    unset($submenu['themes.php'][5]);
    unset($submenu['themes.php'][15]);
  }

  // Rearrange wp-admin menu
	function custom_menu_order($menu_ord) {
	    if (!$menu_ord) return true;

      // // Uncomment this block and refresh wp-admin to see the current order
      // echo '<pre>';
      // print_r( $menu_ord );
      // echo '</pre>';
      // die;

	    return array(
	        'index.php', // Dashboard
					'edit.php?post_type=page', // Pages
					'edit.php', // Posts
					'edit.php?post_type=release', // Releases
          'edit.php?post_type=track', // Tracks - ATT: REMOVED FROM MENU BELOW AS IT IS LEGACY
          'edit.php?post_type=tour', // Tours
          'edit.php?post_type=concert', // Concerts - ATT: REMOVED FROM MENU BELOW AS IT IS LEGACY
          'edit.php?post_type=video', // Videos
          'edit.php?post_type=contact', // Contacts
          'app-colors', // ACF options page
	        'separator1', // First separator
	        'upload.php', // Media
	        'separator2', // Second separator
	        'themes.php', // Appearance
	        'plugins.php', // Plugins
	        'users.php', // Users
	        'tools.php', // Tools
	        'options-general.php', // Settings
	        'separator-last', // Last separator
	    );
	}
	add_filter('custom_menu_order', 'custom_menu_order'); // Activate custom_menu_order
	add_filter('menu_order', 'custom_menu_order');

	function rrh_change_post_links() {
		global $menu;
		unset($menu[25]); // Remove comments from menu
    remove_menu_page('edit.php?post_type=track'); // Legacy post type (has been moved to Releases as an ACF repeater)
    remove_menu_page('edit.php?post_type=concert'); // Legacy post type (has been moved to Tours as an ACF repeater)
	}
  add_action('admin_menu', 'rrh_change_post_links');

  function slugify($text, $strict = false) {
    $text = html_entity_decode($text, ENT_QUOTES, 'UTF-8');
    $text = preg_replace('~[^\\pL\d.]+~u', '-', $text); // replace non letter or digits by -
    $text = trim($text, '-');
    setlocale(LC_CTYPE, 'en_GB.utf8');
    if (function_exists('iconv')) { $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text); } // transliterate
    $text = strtolower($text); // lowercase
    $text = preg_replace('~[^-\w.]+~', '', $text); // remove unwanted characters
    if (empty($text)) { return 'empty_$'; }
    if ($strict) { $text = str_replace(".", "_", $text); }
    return $text;
  }

  function build_slug_value_array( $post_type ) {
    $array = array();
    // Get title of all posts of given post type
    $args = array( 'post_type' => $post_type );
    $query = new WP_Query( $args );
    if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
      array_push($array, get_the_title());
    endwhile; endif; wp_reset_postdata();
    // Create keys for the array by "transliterating"/formatting it to a slug-like string (that is matched in the client-side code and used to sort)
    $array_slugified = array();
    foreach ($array as $release) {
      array_push($array_slugified, slugify($release, true));
    }
    // Combine to an array with slug as key and title as value
    $array = array_combine( $array_slugified, $array );
    return $array;
  }

  // Generic function to automatically set/update select options for a custom field in the wp-admin
  function acf_load_field_choices( $field, &$slug_value_array ) {  // '&' referencing variable from global scope
    $field['choices'] = array(); // reset choices
    if ( !empty($slug_value_array) ) {
      foreach ($slug_value_array as $key => $value) {
        $field['choices'][$key] = $value;
      }
    }
    return $field;
  }

  // Automatically set/update select options for the custom field 'release' to include every release created
  $all_releases = build_slug_value_array( 'release' );
  function acf_load_release_field_choices( $field ) {
    global $all_releases;
    return acf_load_field_choices( $field, $all_releases );
  }
  add_filter('acf/load_field/name=release', 'acf_load_release_field_choices');

  // Automatically set/update select options for the custom field 'tour' to include every tour created
  $all_tours = build_slug_value_array( 'tour' );
  function acf_load_tour_field_choices( $field ) {
    global $all_tours;
    return acf_load_field_choices( $field, $all_tours );
  }
  add_filter('acf/load_field/name=tour', 'acf_load_tour_field_choices');

  // ##### Enabling custom field sortable column for a custom post type #####
  // In this case the 'Concert' post type gets a 'Concert date' column that the concerts can be sorted by (only on admin side though!)
  // Set label for the column + remove default publish date column
  function columns_head_concerts($defaults) {
    $defaults['concert_date'] = 'Concert date';
    unset($defaults['date']);
    return $defaults;
  }

  // If a date is present display it in the specified format for each concert entry
  function columns_content_concerts($column_name, $post_ID) {
    if ( $column_name == 'concert_date' ) {
      $concert_date = get_field('concert_date', $post_ID);
      if ( $concert_date ) {
        $date = new DateTime($concert_date);
        echo '<h2>' . $date->format('j/n/Y') . '</h2>';
      }
    }
  }

  add_filter('manage_concert_posts_columns', 'columns_head_concerts', 10);
  add_action('manage_concert_posts_custom_column', 'columns_content_concerts', 10, 2);

  // Activate sortablility concert_date
  function columns_sortable_concerts($columns) {
    $columns['concert_date'] = 'concert_date';
    return $columns;
  }

  // Activate sortability of concerts in the admin
  function order_by_concert_date_column( $query ) {
    if ( !is_admin() ) return; // Check that we are on serverside (wp-admin)
    $orderby = $query->get( 'orderby' );
    if ( 'concert_date' == $orderby ) { // When 'Concert date' column label is clicked (and 'concert_date' thereby set as $orderby) hook into that query and query with
      $query->set( 'meta_key', 'concert_date' ); // ... custom field with key 'concert_date'
      $query->set( 'orderby', 'meta_value_num' ); // ... order by the value of this field for each concert (as a number -> 'meta_value_NUM')
    }
  }

  add_filter( 'manage_edit-concert_sortable_columns', 'columns_sortable_concerts' );
  add_action( 'pre_get_posts', 'order_by_concert_date_column' );

  // ##### Enabling custom field sortable column for a custom post type #####
  // In this case the 'Video' post type gets a 'Video release date' column that the videos can be sorted by (only on admin side though!)
  // Set label for the column + remove default publish date column
  function columns_head_videos($defaults) {
    $defaults['video_release_date'] = 'Video release date';
    unset($defaults['date']);
    return $defaults;
  }

  // If a date is present display it in the specified format for each video entry
  function columns_content_videos($column_name, $post_ID) {
    if ( $column_name == 'video_release_date' ) {
      $video_release_date = get_field('video_release_date', $post_ID);
      if ( $video_release_date ) {
        $date = new DateTime($video_release_date);
        echo '<h2>' . $date->format('j/n/Y') . '</h2>';
      }
    }
  }

  add_filter('manage_video_posts_columns', 'columns_head_videos', 10);
  add_action('manage_video_posts_custom_column', 'columns_content_videos', 10, 2);

  // Activate sortablility on video_release_date
  function columns_sortable_videos($columns) {
    $columns['video_release_date'] = 'video_release_date';
    return $columns;
  }

  // Activate sortability of videos in the admin
  function order_by_video_release_date_column( $query ) {
    if ( !is_admin() ) return; // Check that we are on serverside (wp-admin)
    $orderby = $query->get( 'orderby' );
    if ( 'video_release_date' == $orderby ) { // When 'Concert date' column label is clicked (and 'video_release_date' thereby set as $orderby) hook into that query and query with
      $query->set( 'meta_key', 'video_release_date' ); // ... custom field with key 'video_release_date'
      $query->set( 'orderby', 'meta_value_num' ); // ... order by the value of this field for each video (as a number -> 'meta_value_NUM')
    }
  }

  add_filter( 'manage_edit-video_sortable_columns', 'columns_sortable_videos' );
  add_action( 'pre_get_posts', 'order_by_video_release_date_column' );

  // ##### Enabling custom field sortable column for a custom post type #####
  // In this case the 'Track' post type gets a 'Release' column that the tracks can be sorted by (only on admin side though!)
  // Set label for the column + remove default publish date column
  function columns_head_tracks($defaults) {
    $defaults['release'] = 'Release';
    $defaults['tracklist_number'] = 'Tracklist number';
    unset($defaults['date']);
    return $defaults;
  }

  // If a date is present display it in the specified format for each track entry
  function columns_content_tracks($column_name, $post_ID) {
    if ( $column_name == 'release' ) {
      $release = get_field('release', $post_ID);
      $field = get_field_object('release');
      $label = $field['choices'][$release];
      if ( $label ) {
        echo '<h2>' . $label . '</h2>';
      }
    }
    if ( $column_name == 'tracklist_number' ) {
      $tracklist_number = get_field('tracklist_number', $post_ID);
      if ( $tracklist_number ) {
        echo '<h2>' . $tracklist_number . '</h2>';
      }
    }
  }

  add_filter('manage_track_posts_columns', 'columns_head_tracks', 10);
  add_action('manage_track_posts_custom_column', 'columns_content_tracks', 10, 2);

  // Activate sortablility on release
  function columns_sortable_tracks($columns) {
    $columns['release'] = 'release';
    $columns['tracklist_number'] = 'tracklist_number';
    return $columns;
  }

  add_filter( 'manage_edit-track_sortable_columns', 'columns_sortable_tracks' );

  // Activate sortability of tracks in the admin
  function order_by_release_column( $query ) {
    if ( !is_admin() ) return; // Check that we are on serverside (wp-admin)
    $orderby = $query->get( 'orderby' );
    if ( 'release' == $orderby ) { // When 'Concert date' column label is clicked (and 'release' thereby set as $orderby) hook into that query and query with
      $query->set( 'meta_key', 'release' ); // ... custom field with key 'release'
      $query->set( 'orderby', 'meta_value' ); // ... order by the value of this field for each track
    }
  }

  add_action( 'pre_get_posts', 'order_by_release_column' );

  function order_by_tracklist_number_column( $query ) {
    if ( !is_admin() ) return; // Check that we are on serverside (wp-admin)
    $orderby = $query->get( 'orderby' );
    if ( 'tracklist_number' == $orderby ) { // When 'Concert date' column label is clicked (and 'tracklist_number' thereby set as $orderby) hook into that query and query with
      $query->set( 'meta_key', 'tracklist_number' ); // ... custom field with key 'tracklist_number'
      $query->set( 'orderby', 'meta_value_num' ); // ... order by the value of this field for each track (as a number -> 'meta_value_NUM')
    }
  }

  add_action( 'pre_get_posts', 'order_by_tracklist_number_column' );

  // ----- Sorting ACF repeaters by subfield-key (takes effect on both front- and backend)
  // Concerts by date
  function concerts_acf_load_value( $value, $post_id, $field ) {
  	$order = array();
  	if( empty($value) ) { return $value; }
  	foreach( $value as $i => $row ) { $order[ $i ] = strtotime($row['field_5a18259f341ca']); } // KEY of the field (visible by toggling it under Screen Options i WP admin)
  	array_multisort( $order, SORT_ASC, $value );
  	return $value;
  }
  add_filter('acf/load_value/name=concerts', 'concerts_acf_load_value', 10, 3);
  // Tracks by tracklist number
  function tracks_acf_load_value( $value, $post_id, $field ) {
    $order = array();
    if( empty($value) ) { return $value; }
    foreach( $value as $i => $row ) { $order[ $i ] = $row['field_5a18386226a05']; } // KEY of the field (visible by toggling it under Screen Options i WP admin)
    array_multisort( $order, SORT_ASC, $value );
    return $value;
  }
  add_filter('acf/load_value/name=tracks', 'tracks_acf_load_value', 10, 3);

?>

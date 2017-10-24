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
    wp_localize_script( 'main_js', 'wp', array(
      'rest_root' => esc_url_raw( rest_url() ),
      'routes'    => rest_theme_routes(),
    ));

    // PROD
    // wp_enqueue_script( 'main_min_js', get_template_directory_uri() . '/dist/js/main.min.js', array(), '', true );
    // Making the rest url dynamically available to the JavaScript
    // wp_localize_script( 'main_min_js', 'wp', array(
    //   'rest_root' => esc_url_raw( rest_url() ),
    //   'routes'    => rest_theme_routes(),
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

  // Disable possibility of changing theme
  add_action('admin_init', 'remove_theme_menus');
  function remove_theme_menus() {
    global $submenu;
    unset($submenu['themes.php'][5]);
    unset($submenu['themes.php'][15]);
  }

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

?>

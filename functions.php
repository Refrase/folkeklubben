<?php

  // Styling
  function folkeklubben_theme_styles() {
    wp_enqueue_style( 'style_bundle', get_template_directory_uri() . '/dist/css/style.min.css' );
    wp_enqueue_style( 'style', get_template_directory_uri() . '/style.css', array( 'style_bundle' ) );
  } add_action( 'wp_enqueue_scripts', 'folkeklubben_theme_styles' );

  // Scripts
  function folkeklubben_theme_js() {

    // DEV
    wp_enqueue_script( 'main_js', get_template_directory_uri() . '/js/main.js', array(), null, true );
    // Making the rest url dynamically available to the JavaScript
    wp_localize_script( 'main_js', 'wp', array( 'rest_root' => esc_url_raw( rest_url() ) ) );

    // PROD
    // wp_enqueue_script( 'main_min_js', get_template_directory_uri() . '/dist/js/main.min.js', array(), '', true );
    // // Making the rest url dynamically available to the JavaScript
    // wp_localize_script( 'main_min_js', 'wp', array( 'rest_root' => esc_url_raw( rest_url() ) ) );

  } add_action( 'wp_enqueue_scripts', 'folkeklubben_theme_js' );

?>

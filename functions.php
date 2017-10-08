<?php

  // Styling
  function folkeklubben_theme_styles() {
    wp_enqueue_style( 'style_bundle', get_template_directory_uri() . '/dist/css/style.min.css' );
    wp_enqueue_style( 'style', get_template_directory_uri() . '/style.css', array( 'style_bundle' ) );
  } add_action( 'wp_enqueue_scripts', 'folkeklubben_theme_styles' );

  // Scripts
  function folkeklubben_theme_js() {
    // wp_enqueue_script( 'main_js', get_template_directory_uri() . '/dist/js/main.min.js', array(), '', true );
  } add_action( 'wp_enqueue_scripts', 'folkeklubben_theme_js' );

?>

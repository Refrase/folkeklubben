<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <?php wp_head(); ?>
</head>
<body>

  <div id="content">
    <?php
      if ( have_posts() ) :

        if ( is_home() && ! is_front_page() ) {
          echo '<h1>' . single_post_title( '', false ) . '</h1>';
        }

        while ( have_posts() ) : the_post();

          if ( is_singular() ) {
            the_title( '<h1>', '</h1>' );
          } else {
            the_title( '<h2><a href="' . esc_url( get_permalink() ) . '">', '</a></h2>' );
          }

          the_content();

        endwhile;

      endif;
    ?>
  </div>

  <div id="app"></div>

  <script src="http://localhost:8080/js/main.js"></script>

  <?php wp_footer(); ?>
</body>
</html>

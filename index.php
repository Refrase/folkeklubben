<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/dist/assets/icons/favicon.ico">
  <link rel="icon" type="image/png" href="<?php bloginfo('template_directory'); ?>/dist/assets/icons/favicon-16x16.png" sizes="16x16" />
  <link rel="icon" type="image/png" href="<?php bloginfo('template_directory'); ?>/dist/assets/icons/favicon-32x32.png" sizes="32x32" />
  <style type="text/css">
    /* MailChimp error message */
    #mce-error-response {
      color: white;
      padding: 8px 32px;
      font-family: arial, sans-serif;
      font-size: 10px;
      text-transform: uppercase;
      font-weight: bold;
      width: 100%;
      margin-top: 35px;
      text-align: center;
      display: block;
      position: absolute;
      background-color: #FB5B64;
      color: #b54248;
    }
  </style>
  <?php wp_head(); ?>
</head>
<body>
  <div id="fb-root"></div>
  <!--<div>Put PHP content here - eg. for better Google ranking purposes </div>-->
  <div id="app"></div>
  <?php wp_footer(); ?>
</body>
</html>

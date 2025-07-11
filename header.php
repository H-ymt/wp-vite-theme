<!doctype html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo("charset"); ?>">
  <meta name="viewport" ∫∫∫content="width=device-width, initial-scale=1">
  <meta name="format-detection" content="telephone=no">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="robots" content="index, follow">
  <meta property="og:image" content="">
  <meta property="og:title" content="">
  <meta property="og:description" content="">
  <meta property="og:type" content="website">
  <meta property="og:url" content="<?php echo esc_url(home_url("/")); ?>">
  <meta name="twitter:card" content="summary">
  <meta name="twitter:url" content="<?php echo esc_url(home_url("/")); ?>">

  <link rel="canonical" href="<?php echo esc_url(home_url("/")); ?>">

  <title>
    <?php
    wp_title("|", true, "right");
    bloginfo("name");
    ?>
  </title>

  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <?php wp_body_open();

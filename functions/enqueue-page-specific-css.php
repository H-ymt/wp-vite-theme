<?php
function enqueue_page_specific_css()
{
  $page_css_file = '';

  if (is_front_page()) {
    $page_css_file = 'front-page.css';
  } elseif (is_page()) {
    global $post;
    $page_template = get_page_template_slug($post->ID);

    if ($page_template) {
      // page-sample.php の場合は page-sample.css
      $template_name = basename($page_template, '.php');
      $page_css_file = $template_name . '.css';
    } else {
      $page_css_file = 'page.css';
    }
  } elseif (is_single()) {
    $page_css_file = 'single.css';
  } elseif (is_archive() || is_home()) {
    $page_css_file = 'archive.css';
  }

  if (!empty($page_css_file)) {
    $css_path = get_template_directory() . '/assets/css/page/' . $page_css_file;

    if (file_exists($css_path)) {
      if (defined('IS_VITE_DEVELOPMENT') && IS_VITE_DEVELOPMENT === true) {
        // 開発環境：Viteサーバーから読み込み
        wp_enqueue_style(
          'page-specific-css',
          'http://localhost:3000/assets/css/page/' . $page_css_file,
          array(),
          time()
        );
      } else {
        // 本番環境：ビルドされたファイルから読み込み
        wp_enqueue_style(
          'page-specific-css',
          get_template_directory_uri() . '/assets/css/page/' . $page_css_file,
          array(),
          filemtime($css_path)
        );
      }
    }
  }
}

add_action('wp_enqueue_scripts', 'enqueue_page_specific_css', 20);

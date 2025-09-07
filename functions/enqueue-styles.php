<?php
function enqueue_page_specific_css()
{
  $page_css_file = "";

  if (function_exists('get_page_css_slug')) {
    $slug = get_page_css_slug();
  } else {
    $slug = '';
  }

  if (!empty($slug)) {
    $page_css_file = $slug . '.css';
  }

  if (!empty($page_css_file)) {
    // 開発: Vite サーバーを常に参照（存在チェック不可）
    if (defined("IS_VITE_DEVELOPMENT") && IS_VITE_DEVELOPMENT === true) {
      wp_enqueue_style("page-specific-css", VITE_SERVER . "/assets/css/page/" . $page_css_file, [], time());
      return;
    }

    // 本番: dist 配下またはテーマ内にファイルが存在する場合にのみ読み込む
    $enqueued = false;

    if (defined('DIST_PATH') && defined('DIST_URI')) {
      $dist_css_path = DIST_PATH . "/assets/css/page/" . $page_css_file;
      if (file_exists($dist_css_path)) {
        wp_enqueue_style("page-specific-css", DIST_URI . "/assets/css/page/" . $page_css_file, [], filemtime($dist_css_path));
        $enqueued = true;
      }
    }

    if (!$enqueued) {
      $css_path = get_template_directory() . "/assets/css/page/" . $page_css_file;
      if (file_exists($css_path)) {
        wp_enqueue_style("page-specific-css", get_template_directory_uri() . "/assets/css/page/" . $page_css_file, [], filemtime($css_path));
        $enqueued = true;
      }
    }
  }
}

add_action("wp_enqueue_scripts", "enqueue_page_specific_css", 20);


/**
 * 現在のページに対応する CSS スラッグを返す。
 * 例: 'front-page', 'page-sample', 'page', 'single', 'archive'
 *
 * @return string
 */
function get_page_css_slug()
{
  if (is_front_page()) {
    return 'front-page';
  }

  if (is_page()) {
    global $post;
    $page_template = get_page_template_slug($post->ID);

    if ($page_template) {
      return basename($page_template, '.php');
    }

    return 'page';
  }

  if (is_single()) {
    return 'single';
  }

  if (is_archive() || is_home()) {
    return 'archive';
  }

  return '';
}

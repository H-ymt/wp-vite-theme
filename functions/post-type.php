
<?php
function register_custom_post_types_and_taxonomies()
{
  $post_types = [
    "sample" => [
      "label" => "sample",
      "menu_icon" => "dashicons-edit",
      "has_archive" => true,
      "menu_position" => 2,
      "slug" => "sample",
      "supports" => ["title", "editor", "thumbnail", "custom-fields"],
    ],
  ];

  $taxonomies = [
    "sample-category" => [
      "post_type" => "sample",
      "labels" => [
        "name" => "カテゴリー",
        "singular_name" => "カテゴリー",
        "menu_name" => "カテゴリー",
      ],
    ],
  ];

  foreach ($post_types as $post_type => $config) {
    $args = [
      "public" => true,
      "label" => $config["label"],
      "supports" => $config["supports"],
      "menu_icon" => $config["menu_icon"],
      "show_in_rest" => true,
      "capability_type" => "post",
      "menu_position" => $config["menu_position"],
      "rewrite" => ["slug" => $config["slug"]],
    ];

    if ($config["has_archive"]) {
      $args["has_archive"] = true;
    }

    register_post_type($post_type, $args);
  }

  foreach ($taxonomies as $taxonomy => $config) {
    $base_labels = $config["labels"];

    $args = [
      "label" => $base_labels["name"],
      "hierarchical" => true,
      "public" => true,
      "show_ui" => true,
      "show_admin_column" => true,
      "show_in_nav_menus" => true,
      "show_tagcloud" => true,
      "show_in_rest" => true,
      "rewrite" => ["slug" => $taxonomy],
      "labels" => [
        "name" => $base_labels["name"],
        "singular_name" => $base_labels["singular_name"],
        "search_items" => $base_labels["singular_name"] . "を検索",
        "all_items" => "すべての" . $base_labels["singular_name"],
        "parent_item" => "親" . $base_labels["singular_name"],
        "parent_item_colon" => "親" . $base_labels["singular_name"] . ":",
        "edit_item" => $base_labels["singular_name"] . "を編集",
        "update_item" => $base_labels["singular_name"] . "を更新",
        "add_new_item" => "新しい" . $base_labels["singular_name"] . "を追加",
        "new_item_name" => "新しい" . $base_labels["singular_name"] . "名",
        "menu_name" => $base_labels["menu_name"],
      ],
    ];

    register_taxonomy($taxonomy, $config["post_type"], $args);
  }
}
add_action("init", "register_custom_post_types_and_taxonomies");

function enable_post_thumbnails_support()
{
  add_theme_support("post-thumbnails");
}
add_action("after_setup_theme", "enable_post_thumbnails_support");

function remove_default_post_type()
{
  remove_menu_page("edit.php");
}
add_action("admin_menu", "remove_default_post_type");


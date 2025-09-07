<?php
// Exit if accessed directly
if (!defined("ABSPATH")) {
  exit();
}

// Main switch to get frontend assets from a Vite dev server OR from production built folder
// it is recommended to move it into wp-config.php
define("IS_VITE_DEVELOPMENT", true);

include "config/vite.php";
require_once "functions/post-type.php";
require_once "functions/enqueue-styles.php";

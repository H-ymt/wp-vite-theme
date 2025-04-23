<?php
function create_custom_post_type()
{
  $args = array(
    'public' => true,
    'label'  => 'Custom Post',
    // Add more arguments as needed
  );
  register_post_type('custom_post_type', $args);
}
add_action('init', 'create_custom_post_type');

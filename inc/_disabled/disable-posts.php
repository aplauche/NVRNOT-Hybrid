<?php 
/**
 * Hide the links to edit posts to clean up the dashboard
 */

 namespace nvrnot;

// Remove "Posts" from the Admin Menu
function remove_posts_menu_item() {
  // if(!current_user_can('manage_options')){
    remove_menu_page('edit.php'); 
  // }
}
add_action('admin_menu', __NAMESPACE__ . '\remove_posts_menu_item');

// Remove "Posts" from the Admin Toolbar
function remove_posts_from_toolbar($wp_admin_bar) {
  $wp_admin_bar->remove_node('new-post'); // Removes "New Post" from the toolbar
}
add_action('admin_bar_menu', __NAMESPACE__ . '\remove_posts_from_toolbar', 999);

// Remove all post supports
add_action('admin_init', function () {
  remove_post_type_support('post', 'editor');
  remove_post_type_support('post', 'thumbnail');
  remove_post_type_support('post', 'comments');
  remove_post_type_support('post', 'revisions');
});

// Redirect post, category, and tag pages
add_action('template_redirect', function () {
  if (is_singular('post') || is_category() || is_tag()) {
      wp_redirect(home_url());
      exit;
  }
});

// Remove Categories and Tags
add_action('init', function () {
  unregister_taxonomy_for_object_type('category', 'post');
  unregister_taxonomy_for_object_type('post_tag', 'post');
}, 10);

// Hide posts and categories from nav menu editor
add_action('admin_head-nav-menus.php', function () {
  remove_meta_box('add-post', 'nav-menus', 'side'); // Removes Posts
  remove_meta_box('add-category', 'nav-menus', 'side'); // Removes Categories
});

// add_action('init', function () {
//   global $wp_rewrite;
//   unset($wp_rewrite->extra_permastructs['category']);
//   unset($wp_rewrite->extra_permastructs['post_tag']);
// });
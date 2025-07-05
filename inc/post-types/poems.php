<?php 

namespace nvrnot;

// Register Poem Custom Post Type
function create_poem_post_type() {
  register_post_type('poem', [
      'labels' => [
          'name'               => 'Poems',
          'singular_name'      => 'Poem',
          'add_new_item'       => 'Add New Poem',
          'edit_item'          => 'Edit Poem',
          'new_item'           => 'New Poem',
          'view_item'          => 'View Poem',
          'search_items'       => 'Search Poems',
          'not_found'          => 'No poems found',
          'not_found_in_trash' => 'No poems found in Trash',
      ],
      'menu_icon' => 'dashicons-book',
      'public'             => true,
      'has_archive'        => true,
      'rewrite'            => [
          'slug' => 'poems',
          'with_front' => false, // Optional: remove the blog prefix if your permalinks have it
      ],
      'supports'           => ['title', 'editor', 'excerpt'],
      'show_in_rest'       => true,
      'template' => [
          ['core/verse', [
              'placeholder' => 'Paste your poem here...',
          ]],
      ],
      'template_lock'      => 'all', // Set to 'all' if you want to lock the template
  ]);
}
// add_action('init', __NAMESPACE__ . '\create_poem_post_type');

// Register Theme Taxonomy (Tag-style)
function register_theme_taxonomy() {
  register_taxonomy('theme', 'poem', [
      'labels' => [
          'name'          => 'Themes',
          'singular_name' => 'Theme',
          'search_items'  => 'Search Themes',
          'all_items'     => 'All Themes',
          'edit_item'     => 'Edit Theme',
          'update_item'   => 'Update Theme',
          'add_new_item'  => 'Add New Theme',
          'new_item_name' => 'New Theme Name',
      ],
      'hierarchical' => true, // Tag-style
      'show_in_rest' => true,
      'rewrite'      => ['slug' => 'themes'],
  ]);
}
//add_action('init', __NAMESPACE__ . '\register_theme_taxonomy');

// Register Workshop Taxonomy (Category-style)
function register_workshop_taxonomy() {
  register_taxonomy('workshop', 'poem', [
      'labels' => [
          'name'          => 'Workshops',
          'singular_name' => 'Workshop',
          'search_items'  => 'Search Workshops',
          'all_items'     => 'All Workshops',
          'parent_item'   => 'Parent Workshop',
          'edit_item'     => 'Edit Workshop',
          'update_item'   => 'Update Workshop',
          'add_new_item'  => 'Add New Workshop',
          'new_item_name' => 'New Workshop Name',
      ],
      'hierarchical' => true, // Category-style
      'show_in_rest' => true,
      'rewrite'      => ['slug' => 'workshops'],
  ]);
}
//add_action('init', __NAMESPACE__ . '\register_workshop_taxonomy');




// Restrict blocks for the Poem post type
function restrict_blocks_for_poems($allowed_blocks, $editor_context) {
  // Ensure this applies only to the poem post type
  if (!empty($editor_context->post) && $editor_context->post->post_type === 'poem') {
      // Specify allowed blocks
      return [
          'core/paragraph',
          'core/heading',
          'core/verse',
          'core/list',
      ];
  }

  // Return default blocks for other post types
  return $allowed_blocks;
}
//add_filter('allowed_block_types_all', __NAMESPACE__ . '\restrict_blocks_for_poems', 10, 2);


?>
<?php
/*
Plugin Name:    Admin Columns - News Link
Plugin URI:     PLUGIN_URL
Description:    Adds a custom column from the custom field `Link External`
Version:        1.0
Author:         BlueVine
Author URI:     https://www.bluevine.com
License:        GPLv2 or later
License URI:    http://www.gnu.org/licenses/gpl-2.0.html
*/

// 1. Set text domain
/* @link https://codex.wordpress.org/Function_Reference/load_plugin_textdomain */
load_plugin_textdomain('ac-news-link', false, plugin_dir_path(__FILE__) . '/languages/');

// 2. Register the column.
add_action('ac/column_types', 'ac_register_column_news_link');

function ac_register_column_news_link(\AC\ListScreen $list_screen)
{

  // Use the type: 'post', 'user', 'comment' or 'media'.
  if ('post' === $list_screen->get_group()) {

    require_once plugin_dir_path(__FILE__) . 'ac-column-news-link.php';

    $list_screen->register_column_type(new AC_Column_News_Link);
  }
}

// -------------------------------------- //
// This part is for the PRO version only. //
// -------------------------------------- //

// 3. (Optional) Register the PRO column.
add_action('ac/column_types', 'ac_register_pro_column_news_link');

function ac_register_pro_column_news_link(\AC\ListScreen $list_screen)
{
  if (!class_exists('\ACP\AdminColumnsPro')) {
    return;
  }

  // Use the type: 'post', 'user', 'comment', 'media' or 'taxonomy'.
  if ('post' === $list_screen->get_group()) {

    require_once plugin_dir_path(__FILE__) . 'ac-column-news-link.php';
    require_once plugin_dir_path(__FILE__) . 'acp-column-news-link.php';

    $list_screen->register_column_type(new ACP_Column_News_Link);
  }
}

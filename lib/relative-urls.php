<?php
/**
 * Root relative URLs
 *
 * WordPress likes to use absolute URLs on everything - let's clean that up.
 * Inspired by http://www.456bereastreet.com/archive/201010/how_to_make_wordpress_urls_mdfwbootstrap_relative/
 *
 * You can enable/disable this feature in config.php:
 * current_theme_supports('mdfwbootstrap-relative-urls');
 *
 * @author Scott Walkinshaw <scott.walkinshaw@gmail.com>
 */
function mdfwbootstrap_mdfwbootstrap_relative_url($input) {
  preg_match('|https?://([^/]+)(/.*)|i', $input, $matches);

  if (isset($matches[1]) && isset($matches[2]) && $matches[1] === $_SERVER['SERVER_NAME']) {
    return wp_make_link_relative($input);
  } else {
    return $input;
  }
}

function mdfwbootstrap_enable_mdfwbootstrap_relative_urls() {
  return !(is_admin() || in_array($GLOBALS['pagenow'], array('wp-login.php', 'wp-register.php'))) && current_theme_supports('mdfwbootstrap-relative-urls');
}

if (mdfwbootstrap_enable_mdfwbootstrap_relative_urls()) {
  $mdfwbootstrap_rel_filters = array(
    'bloginfo_url',
    'the_permalink',
    'wp_list_pages',
    'wp_list_categories',
    'mdfwbootstrap_wp_nav_menu_item',
    'the_content_more_link',
    'the_tags',
    'get_pagenum_link',
    'get_comment_link',
    'month_link',
    'day_link',
    'year_link',
    'tag_link',
    'the_author_posts_link',
    'script_loader_src',
    'style_loader_src'
  );

  add_filters($mdfwbootstrap_rel_filters, 'mdfwbootstrap_mdfwbootstrap_relative_url');
}

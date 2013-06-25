<?php
/**
 * Theme wrapper
 *
 * @link http://scribu.net/wordpress/theme-wrappers.html
 */
function mdfwbootstrap_template_path() {
  return Mdfwbootstrap_Wrapping::$main_template;
}

function mdfwbootstrap_sidebar_path() {
  return Mdfwbootstrap_Wrapping::sidebar();
}

class Mdfwbootstrap_Wrapping {
  // Stores the full path to the main template file
  static $main_template;

  // Stores the base name of the template file; e.g. 'page' for 'page.php' etc.
  static $base;

  static function wrap($template) {
    self::$main_template = $template;

    self::$base = substr(basename(self::$main_template), 0, -4);

    if (self::$base === 'index') {
      self::$base = false;
    }

    $templates = array('base.php');

    if (self::$base) {
      array_unshift($templates, sprintf('base-%s.php', self::$base));
    }

    $templates = apply_filters('mdfwbootstrap_wrap_base', $templates);
    return locate_template($templates);
  }

  static function sidebar() {
    $templates = array('templates/sidebar.php');

    if (self::$base) {
      array_unshift($templates, sprintf('templates/sidebar-%s.php', self::$base));
    }

    $templates = apply_filters('mdfwbootstrap_wrap_sidebar', $templates);
    return locate_template($templates);
  }
}
add_filter('template_include', array('Mdfwbootstrap_Wrapping', 'wrap'), 99);

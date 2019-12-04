<?php
/**
 * Class Breadcrumbs
 * Creates an instance that generates HTML & a schema for breadcrumbs
 * It takes an array for the structure
 */

class Breadcrumbs {
  public function __construct($links) {
    $this->render($links);
  }
  private function render($links) {
    ob_start();
    require_once  plugin_dir_path(__FILE__) . '/tmpl/breadcrumbs.view.php';
    echo ob_get_clean();
  }
}
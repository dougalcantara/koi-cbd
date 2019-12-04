<?php
/**
 * Class Breadcrumbs
 * Creates an instance that generates HTML & a schema for breadcrumbs
 * It takes an array for the structure
 */

class Breadcrumbs {
  public function __construct($links) {
    $this->render($links);
    $this->generateJSON($links);
  }
  private function render($links) {
    ob_start();
    require_once  plugin_dir_path(__FILE__) . '/tmpl/breadcrumbs.view.php';
    echo ob_get_clean();
  }
  private function generateJSON($links) {
    $list = [];
    foreach($links as $i => $link) {
      array_push($list, [
        '@type' => 'ListItem',
        'position' => ++$i,
        'name' => $link['name'],
        'item' => $link['url']
      ]);
    }
    $schema = [
      '@context' => 'https://schema.org',
      '@type' => 'BreadcrumbList',
      'itemListElement' => $list
    ];
    echo "<script type='application/ld+json'>".json_encode($schema)."</script>";
  }
}
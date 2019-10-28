<?php
$url = site_url();
$root = get_template_directory_uri();

$resources = array(
  'lab_results' => array(
    'title' => 'Lab Results',
    'description' => 'All Koi CBD products are lab-tested in California for purity, consistency, and safety.',
    'link_text' => 'See Lab Results',
    'url' => $url . '/lab-results',
  ),
  'faqs' => array(
    'title' => 'FAQs',
    'description' => 'All Koi CBD products are lab-tested in California for purity, consistency, and safety.',
    'link_text' => 'View FAQs',
    'url' => $url . '/contact',
  ),
  'blog_posts' => array(
    'title' => 'Blog Posts',
    'description' => 'All Koi CBD products are lab-tested in California for purity, consistency, and safety.',
    'link_text' => 'Live the #KoiCBDLife',
    'url' => $url . '/blog',
  ),
);
?>

<section class="k-resourcescallout k-block k-block--md">
  <div class="k-resourcescallout__bgimg" data-src="<?php echo $root . '/dist/img/generic-countertop.jpg' ?>"></div>
  <div class="k-inner k-inner--md">
    <div class="k-resourcescallout__content">
      <?php
        foreach($resources as $item) { ?>
          <div class="k-resourcescallout__item">
            <div class="k-resourcescallout__title">
              <h2><?php echo $item['title']; ?></h2>
            </div>
            <div class="k-resourcescallout__description k-rte-content">
              <p><?php echo $item['description']; ?></p>
            </div>
            <div class="k-resourcescallout__action">
              <a href="<?php echo $item['url'] ?>"><?php echo $item['link_text']; ?></a>
            </div>
          </div>
        <?php
        }
      ?>
    </div>
  </div>
</section>

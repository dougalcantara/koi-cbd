<?php
  $root = get_template_directory_uri();
?>

<section class="k-promoslider k-block k-block--md k-half-padding--top">
  <div class="k-inner k-inner--md">
    <div class="k-promoslider--titlerow">
      <span class="k-upcase k-promoslider--titlerow__item">Featured</span>
      <h2 class="k-headline k-headline--sm k-promoslider--titlerow__item">CBD Comes in All Forms. Find Yours Here.</h2>
      <a href="#0" class="k-upcase k-promoslider--titlerow__item">Shop All</a>
    </div>
  </div>
  <div class="k-inner k-inner--md">
    <div class="k-promoslider--carousel">
    <?php
      for ($i = 0; $i < 12; $i++) {
        echo k_product_card(array(
          'product_image_url' => $root.'/dist/img/blue-koi-vape-juice.jpg',
        ));
      }
    ?>
    </div>
  </div>
</section>

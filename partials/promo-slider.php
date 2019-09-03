<?php
  $root = get_template_directory_uri();
?>

<section class="k-promoslider k-block k-block--md">
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

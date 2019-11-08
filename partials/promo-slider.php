<?php
  $root = get_template_directory_uri();
?>

<section
  class="
    k-promoslider
    k-block
    k-block--md
    <?php echo $slider_fields['half_padding_top'] ? 'k-half-padding--top' : '' ?>
    <?php echo $slider_fields['half_padding_bottom'] ? 'k-half-padding--bottom' : '' ?>
  ">
  <div class="k-inner k-inner--md">
    <div class="k-promoslider--titlerow">
      <span class="k-upcase k-promoslider--titlerow__item">Featured</span>
      <h2 class="k-headline k-headline--sm k-promoslider--titlerow__item"><?php echo $slider_fields['headline']; ?></h2>
      <a href="#0" class="k-upcase k-promoslider--titlerow__item">Shop All</a>
    </div>
  </div>
  <div class="k-inner k-inner--md">
    <div class="k-promoslider--carousel">
    <?php
      foreach($slider_fields['products'] as $product_ref) {
        $product = get_post($product_ref['product']->ID);
        $product_image = wp_get_attachment_image_src(get_post_thumbnail_id($product_ref['product']->ID), array(300, 300));

        $card_fields = array(
          'product_image_url' => $product_image[0],
          'product_title' => $product->post_title,
          'product_link' => get_the_permalink($product),
          'product_id' => $product->ID,
        );
        
        echo k_product_card($card_fields);
      }
    ?>
    </div>

    <div class="k-promoslider__controls">
      <svg id="k-promoslider__prev" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
      <svg id="k-promoslider__next" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
    </div>
  </div>
</section>

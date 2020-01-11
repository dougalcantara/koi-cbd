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
      <a href="<?php echo get_home_url();?>/cbd-products" class="k-upcase k-promoslider--titlerow__item">Shop All</a>
    </div>
  </div>
  <div class="k-inner k-inner--md">
    <div class="k-promoslider--carousel">
    <?php
      foreach($slider_fields['products'] as $product_ref) {
        $product = get_post($product_ref['product']->ID);
        $product_image = wp_get_attachment_image_src(get_post_thumbnail_id($product_ref['product']->ID), array(300, 300));
        
        /**
         * Need to show lowest price of each product in each card.
         * The trouble is getting that price from each of their different
         * product types - Variable, Simple, Bundle.
         * 
         * The condition below will check for each type and find the lowest
         * price in each case.
         */
        $promo_product = wc_get_product($product_ref['product']->ID);
        $promo_product_type = $promo_product->get_type();

        if ($promo_product_type == 'simple') :
          $product_price = $promo_product->get_price();
        elseif ($promo_product_type == 'variable') :
          // Find the lowest price among the variations of the product
          $all_variation_prices = $promo_product->get_variation_prices()['price'];
          $lowest_price = min($all_variation_prices);
          $product_price = $lowest_price;
        elseif ($promo_product_type == 'bundle') :
          /**
           * Get the bundled items, find out the min # of items needed to make up
           * a bundle, find the discounted rate, add up the discounted price across
           * the min number of items.
           */
          $promo_items_in_bundle = $promo_product->get_bundled_items();
          $min_num_items = get_field('min_items', $product_ref['product']->ID);
          $_count = 0;
          $product_price = 0;

          foreach($promo_items_in_bundle as $p_bundled_item) :
            // only add up totals for the min number of items possible in a bundle
            if ($_count > $min_num_items) continue;

            $p_full_price = $p_bundled_item->get_price();
            $p_discount_amount = $p_bundled_item->get_data()['discount'] / 100;
            $p_price_with_discount = number_format($p_full_price - ($p_discount_amount * $p_full_price), 2);

            $product_price += $p_price_with_discount;
            $_count++;
          endforeach;
        endif;

        $card_fields = array(
          'product_image_url' => $product_image[0],
          'product_title' => $product->post_title,
          'product_link' => get_the_permalink($product),
          'product_id' => $product->ID,
          'product_price' => $product_price,
        );
        
        echo k_product_card($card_fields);
      }
    ?>
    </div>

    <div class="k-promoslider__controls">
      <svg class="k-promoslider__prev" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
      <svg class="k-promoslider__next" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
    </div>
  </div>
</section>

<div class="k-cartcontents">
  <div class="k-cartcontents--liner">

    <div class="k-cartcontents--titlerow">
      <div class="k-cartcontents--col k-cartcontents--image">
        <h1 class="k-headline k-headline--sm">Cart</h1>
      </div>
      <div class="k-cartcontents--col k-cartcontents--name">
        <p class="k-upcase">Name</p>
      </div>
      <div class="k-cartcontents--col k-cartcontents--quantity k-align--right">
        <p class="k-upcase">Quantity</p>
      </div>
      <div class="k-cartcontents--col k-cartcontents--price k-align--right">
        <p class="k-upcase">Price</p>
      </div>
    </div>

    <div class="k-cartcontents--main">
    <?php
    foreach($items_in_cart as $cart_item_key => $cart_item) {
      $_product   = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
      $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

      var_dump($_product);
      // $_product = wc_get_product($cart_item['product_id']);
      // $_variant = wc_get_product($cart_item['variation_id']);

      // $product_id = $_product->get_id();
      // $name = $_product->name;
      // $quantity = $cart_item['quantity'];
      // $item_subtotal = $cart_item['line_subtotal'];

      // var_dump($cart_item_key);

      // if ($_variant) {
      //   $attributes = $_variant->get_variation_attributes();
      // } else {
      //   $attributes = NULL;
      // }

      // if ($attributes) {
      //   $scent = $attributes['attribute_choose'];
      //   $strength = $attributes['attribute_strength'];
      // } else {
      //   $scent = NULL;
      //   $strength = NULL;
      // }
    ?>

    <div class="k-cartcontents--item">

      <div class="k-cartcontents--col k-cartcontents--image">
        <div class="k-cartcontents--col__liner">
          <figure class="k-figure">
            <div class="k-figure--liner">
              <!-- <img src="<?php echo get_the_post_thumbnail_url($product_id); ?>" alt="" class="k-figure--img" /> -->
            </div>
          </figure>
        </div>
      </div>

      <div class="k-cartcontents--col k-cartcontents--name">
        <div class="k-cartcontents--col__liner">
          <!-- <h3 class="k-headline k-headline--mini"><?php echo $name; ?></h3> -->
          <p>
            <!-- <?php
            if ($strength) {
              echo $strength;
            } else {
              echo $scent;
            }
            ?> -->
          </p>
          <!-- <p
            class="k-upcase k-accent-text k-cart-remove-item"
            data-cart-item-key="<?php echo $cart_item_key; ?>"
          >
            Remove
          </p> -->
        </div>
      </div>

      <div class="k-cartcontents--col k-cartcontents--quantity k-productform--quantity k-align--right">
        <div class="k-cartcontents--col__liner">
          <button id="k-reduce">-</button>
          <!-- <input id="k-num-to-add" type="number" value="<?php echo $quantity; ?>" /> -->
          <button id="k-increase">+</button>
        </div>
      </div>

      <div class="k-cartcontents--col k-cartcontents--price k-align--right">
        <div class="k-cartcontents--col__liner">
          <!-- <p>$<?php echo $item_subtotal; ?></p> -->
        </div>
      </div>

    </div>

    <?php
    }
    ?>
    </div>
    
  </div>
  <?php
  if ($items_in_cart) { ?>
    <p class="k-upcase k-accent-text" id="k-cart-remove-all">Remove All</p>
  <?php  
  }
  ?>
  
</div>
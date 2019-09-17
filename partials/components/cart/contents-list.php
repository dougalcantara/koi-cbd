<div class="k-cartcontents">
  <div class="k-cartcontents--liner">

    <div class="k-cartcontents--titlerow">
      <div class="k-cartcontents--col">
        <h1 class="k-headline k-headline--sm">Cart</h1>
      </div>
      <div class="k-cartcontents--col">
        <p class="k-upcase">Name</p>
      </div>
      <div class="k-cartcontents--col k-align--right">
        <p class="k-upcase">Quantity</p>
      </div>
      <div class="k-cartcontents--col k-align--right">
        <p class="k-upcase">Price</p>
      </div>
    </div>

    <div class="k-cartcontents--main">
    <?php
    
    foreach($items_in_cart as $item) {
      $_product = wc_get_product($item['product_id']);
      $id = $_product->get_id();
      $name = $_product->name;
      $num_in_cart = $item['quantity'];
      $item_subtotal = $item['line_subtotal'];
      $strength = wc_get_product($item['variation_id'])->attributes['strength'];
    ?>

    <div class="k-cartcontents--item">

      <div class="k-cartcontents--col">
        <div class="k-cartcontents--col__liner">
          <figure class="k-figure">
            <div class="k-figure--liner">
              <img src="<?php echo get_the_post_thumbnail_url($id); ?>" alt="" class="k-figure--img" />
            </div>
          </figure>
        </div>
      </div>

      <div class="k-cartcontents--col k-cartcontents--name">
        <div class="k-cartcontents--col__liner">
          <h4 class="k-headline k-headline--mini"><?php echo $name; ?></h4>
          <p><?php echo $strength; ?></p>
        </div>
      </div>

      <div class="k-cartcontents--col k-cartcontents--quantity k-align--right">
        <div class="k-cartcontents--col__liner">
          <p><?php echo $num_in_cart; ?></p>
        </div>
      </div>

      <div class="k-cartcontents--col k-align--right">
        <div class="k-cartcontents--col__liner">
          <p>$<?php echo $item_subtotal; ?></p>
        </div>
      </div>

    </div>

    <?php
    }
    ?>
    </div>
    
  </div>
</div>
<?php $root = get_template_directory_uri(); ?>

<section class="k-productdetails k-block k-block--md k-no-padding--bottom">
  <div class="k-inner k-inner--sm">
    <div class="k-productdetails--headline">
      <h2 class="k-headline k-headline--sm"><?php echo $product_acf['product_details_headline']; ?></h2>
    </div>
  </div>

  <div class="k-inner k-inner--md">
    <div class="k-productdetails--main">

      <div class="k-productdetails--image">
        <figure class="k-figure k-figure--rounded">
          <div class="k-figure--liner">
            <?php
              $lifestyle_img = get_fields()['lifestyle_image'];
              $ls_img_url = $lifestyle_img ? $lifestyle_img['url'] : $root . '/dist/img/koi-leaves-placeholder.jpg';
              
            ?>
            <img src="<?php echo $ls_img_url ?>" alt="<?php echo $product->get_title(); ?>" class="k-figure--img">
          </div>
        </figure>
      </div>
    

      <div class="k-productdetails--accordion">
      <?php if ($product_acf['product_details']) : ?>
        <div class="k-productdetails--accordion__item">
          <div class="k-productdetails--accordion__trigger">
            <p class="k-upcase">Product Details <span class="k-weight--lg">+</span></p>
          </div>
          <div class="k-productdetails--accordion__drawer">
            <ul>
              <?php
              foreach($product_acf['product_details'] as $product_details) { ?>
                <li>
                  <p><?php echo $product_details['product_detail']; ?></p>
                </li>
              <?php
              }
              ?>
            </ul>
          </div>
        </div>
        <?php endif; ?>
        <?php if ($product_acf['ingredients']) : ?>
        <div class="k-productdetails--accordion__item">
          <div class="k-productdetails--accordion__trigger">
            <p class="k-upcase">Ingredients <span class="k-weight--lg">+</span></p>
          </div>
          <div class="k-productdetails--accordion__drawer">
            <ul>
              <?php
              foreach($product_acf['ingredients'] as $ingredients) { ?>
                <li>
                  <p><?php echo $ingredients['ingredient']; ?></p>
                </li>
              <?php
              }
              ?>
            </ul>
          </div>
        </div>
        <?php endif; ?>
        <?php if ($product_acf['cbd_concentration']) : ?>
        <div class="k-productdetails--accordion__item">
          <div class="k-productdetails--accordion__trigger">
            <p class="k-upcase">CBD Concentration <span class="k-weight--lg">+</span></p>
          </div>
          <div class="k-productdetails--accordion__drawer">
            <ul>
              <?php
              foreach($product_acf['cbd_concentration'] as $concentration) { ?>
                <li>
                  <p><?php echo $concentration['concentration']; ?></p>
                </li>
              <?php
              }
              ?>
            </ul>
          </div>
        </div>
        <?php endif; ?>        
        <?php if ($product_acf['suggested_uses']) : ?>
        <div class="k-productdetails--accordion__item">
          <div class="k-productdetails--accordion__trigger">
            <p class="k-upcase">Suggested Use <span class="k-weight--lg">+</span></p>
          </div>
          <div class="k-productdetails--accordion__drawer">
            <ul>
              <?php
              foreach($product_acf['suggested_uses'] as $suggested_uses) { ?>
                <li>
                  <p><?php echo $suggested_uses['suggested_use']; ?></p>
                </li>
              <?php
              }
              ?>
            </ul>
          </div>
        </div>
        <?php endif; ?>
        <?php if ($product_acf['storage_directions']) : ?>
        <div class="k-productdetails--accordion__item">
          <div class="k-productdetails--accordion__trigger">
            <p class="k-upcase">Storage <span class="k-weight--lg">+</span></p>
          </div>
          <div class="k-productdetails--accordion__drawer">
            <ul>
              <?php
              foreach($product_acf['storage_directions'] as $storage_directions) { ?>
                <li>
                  <p><?php echo $storage_directions['storage_direction']; ?></p>
                </li>
              <?php
              }
              ?>
            </ul>
          </div>
        </div>
        <?php endif; ?>
        <?php if ($product_acf['warnings']) : ?>
        <div class="k-productdetails--accordion__item">
          <div class="k-productdetails--accordion__trigger">
            <p class="k-upcase">Warning <span class="k-weight--lg">+</span></p>
          </div>
          <div class="k-productdetails--accordion__drawer">
            <ul>
              <?php
              foreach($product_acf['warnings'] as $warnings) { ?>
                <li>
                  <p><?php echo $warnings['warning']; ?></p>
                </li>
              <?php
              }
              ?>
            </ul>
          </div>
        </div>
        <?php endif; ?>
      </div>
    </div>

  </div>
</section>
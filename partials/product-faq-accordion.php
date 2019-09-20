<section class="k-productfaq">
  <div class="k-inner k-inner--xl k-block k-block--md k-full-padding--bottom">
    <div class="k-inner k-inner--md">

      <div class="k-productfaq--title">
        <h2 class="k-headline k-headline--sm"><?php echo $product_category; ?> FAQ</h2>
      </div>

      <div class="k-productfaq--accordion">
        <ul>
        <?php
        foreach($product_acf['frequently_asked_questions'] as $faq_obj) { ?>
          <li class="k-productfaq--accordion__item">
            <div class="k-productfaq--accordion__trigger">
              <h3 class="k-headline k-headline--xs"><?php echo $faq_obj['question']; ?></h3>
            </div>
            <div class="k-productfaq--accordion__drawer">
              <div class="k-productfaq--accordion__drawer--liner">
                <p><?php echo $faq_obj['answer']; ?></p>
              </div>
            </div>
          </li>

        <?php
        }
        ?>
        </ul>
      </div>
      
    </div>
  </div>
</section>
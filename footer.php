<?php
$root = get_template_directory_uri();
?>
  </main>

  <?php
  get_template_part('partials/site-footer');
  ?>

  <div id="k-backdrop"></div>

  <div class="k-modal k-modal--search">
    <div class="k-inner k-inner--sm">
      <div class="k-modal--content">
        <form class="k-form k-form--search">
          <input name="k-search-input" id="k-search-input" type="text" />
          <label for="k-search-input">Search...</label>
          <button type="submit">&rarr;</button>
        </form>
      </div>
      <div class="k-modal--close k-searchtrigger">
        <div class="k-modal--close__liner">
          <span class="k-headline k-headline--sm">X</span>
        </div>
      </div>
    </div>
  </div>

  <div class="k-modal k-modal--cart">
    <div class="k-inner k-inner--sm">
      <div class="k-modal--content">

        <div class="k-modal--placeholder">
          <h2 class="k-headline k-headline--sm">Adding to cart...</h2>
        </div>

        <div class="k-modal--cartcontent k-ajaxcart">
          <div class="k-ajaxcart--content">
            <h2 class="k-headline k-headline--sm">Your cart</h2>
            
          </div>
        </div>

        <a href="<?php echo site_url() . '/checkout'; ?>" class="k-button k-button--dark">Go To Checkout</a>
        <button type="button" class="k-button k-button--primary"><span>Keep Shopping</span></button>
      </div>
      <div class="k-modal--close">
        <div class="k-modal--close__liner">
          <span class="k-headline k-headline--sm">X</span>
        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tilt.js/1.2.1/tilt.jquery.min.js"></script>
  <script type="text/javascript" src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
  <script type="text/javascript" src="<?php echo $root.'/dist/js/magnetic.bundle.js'; ?>"></script>
</body>
</html>
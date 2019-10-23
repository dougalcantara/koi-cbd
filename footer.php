<?php
$root = get_template_directory_uri();
?>
  </main>

  <?php
  get_template_part('partials/site-footer');
  ?>

  <div id="k-backdrop" class="active"></div>

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

  <?php
    get_template_part('partials/cart-sidebar');
  ?>

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tilt.js/1.2.1/tilt.jquery.min.js"></script>
  <script type="text/javascript" src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
  <script type="text/javascript" src="<?php echo $root.'/dist/js/magnetic.bundle.js'; ?>"></script>
  <script type="text/javascript">
    (function() {
      var backdrop = document.querySelector('#k-backdrop');
      backdrop.classList.remove('active');
    })();
  </script>
</body>
</html>
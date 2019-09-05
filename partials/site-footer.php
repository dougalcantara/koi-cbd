<?php
  $root = get_template_directory_uri();
?>

<footer class="k-footer" role="contentinfo">
  <div class="k-footer--bgimg" style="background-image: url(<?php echo $root.'/dist/img/koi-footer-bg.jpg'; ?>)"></div>
  <div class="k-footer--top k-block k-block--md">

    <div class="k-inner k-inner--md">

      <div class="k-footer--item k-footer--logo">
        <div class="koi-logo-full">
          <div class="k-svg-wrapper">
            <?php get_template_part('partials/svg/koi-logo-full'); ?>
          </div>
        </div>
        <div class="k-footer--social k-rte-content">
          <a href="#0">Facebook</a>
          <a href="#0">Instagram</a>
        </div>
      </div>
      <div class="k-footer--item k-footer--links k-rte-content">
        <div class="k-footer--links__item">
          <h4 class="k-upcase k-weight--lg">Shop CBD</h4>
          <ul>
            <li><a href="#0">CBD Oil</a></li>
            <li><a href="#0">CBD Vape</a></li>
            <li><a href="#0">CBD Topical</a></li>
            <li><a href="#0">CBD Edibles</a></li>
            <li><a href="#0">CBD for Pets</a></li>
            <li><a href="#0">Where to Buy</a></li>
          </ul>
        </div>
        <div class="k-footer--links__item">
          <h4 class="k-upcase k-weight--lg">Company</h4>
          <ul>
            <li><a href="#0">About Us</a></li>
            <li><a href="#0">Lab Results</a></li>
            <li><a href="#0">Wholesale</a></li>
            <li><a href="#0">Ambassadors</a></li>
            <li><a href="#0">Veterans</a></li>
            <li><a href="#0">Help Desk</a></li>
          </ul>
        </div>
        <div class="k-footer--links__item">
          <h4 class="k-upcase k-weight--lg">Legal</h4>
          <ul>
            <li><a href="#0">Terms & Conditions</a></li>
            <li><a href="#0">Privacy Policy</a></li>
            <li><a href="#0">Cookie Policy</a></li>
            <li><a href="#0">Shipping Policy</a></li>
            <li><a href="#0">International</a></li>
          </ul>
        </div>
        </ul>
      </div>
      <div class="k-footer--item k-footer--badges">
        <img src="<?php echo $root.'/dist/img/us-hemp-roundtable-badge@2x.png'; ?>" alt="">
        <img src="<?php echo $root.'/dist/img/hia-member-badge@2x.png'; ?>" alt="">
        <img src="<?php echo $root.'/dist/img/chc-badge@2x.png'; ?>" alt="">
      </div>
    </div>
  </div>

  <div class="k-footer--bottom">
    <div class="k-inner k-inner--md">
      <div class="k-footer--copy">
        <p>&copy; Koi CBD 2019, All Rights Reserved</p>
      </div>
      <div class="k-footer--disclaimer">
        <p>This product is not for use by or sale to persons under the age of 18. This product should be used only as directed on the label. It should not be used if you are pregnant or nursing. Consult with a physician before use if you have a serious medical condition or use prescription medications. A Doctor's advice should be sought before using this product. These statements have not been evaluated by the FDA. This product is not intended to diagnose, treat, cure or prevent any disease. By using this website, you agree to follow the Privacy Policy and all Terms & Conditions printed on this site. Void Where Prohibited by Law.</p>
      </div>
    </div>
  </div>
</footer>
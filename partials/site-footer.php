<?php
  $root = get_template_directory_uri();
  $url = site_url();

  get_template_part('partials/cta-takeover');
?>

<footer class="k-footer" role="contentinfo">
  <div class="k-footer--bgimg" data-src="<?php echo $root.'/dist/img/koi-footer-bg.jpg'; ?>"></div>
  <div class="k-footer--top k-block k-block--md">

    <div class="k-inner k-inner--md">

      <div class="k-footer--item k-footer--logo">
        <figure class="k-figure">
          <div class="k-figure--liner">
            <img src="<?php echo $root . '/dist/img/koi-logo-main@2x.png'; ?>" alt="" class="k-figure--img" />
          </div>
        </figure>
        <div class="k-footer--social k-rte-content">
          <div class="social-icons">
            <div class="social-icons-row">
              <a href="https://www.facebook.com/KOICBD" target="_blank" rel="noopener, noreferrer">
                <?php get_template_part('partials/svg/facebook'); ?>
              </a>
              <a href="https://www.instagram.com/koicbdlife/" target="_blank" rel="noopener, noreferrer">
                <?php get_template_part('partials/svg/twitter'); ?>
              </a>
              <a href="https://www.instagram.com/koicbdlife/" target="_blank" rel="noopener, noreferrer">
                <?php get_template_part('partials/svg/instagram'); ?>
              </a>
            </div>
            <div class="social-icons-row">
              <a href="https://www.youtube.com/channel/UCe8IzqpmK6p-kpeHndvXGuQ/" target="_blank" rel="noopener, noreferrer">
                <?php get_template_part('partials/svg/youtube'); ?>
              </a>
              <a href="https://www.pinterest.com/koicbdlife/" target="_blank" rel="noopener, noreferrer">
                <?php get_template_part('partials/svg/pinterest'); ?>
              </a>
              <a href="https://www.linkedin.com/company/koi-cbd" target="_blank" rel="noopener, noreferrer">
                <?php get_template_part('partials/svg/linkedin'); ?>
              </a>
            </div>
          </div>
        </div>
      </div>
      <div class="k-footer--item k-footer--links k-rte-content">
        <div class="k-footer--links__item">
          <h4 class="k-upcase k-weight--lg">Shop CBD</h4>
          <ul>
            <li><a href="<?php echo $url . '/cbd-tinctures'; ?>">CBD Tinctures</a></li>
            <li><a href="<?php echo $url . '/cbd-edibles' ?>">CBD Edibles</a></li>
            <li><a href="<?php echo $url . '/cbd-vape' ?>">CBD Vape Juice</a></li>
            <li><a href="<?php echo $url . '/cbd-vape-devices-cartridges' ?>">CBD Vape Devices & Cartridges</a></li>
            <li><a href="<?php echo $url . '/cbd-topicals'; ?>">CBD Topicals</a></li>
            <li><a href="<?php echo $url . '/cbd-for-pets'; ?>">CBD Pets</a></li>
            <li><a href="<?php echo $url . '/cbd-merchandise'; ?>">Merchandise</a></li>
            <li><a href="<?php echo $url . '/cbd-products'; ?>">All CBD Products</a></li>
          </ul>
        </div>
        <div class="k-footer--links__item">
          <h4 class="k-upcase k-weight--lg">Company</h4>
          <ul>
            <li><a href="<?php echo $url . '/about-us'; ?>">About Us</a></li>
            <li><a href="<?php echo $url . '/lab-results'; ?>">Lab Results</a></li>
            <li><a href="https://wholesale.koicbd.com/">Wholesale</a></li>
            <!-- <li><a href="#0">Ambassadors</a></li> -->
            <li><a href="<?php echo $url . '/veteran-program'; ?>">Veterans</a></li>
            <li><a href="<?php echo $url . '/contact'; ?>">Help Desk</a></li>
          </ul>
        </div>
        <div class="k-footer--links__item">
          <h4 class="k-upcase k-weight--lg">Legal</h4>
          <ul>
            <li><a href="<?php echo $url . '/terms-and-conditions'; ?>">Terms & Conditions</a></li>
            <li><a href="<?php echo $url . '/privacy-policy'; ?>">Privacy Policy</a></li>
            <!-- <li><a href="<?php echo $url . '/cookie-policy'; ?>">Cookie Policy</a></li> -->
            <li><a href="<?php echo $url . '/shipping-policy'; ?>">Shipping Policy</a></li>
            <!-- <li><a href="#0">International</a></li> -->
          </ul>
        </div>
        </ul>
      </div>
      <div class="k-footer--item k-footer--badges">
        <img src="<?php echo $root.'/dist/img/us-hemp-roundtable-logo.png'; ?>" alt="Hemp Industries Association">
        <img src="<?php echo $root.'/dist/img/hemp-industries-association-logo.png'; ?>" alt="Hemp Roundtable">
        <img src="<?php echo $root.'/dist/img/california-hemp-council-logo.png'; ?>" alt="California Hemp Council">
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
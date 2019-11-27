<?php
$root = get_template_directory_uri();
$url = site_url();
?>

<header class="k-header">
  <button class="k-header__skip-to-main k-button k-button--primary">Skip To Main Content</button>
  <div class="k-header__newsletter-signup">
    <div class="k-inner k-inner--xl">
      <form action="POST">
        <fieldset class="k-form--group">
          <label for="k-newsletter-first" class="k-header__newsletter-label">First Name</label>
          <input class="k-input" type="text" name="first name" id="k-newsletter-first" required>
        </fieldset>
        <fieldset class="k-form--group">
          <label for="k-newsletter-last" class="k-header__newsletter-label">Last Name</label>
          <input class="k-input" type="text" name="last name" id="k-newsletter-last" required>
        </fieldset>        
        <fieldset class="k-form--group">
          <label for="k-newsletter-email" class="k-header__newsletter-label">Email</label>
          <input class="k-input" type="text" name="email" id="k-newsletter-email" required>
        </fieldset>
        <button class="k-header__newsletter-submit k-button k-button--primary">Sign Up</button>
      </form>

    </div>
  </div>
  <div class="k-header--top k-promobanner">
    <div class="k-inner k-inner--xl">
      <div class="k-promobanner--item">
        <span class="k-upcase">Free shipping on all US orders over $35</span>
      </div>
      <div class="k-promobanner--item">
        <span class="k-upcase k-header__newsletter-trigger">Sign up for our newsletter for 10% off</span>
      </div>
    </div>
  </div>
  <div class="k-header--main">
    <nav class="k-header--nav">
      <div class="k-header--nav__content">
        <ul>
          <li class="k-has-dropdown">
            <a class="k-upcase"><span>&#9660;</span> Shop</a>
            <ul class="k-dropdown">
              <div class="k-dropdown--liner">
                <li><a href="<?php echo $url . '/cbd-tinctures'; ?>">CBD Tinctures</a></li>
                <li><a href="<?php echo $url . '/cbd-edibles' ?>">CBD Edibles</a></li>
                <li><a href="<?php echo $url . '/cbd-vape' ?>">CBD Vape Juice</a></li>
                <li><a href="<?php echo $url . '/cbd-vape-devices-cartridges' ?>">CBD Vape Devices & Cartridges</a></li>
                <li><a href="<?php echo $url . '/cbd-topicals'; ?>">CBD Topicals</a></li>
                <li><a href="<?php echo $url . '/cbd-for-pets'; ?>">CBD Pets</a></li>
                <li><a href="<?php echo $url . '/cbd-merchandise'; ?>">Merchandise</a></li>
                <li><a href="<?php echo $url . '/cbd-products'; ?>">All CBD Products</a></li>
              </div>
            </ul>
          </li>
          <li><a class="k-upcase" href="<?php echo $url . '/cbd-101'; ?>">CBD 101</a></li>
          <li class="k-has-dropdown">
            <a class="k-upcase"><span>&#9660;</span> Resources</a>
            <ul class="k-dropdown">
              <div class="k-dropdown--liner">
                <li><a href="<?php echo $url . '/lab-results'; ?>">Lab Results</a></li>
                <li><a href="<?php echo $url . '/blog'; ?>">Blog</a></li>
              </div>
            </ul>
          </li>
        </ul>
        <ul>
          <!-- <li><a class="k-upcase" href="<?php echo $url; ?>/#0">Community</a></li> -->
          <li class="k-has-dropdown">
            <a class="k-upcase"><span>&#9660;</span>About Us</a>
            <ul class="k-dropdown">
              <div class="k-dropdown--liner">
                <li><a href="<?php echo $url . '/about-us' ?>">Koi Story</a></li>
                <li><a href="<?php echo $url . '/blog/?category=hot-off-the-press'; ?>">Press</a></li>
                <li><a href="<?php echo $url . '/contact'; ?>">FAQ / Contact</a></li>
              </div>
            </ul>
          </li>
          <li><a class="k-upcase" href="<?php echo $url; ?>/account/">Account</a></li>

          <li class="k-header--cart">
            <a id="k-carttoggle">
              <i class="icon-bag"></i>
              <span id="k-cartnum" class="">0</span>
            </a>
          </li>

          <li class="k-searchtrigger">
            <!-- <a href="<?php echo $url; ?>/search"> -->
              <i class="icon-magnifier"></i>
            <!-- </a> -->
          </li>
        </ul>
      </div>
    </nav>
    <div class="k-inner k-inner--xl">
      <div class="k-header--logo">
        <a href="<?php echo site_url(); ?>">
          <img src="<?php echo $root.'/dist/img/koi-logo-main@2x.png'; ?>" alt="">
        </a>
      </div>
      <div class="k-header--navtoggle" id="k-nav-trigger">
        <div class="k-header--navtoggle__line"></div>
        <div class="k-header--navtoggle__line"></div>
        <div class="k-header--navtoggle__line"></div>
      </div>
    </div>
  </div>
</header>

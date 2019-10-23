<?php
$root = get_template_directory_uri();
$url = site_url();
?>

<header class="k-header">
  <div class="k-header--top k-promobanner">
    <div class="k-inner k-inner--xl">
      <div class="k-promobanner--item">
        <span class="k-upcase">Free shipping & returns for all US orders</span>
      </div>
      <div class="k-promobanner--item">
        <span class="k-upcase">Sign up for our newsletter for 10% off</span>
      </div>
    </div>
  </div>
  <div class="k-header--main">
    <div class="k-header--nav">
      <div class="k-header--nav__content">
        <ul>
          <li class="k-has-dropdown">
            <a class="k-upcase" href="#0"><span>&#9660;</span> Shop</a>
            <ul class="k-dropdown">
              <div class="k-dropdown--liner">
                <li><a href="<?php echo $url . '/cbd-tinctures'; ?>">CBD Tinctures</a></li>
                <li><a href="<?php echo $url . '/cbd-edibles' ?>">CBD Edibles</a></li>
                <li><a href="<?php echo $url . '/cbd-wellness-shots' ?>">CBD Wellness Shots</a></li>
                <li><a href="<?php echo $url . '/cbd-vape' ?>">CBD Vape Juice</a></li>
                <li><a href="<?php echo $url . '/cbd-vape-devices-cartridges' ?>">CBD Vape Devices & Cartridges</a></li>
                <li><a href="<?php echo $url . '/cbd-topicals'; ?>">CBD Topicals</a></li>
                <li><a href="<?php echo $url . '/cbd-for-pets'; ?>">CBD Pets</a></li>
                <li><a href="<?php echo $url . '/cbd-merchandise'; ?>">Merchandise</a></li>
              </div>
            </ul>
          </li>
          <li><a class="k-upcase" href="<?php echo $url . '/blog/?category=getting-started-with-cbd'; ?>">CBD 101</a></li>
          <li class="k-has-dropdown">
            <a class="k-upcase" href="#0">Resources</a>
            <ul class="k-dropdown">
              <div class="k-dropdown--liner">
                <li><a href="#0">Lab Results</a></li>
                <li><a href="<?php echo $url . '/blog'; ?>">Blog</a></li>
              </div>
            </ul>
          </li>
        </ul>
        <ul>
          <li><a class="k-upcase" href="<?php echo $url; ?>/community">Community</a></li>
          <li class="k-has-dropdown">
            <a class="k-upcase" href="#0">About Us</a>
            <ul class="k-dropdown">
              <div class="k-dropdown--liner">
                <li><a href="<?php echo $url . '/about-us' ?>">Koi Story</a></li>
                <li><a href="<?php echo $url; ?>">Press</a></li>
                <li><a href="<?php echo $url . '/contact'; ?>">FAQ / Contact</a></li>
              </div>
            </ul>
          </li>
          <li><a class="k-upcase" href="<?php echo $url; ?>/account">Account</a></li>

          <li class="k-header--cart">
            <a id="k-carttoggle" href="#0">
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
    </div>
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
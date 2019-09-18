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
          <li><a class="k-upcase" href="<?php echo $url; ?>/shop">Shop</a></li>
          <li><a class="k-upcase" href="<?php echo $url; ?>/cbd-101">CBD 101</a></li>
          <li><a class="k-upcase" href="<?php echo $url; ?>/resources">Resources</a></li>
        </ul>
        <ul>
          <li><a class="k-upcase" href="<?php echo $url; ?>/community">Community</a></li>
          <li><a class="k-upcase" href="<?php echo $url; ?>/about-us">About Us</a></li>
          <li><a class="k-upcase" href="<?php echo $url; ?>/account">Account</a></li>

          <li class="k-header--cart">
            <a href="<?php echo $url; ?>/cart">
              <i class="icon-bag"></i>
              <span id="k-cartnum" class="">0</span>
            </a>
          </li>

          <li><a href="<?php echo $url; ?>/search"><i class="icon-magnifier"></i></a></li>
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
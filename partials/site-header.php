<?php
$root = get_template_directory_uri();
?>

<header class="k-header">
  <div class="k-header--top k-promobanner">
    <div class="k-inner k-inner--lg">
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
          <li><a class="k-upcase" href="/shop">Shop</a></li>
          <li><a class="k-upcase" href="/cbd-101">CBD 101</a></li>
          <li><a class="k-upcase" href="/resources">Resources</a></li>
        </ul>
        <ul>
          <li><a class="k-upcase" href="/community">Community</a></li>
          <li><a class="k-upcase" href="/about-us">About Us</a></li>
          <li><a class="k-upcase" href="/account">Account</a></li>
          <li><a href="/cart"><i class="icon-bag"></i></a></li>
          <li><a href="/search"><i class="icon-magnifier"></i></a></li>
        </ul>
      </div>
    </div>
    <div class="k-inner k-inner--lg">
      <div class="k-header--logo">
        <img src="<?php echo $root.'/dist/img/koi-logo-main@2x.png'; ?>" alt="">
      </div>
      <div class="k-header--navtoggle" id="k-nav-trigger">
        <div class="k-header--navtoggle__line"></div>
        <div class="k-header--navtoggle__line"></div>
        <div class="k-header--navtoggle__line"></div>
      </div>
    </div>
  </div>
</header>
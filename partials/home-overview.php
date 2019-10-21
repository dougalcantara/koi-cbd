<?php
  $root = get_template_directory_uri();
?>

<section class="k-overview k-block k-block--lg">
  <div class="k-overview--bgimg">
    <?php get_template_part('partials/svg/koi-bg'); ?>
  </div>
  <div class="k-inner k-inner--md">

    <div class="k-overview--intro k-overview--item">
      <div class="k-overview--intro__text">
        <div class="k-preheading">
          <span class="k-upcase">Koi CBD Products</span>
        </div>
        <div class="k-heading">
          <h2 class="k-headline k-headline--md">Tinctures, Topicals, Edibles, Pets, Vapes & More.</h2>
        </div>
        <div class="k-textbody">
          <p>Welcome to the Awesome World of CBD.</p>
        </div>
        <div class="k-action">
          <a href="<?php echo site_url().'/cbd-products'; ?>" class="k-button k-button--primary">Shop All CBD Products &nbsp; &rarr;</a>
        </div>
      </div>
      <div class="k-overview--intro__card">
        <figure class="k-figure k-figure--rounded ">
          <div class="k-figure--liner">
            <img class="k-figure--img" data-src="<?php echo $root.'/dist/img/koi-peppermint-mainimg.jpg' ?>" alt="" />
          </div>
          <img data-src="<?php echo $root.'/dist/img/koi-peppermint-cornerimg@2x.png' ?>" alt="" class="k-cornerimg">
        </figure>
        <h3 class="k-headline k-headline--xs">CBD Tinctures</h3>
        <div class="k-rte-content">
          <p>Consume beneath your tongue, or add to your favorite recipes. Our all-natural CBD oils are available in 6 great-tasting flavors, 2 sizes, and 4 strengths. Contains 0% THC. Not for vaping.</p>
          <a href="<?php echo site_url().'/cbd-tinctures'; ?>">Shop Now &rarr;</a>
        </div>
      </div>
    </div>

    <div class="k-overview--topicals k-overview--item">
      <div class="k-overview--topicals__card">
        <figure class="k-figure k-figure--rounded ">
          <div class="k-figure--liner">
            <img class="k-figure--img" data-src="<?php echo $root.'/dist/img/koi-topicals-mainimg.jpg' ?>" alt="" />
          </div>
          <img data-src="<?php echo $root.'/dist/img/koi-topicals-cornerimg@2x.png' ?>" alt="" class="k-cornerimg">
        </figure>
        <h3 class="k-headline k-headline--xs">CBD Topicals</h3>
        <div class="k-rte-content">
          <p>Relax and rejuvenate with all-purpose CBD topicals. Perfect for calming inflammation, and promoting beautiful, naturally healthy skin.</p>
          <a href="<?php echo site_url().'/cbd-topicals'; ?>">Shop Now &rarr;</a>
        </div>
      </div>
    </div>

    <div class="k-overview--pets k-overview--item">
      <div class="k-overview--pets__card">
        <figure class="k-figure k-figure--rounded ">
          <div class="k-figure--liner">
            <img class="k-figure--img" data-src="<?php echo $root.'/dist/img/koi-pets-mainimg@2x.png' ?>" alt="" />
          </div>
        </figure>
        <h3 class="k-headline k-headline--xs">CBD For Pets</h3>
        <div class="k-rte-content">
          <p>Treat your furry friend to all-natural, non-GMO, non-psychoactive ingredients designed with one thing in mind&mdash;your pet's health.</p>
          <a href="<?php echo site_url().'/cbd-for-pets'; ?>">Shop Now &rarr;</a>
        </div>
      </div>
    </div>

    <div class="k-overview--edibles k-overview--item">
      <div class="k-overview--edibles__card">
        <figure class="k-figure k-figure--rounded ">
          <div class="k-figure--liner">
            <img class="k-figure--img" data-src="<?php echo $root.'/dist/img/koi-edibles-mainimg.jpg' ?>" alt="" />
          </div>
          <img data-src="<?php echo $root.'/dist/img/koi-edibles-cornerimg@2x.png' ?>" alt="" class="k-cornerimg">
        </figure>
        <div class="k-overview--edibles__text">
          <h3 class="k-headline k-headline--xs">CBD Edibles</h3>
          <div class="k-rte-content">
            <p>Delectable snacks that deliver a punch of fruit flavor while restoring balance, naturally. Available in 20-piece and 6-piece bags.</p>
            <a href="<?php echo site_url().'/cbd-edibles'; ?>">Shop Now &rarr;</a>
          </div>
        </div>
      </div>
    </div>

    <div class="k-overview--vape k-overview--item">
      <div class="k-overview--vape__card">
        <figure class="k-figure k-figure--rounded ">
          <div class="k-figure--liner">
            <img class="k-figure--img" data-src="<?php echo $root.'/dist/img/koi-vape-mainimg.jpg' ?>" alt="" />
          </div>
          <img data-src="<?php echo $root.'/dist/img/koi-vape-cornerimg@2x.png' ?>" alt="" class="k-cornerimg">
        </figure>
        <div class="k-overview--vape__text">
          <h3 class="k-headline k-headline--xs">CBD Vape</h3>
          <div class="k-rte-content">
            <p>Enjoy an even distribution of CBD throughout your day. Vape them on their own or add to other e-liquids. Available in 7 awesome flavors.</p>
            <a href="<?php echo site_url().'/cbd-vape'; ?>">Shop Now &rarr;</a>
          </div>
        </div>
      </div>
    </div>

  </div>
</section>
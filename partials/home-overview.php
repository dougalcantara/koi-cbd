<?php
  $root = get_template_directory_uri();
?>

<section class="k-overview k-block k-block--lg k-no-padding--bottom k-no-padding--top">
  <div class="k-overview--bgimg" data-src="<?php echo $root . '/dist/misc/koi-bg.html #koi-bg' ?>"></div>
  <div class="k-inner k-inner--md k-overview--intro">
    <div class="k-overview--intro__image">
      <figure class="k-figure">
        <img class="k-figure--img" data-src="<?php echo $root.'/dist/img/koi_products_group.png'; ?>" alt="Overview Lifestyle Image">
      </figure>
    </div>
    <div class="k-overview--intro__text">
      <div class="k-preheading">
        <span class="k-upcase">Koi CBD Products</span>
      </div>
      <div class="k-heading">
        <h2 class="k-headline k-headline--md">
          <?php echo $overview_fields['headline']; ?>
        </h2>
      </div>
      <div class="k-textbody">
        <p><?php echo $overview_fields['supporting_copy']; ?></p>
      </div>
      <div class="k-action">
        <a
          href="<?php echo $overview_fields['main_link']['url']; ?>"
          class="k-button k-button--primary"
        >
          <?php echo $overview_fields['main_link']['title']; ?> &nbsp; &rarr;
        </a>
      </div>
    </div>    
  </div>
  <div class="k-inner k-inner--md k-overview__card-container">
    <div class="k-overview--item k-overview--item">
      <div class="k-overview--item__card k-overview--item__card--tinctures">
        <a href="<?php echo site_url().'/cbd-tinctures'; ?>">
          <figure class="k-figure k-figure--rounded ">
            <div class="k-figure--liner">
              <img class="k-figure--img" data-src="<?php echo $root.'/dist/img/cbd-tinctures-cat.jpg' ?>" alt="Peppermint CBD Tincture" />
            </div>
            <img data-src="<?php echo $root.'/dist/img/koi-peppermint-cornerimg@2x.png' ?>" alt="Peppermint CBD Tincture" class="k-cornerimg">
          </figure>
        </a>
        <h3 class="k-headline k-headline--xs">
          <a href="<?php echo site_url().'/cbd-tinctures'; ?>">Tinctures and Sprays</a>
        </h3>
        <div class="k-rte-content">
          <p><?php echo $overview_fields['tinctures_copy']; ?></p>
          <a class="k-button k-button--primary" href="<?php echo site_url().'/cbd-tinctures'; ?>">Shop Tinctures and Sprays &rarr;</a>
        </div>
      </div>
    </div>

    <div class="k-overview--topicals k-overview--item">
      <div class="k-overview--item__card">
        <a href="<?php echo site_url().'/cbd-topicals'; ?>">
          <figure class="k-figure k-figure--rounded ">
            <div class="k-figure--liner">
              <img class="k-figure--img" data-src="<?php echo $root.'/dist/img/cbd-topicals-cat.jpg' ?>" alt="Topical CBD Balm" />
            </div>
            <img data-src="<?php echo $root.'/dist/img/cbd-topicals-cat-overlay.png' ?>" alt="Topical CBD Balm" class="k-cornerimg">
          </figure>
        </a>
        <h3 class="k-headline k-headline--xs">
          <a href="<?php echo site_url().'/cbd-topicals'; ?>">CBD Topicals</a>
        </h3>
        <div class="k-rte-content">
          <p><?php echo $overview_fields['topicals_copy']; ?></p>
          <a class="k-button k-button--primary" href="<?php echo site_url().'/cbd-topicals'; ?>">Shop Topicals &rarr;</a>
        </div>
      </div>
    </div>

    <div class="k-overview--edibles k-overview--item">
      <div class="k-overview--item__card">
        <a href="<?php echo site_url().'/cbd-edibles'; ?>">
          <figure class="k-figure k-figure--rounded ">
            <div class="k-figure--liner">
              <img class="k-figure--img" data-src="<?php echo $root.'/dist/img/cbd-edibles-cat.jpg' ?>" alt="CBD Edibles" />
            </div>
            <img data-src="<?php echo $root.'/dist/img/koi-edibles-cornerimg@2x.png' ?>" alt="CBD Edibles" class="k-cornerimg">
          </figure>
        </a>
        <div class="k-overview--edibles__text">
          <h3 class="k-headline k-headline--xs">
            <a href="<?php echo site_url().'/cbd-edibles'; ?>">CBD Gummies</a>
          </h3>
          <div class="k-rte-content">
            <p><?php echo $overview_fields['edibles_copy']; ?></p>
            <a class="k-button k-button--primary" href="<?php echo site_url().'/cbd-edibles'; ?>">Shop Gummies &rarr;</a>
          </div>
        </div>
      </div>
    </div>    

    <div class="k-overview--pets k-overview--item">
      <div class="k-overview--item__card">
        <a href="<?php echo site_url().'/cbd-for-pets'; ?>">
          <figure class="k-figure k-figure--rounded ">
            <div class="k-figure--liner">
              <img class="k-figure--img" data-src="<?php echo $root.'/dist/img/cbd-for-pets-cat.jpg' ?>" alt="CBD Pet Treats" />
            </div>
            <img data-src="<?php echo $root.'/dist/img/cbd-for-pets-cat-overlay.png' ?>" alt="CBD for pets" class="k-cornerimg">
          </figure>
        </a>
        <h3 class="k-headline k-headline--xs">
          <a href="<?php echo site_url().'/cbd-for-pets'; ?>">CBD For Pets</a>
        </h3>
        <div class="k-rte-content">
          <p><?php echo $overview_fields['pets_copy']; ?></p>
          <a class="k-button k-button--primary" href="<?php echo site_url().'/cbd-for-pets'; ?>">Shop for Pets &rarr;</a>
        </div>
      </div>
    </div>

    <div class="k-overview--vape k-overview--item">
      <div class="k-overview--item__card">
        
        <figure class="k-figure k-figure--rounded ">
          <a href="<?php echo site_url().'/cbd-vape'; ?>">
            <div class="k-figure--liner">
              <img class="k-figure--img" data-src="<?php echo $root.'/dist/img/cbd-vape-cat.jpg' ?>" alt="CBD Vape" />
            </div>
            <img data-src="<?php echo $root.'/dist/img/cbd-vape-cat-overlay.png' ?>" alt="CBD Vape" class="k-cornerimg">
          </a>
        </figure>
        
        <div class="k-overview--vape__text">
          <h3 class="k-headline k-headline--xs">
            <a href="<?php echo site_url().'/cbd-vape'; ?>">Vape Juice</a>
          </h3>
          <div class="k-rte-content">
            <p><?php echo $overview_fields['vape_copy']; ?></p>
            <a class="k-button k-button--primary" href="<?php echo site_url().'/cbd-vape'; ?>">Shop Vape Juice &rarr;</a>
          </div>
        </div>
      </div>
    </div>

    <div class="k-overview--merch k-overview--item">
      <div class="k-overview--item__card k-overview--item__card--merch">
        
        <figure class="k-figure k-figure--rounded ">
          <a href="<?php echo site_url().'/cbd-merchandise'; ?>">
            <div class="k-figure--liner">
              <img class="k-figure--img" data-src="<?php echo $root.'/dist/img/cbd-merch-cat.jpg' ?>" alt="Koi Merchandise" />
            </div>
            <img data-src="<?php echo $root.'/dist/img/cbd-merch-cat-overlay.png' ?>" alt="Koi Merchandise" class="k-cornerimg">
          </a>
        </figure>
        
        <div class="k-overview--merch__text">
          <h3 class="k-headline k-headline--xs">
            <a href="<?php echo site_url().'/cbd-merchandise'; ?>">Koi Merchandise</a>
          </h3>
          <div class="k-rte-content">
            <p><?php echo $overview_fields['merch_copy']; ?></p>
            <a class="k-button k-button--primary" href="<?php echo site_url().'/cbd-merchandise'; ?>">Shop Merchandise &rarr;</a>
          </div>
        </div>
      </div>
    </div>    

  </div>
</section>

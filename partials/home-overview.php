<?php
  $root = get_template_directory_uri();
?>

<section class="k-overview k-block k-block--lg k-no-padding--bottom k-no-padding--top">
  <div class="k-overview--bgimg" data-src="<?php echo $root . '/dist/misc/koi-bg.html #koi-bg' ?>"></div>
  <div class="k-inner k-inner--md">

    <div class="k-overview--intro k-overview--item">
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
      <div class="k-overview--intro__card">
        <figure class="k-figure k-figure--rounded ">
          <div class="k-figure--liner">
            <img class="k-figure--img" data-src="<?php echo $root.'/dist/img/koi-peppermint-mainimg.jpg' ?>" alt="" />
          </div>
          <img data-src="<?php echo $root.'/dist/img/koi-peppermint-cornerimg@2x.png' ?>" alt="" class="k-cornerimg">
        </figure>
        <h3 class="k-headline k-headline--xs">CBD Tinctures</h3>
        <div class="k-rte-content">
          <p><?php echo $overview_fields['tinctures_copy']; ?></p>
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
          <p><?php echo $overview_fields['topicals_copy']; ?></p>
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
          <p><?php echo $overview_fields['pets_copy']; ?></p>
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
            <p><?php echo $overview_fields['edibles_copy']; ?></p>
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
            <p><?php echo $overview_fields['vape_copy']; ?></p>
            <a href="<?php echo site_url().'/cbd-vape'; ?>">Shop Now &rarr;</a>
          </div>
        </div>
      </div>
    </div>

  </div>
</section>
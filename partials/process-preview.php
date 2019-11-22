<?php
  $root = get_template_directory_uri();
?>

<section class="k-videogallery k-block k-block--md">
  <div class="k-inner k-inner--md">
    <div class="k-videogallery--item k-videogallery--title">
      <h2 class="k-headline k-headline--sm"><?php the_field('homepage_video_gallery_title','option'); ?></h2>
      <div class="k-rte-content">
        <p><?php the_field('homepage_video_gallery_text','option'); ?></p>
      </div>
    </div>
    <div class="k-videogallery--item k-videogallery--video has-play-button">
      <figure class="k-figure k-figure--rounded">
        <div class="k-figure--liner">
          <img data-src="<?php echo $root.'/dist/img/koi-video-placeholder.jpg'; ?>" alt="" class="k-figure--img">
        </div>
      </figure>
      <div class="k-player" data-plyr-provider="youtube" data-plyr-embed-id="<?php the_field('homepage_video_gallery_video_link','option'); ?>"></div>
      <?php
      get_template_part('partials/svg/koi-play-button');
      ?>
    </div>
    <div class="k-videogallery--item k-videogallery--actions">
      <a href="<?php echo site_url() . '/about-us?scrollToSelected=0' ?>" class="k-videogallery--actions__item">
        <div class="k-videogallery--actions__icon">
          <?php
          get_template_part('partials/svg/koi-leaf');
          ?>
        </div>
        <div class="k-videogallery--actions__title">
          <p>U.S. Organic Hemp Farms</p>
        </div>
      </a>

      <a href="<?php echo site_url() . '/about-us?scrollToSelected=1' ?>" class="k-videogallery--actions__item">
        <div class="k-videogallery--actions__icon">
          <?php
          get_template_part('partials/svg/koi-bottle');
          ?>
        </div>
        <div class="k-videogallery--actions__title">
          <p>Maintaining Taste & Terpenes</p>
        </div>
      </a>

      <a href="<?php echo site_url() . '/about-us?scrollToSelected=2' ?>" class="k-videogallery--actions__item">
        <div class="k-videogallery--actions__icon">
          <?php
          get_template_part('partials/svg/koi-beaker');
          ?>
        </div>
        <div class="k-videogallery--actions__title">
          <p>Accredited 3rd Party Testing</p>
        </div>
      </a>

      <a href="<?php echo site_url() . '/about-us?scrollToSelected=3' ?>" class="k-videogallery--actions__item">
        <div class="k-videogallery--actions__icon">
          <?php
          get_template_part('partials/svg/koi-eyedrop');
          ?>
        </div>
        <div class="k-videogallery--actions__title">
          <p>Single Vessel Bottling</p>
        </div>
      </a>
      
      <a href="<?php echo site_url() . '/about-us?scrollToSelected=4' ?>" class="k-videogallery--actions__item">
        <div class="k-videogallery--actions__icon">
          <?php
          get_template_part('partials/svg/koi-plant');
          ?>
        </div>
        <div class="k-videogallery--actions__title">
          <p>Whole Plant Extraction</p>
        </div>
      </a>

      <a href="<?php echo site_url() . '/about-us?scrollToSelected=5' ?>" class="k-videogallery--actions__item">
        <div class="k-videogallery--actions__icon">
          <?php
          get_template_part('partials/svg/koi-microscope');
          ?>
        </div>
        <div class="k-videogallery--actions__title">
          <p>Traceability & Quality Control</p>
        </div>
      </a>
      <a href="<?php echo site_url() . '/about-us?scrollToSelected=6' ?>" class="k-videogallery--actions__item">
        <div class="k-videogallery--actions__icon">
          <?php
          get_template_part('partials/svg/koi-leaf');
          ?>
        </div>
        <div class="k-videogallery--actions__title">
          <p>Final Quality Hold</p>
        </div>
      </a>

      <a href="<?php echo site_url() . '/about-us?scrollToSelected=7' ?>" class="k-videogallery--actions__item">
        <div class="k-videogallery--actions__icon">
          <?php
          get_template_part('partials/svg/koi-bottle');
          ?>
        </div>
        <div class="k-videogallery--actions__title">
          <p>Tracking With Batch Numbers</p>
        </div>
      </a>
    </div>
    <div class="k-videogallery--item k-videogallery--description k-rte-content">
      <p class="k-headline k-headline--xs"><?php the_field('homepage_video_gallery_description','option'); ?></p>
      <a class="k-underline k-weight--lg" href="<?php echo site_url() . '/about-us?scrollToSelected=0' ?>">Get The Full Story</a>
    </div>
  </div>
</section>

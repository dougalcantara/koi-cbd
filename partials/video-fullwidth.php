<?php $root = get_template_directory_uri(); ?>

<section class="k-fullwidthvid has-play-button k-bg-dark">
  <div class="k-inner k-inner--xl">
    <div class="k-fullwidthvid--liner">
      <div class="k-fullwidthvid--bgimg" data-src="<?php echo $root . '/dist/img/Koi_About_VideoPlaceholder.jpg'; ?>"></div>
    </div>
    <div class="k-player" data-plyr-provider="youtube" data-plyr-embed-id="UmDNOk4_3g8"></div>
  </div>
  <?php get_template_part('partials/svg/koi-play-button'); ?>
</section>
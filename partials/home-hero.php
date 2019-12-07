<?php
  $root = get_template_directory_uri();
?>
<section class="k-hero k-hero--default k-hero--center k-hero--on-dark">
  <div class="hero-media">
    <div class="hero-media-img">
      <img
          sizes="(min-width: 30em) 28em, 100vw"
          srcset="https://res.cloudinary.com/ddxqlbjm1/image/upload/f_auto,q_70,w_256/v1575681780/KoiCBD/koi-cbd-oil-tincture.jpg,
                https://res.cloudinary.com/ddxqlbjm1/image/upload/f_auto,q_70,w_512/v1575681780/KoiCBD/koi-cbd-oil-tincture.jpg 512w,
                https://res.cloudinary.com/ddxqlbjm1/image/upload/f_auto,q_70,w_768/v1575681780/KoiCBD/koi-cbd-oil-tincture.jpg 768w,
                https://res.cloudinary.com/ddxqlbjm1/image/upload/f_auto,q_70,w_1024/v1575681780/KoiCBD/koi-cbd-oil-tincture.jpg 1024w,
                https://res.cloudinary.com/ddxqlbjm1/image/upload/f_auto,q_70,w_1920/v1575681780/KoiCBD/koi-cbd-oil-tincture.jpg 1920w"
          src="https://res.cloudinary.com/ddxqlbjm1/image/upload/f_auto,q_70,w_512/v1575681780/KoiCBD/koi-cbd-oil-tincture.jpg"
          alt />
    </div>
    <div class="hero-media-video">
      <video src="<?php the_field('hero_background_video', 'option'); ?>" loop muted playsinline></video>
    </div>
  </div>
  <div class="k-inner k-inner--md">
    <div class="k-hero--text">
      <h2 class="k-headline k-headline--lg"><?php echo $hero_fields['headline']; ?></h2>
      <div class="k-hero--bigtext">
        <h1 class="k-headline--fake"><?php echo $hero_fields['body']; ?></h1>
      </div>
    </div>
    <div class="k-hero--action">
    <?php
      foreach($hero_fields['actions'] as $action_obj) { ?>
        <a
          href="<?php echo $action_obj['link']['url']; ?>"
          class="k-button k-button--<?php echo $action_obj['style']; ?>"
        >
          <?php echo $action_obj['link']['title']; ?> &nbsp; &rarr;
        </a>
    <?php
      }
    ?>
    </div>
  </div>
</section>
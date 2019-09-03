<?php
  $root = get_template_directory_uri();
?>

<section class="k-testimonialslider k-block k-block--md">
  <div class="k-inner k-inner--sm">
    <div class="k-testimonialslider--carousel">
      <?php for ($i = 0; $i < 4; $i++) { ?>
        <div class="k-testimonialslider--slide">
          <figure class="k-figure">
            <div class="k-figure--liner">
              <img src="<?php echo $root.'/dist/img/koi-christian-hosoi-avatar@2x.png' ?>" alt="" class="k-figure--img">
            </div>
          </figure>
          <h3 class="k-headline k-headline--sm">
            "Truly love these! They are the right consistency, the flavor is AMAZING, and I really like that they deliver 10mg of CBD."
          </h3>
          <p class="k-testimonialslider--cite k-upcase">Christian Hosoi</p>
        </div>
      <?php } ?>
    </div>
  </div>
</section>
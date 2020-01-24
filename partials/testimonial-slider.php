<?php
  $root = get_template_directory_uri();
  $testimonials = $testimonial_fields['testimonials'];
?>

<section class="k-testimonialslider k-block k-block--md">
  <div class="k-inner k-inner--sm">
    <div class="k-testimonialslider--carousel">
      <?php foreach($testimonials as $testimonial) { ?>
        <div class="k-testimonialslider--slide">
          <figure class="k-figure">
            <div class="k-figure--liner">
              <img
                data-src="<?php echo $testimonial['author_image']['url']; ?>"
                alt="<?php echo $testimonial['author_image']['alt']; ?>"
                class="k-figure--img"
              />
            </div>
          </figure>
          <h3 class="k-headline k-headline--sm">
            "<?php echo $testimonial['quote']; ?>"
          </h3>
          <p class="k-testimonialslider--cite k-upcase">
            <?php echo $testimonial['author']; ?>
          </p>
        </div>
      <?php } ?>
    </div>
  </div>
</section>
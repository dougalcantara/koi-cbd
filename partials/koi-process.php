<?php
$root = get_template_directory_uri();
?>

<section id="koi-process" class="k-process k-block k-block--md">
  <div class="k-inner k-inner--md">

    <div class="k-process__iconrow">
      <div class="k-process__iconrow__item">
        <div class="k-process__iconrow__icon">
          <?php
          get_template_part('partials/svg/koi-leaf');
          ?>
        </div>
        <div class="k-process__iconrow__title">
          <p>U.S. Organic Hemp Farms</p>
        </div>
      </div>

      <div class="k-process__iconrow__item">
        <div class="k-process__iconrow__icon">
          <?php
          get_template_part('partials/svg/koi-bottle');
          ?>
        </div>
        <div class="k-process__iconrow__title">
          <p>Maintaining Taste & Terpenes</p>
        </div>
      </div>

      <div class="k-process__iconrow__item">
        <div class="k-process__iconrow__icon">
          <?php
          get_template_part('partials/svg/koi-beaker');
          ?>
        </div>
        <div class="k-process__iconrow__title">
          <p>Accredited 3rd Party Testing</p>
        </div>
      </div>

      <div class="k-process__iconrow__item">
        <div class="k-process__iconrow__icon">
          <?php
          get_template_part('partials/svg/koi-eyedrop');
          ?>
        </div>
        <div class="k-process__iconrow__title">
          <p>Single Vessel Bottling</p>
        </div>
      </div>

      <div class="k-process__iconrow__item">
        <div class="k-process__iconrow__icon">
          <?php
          get_template_part('partials/svg/koi-plant');
          ?>
        </div>
        <div class="k-process__iconrow__title">
          <p>Whole Plant Extraction</p>
        </div>
      </div>

      <div class="k-process__iconrow__item">
        <div class="k-process__iconrow__icon">
          <?php
          get_template_part('partials/svg/koi-microscope');
          ?>
        </div>
        <div class="k-process__iconrow__title">
          <p>Traceability & Quality Control</p>
        </div>
      </div>

      <div class="k-process__iconrow__item">
        <div class="k-process__iconrow__icon">
          <?php
          get_template_part('partials/svg/koi-leaf');
          ?>
        </div>
        <div class="k-process__iconrow__title">
          <p>Final Quality Hold</p>
        </div>
      </div>

      <div class="k-process__iconrow__item">
        <div class="k-process__iconrow__icon">
          <?php
          get_template_part('partials/svg/koi-barcode');
          ?>
        </div>
        <div class="k-process__iconrow__title">
          <p>Tracking With Batch Numbers</p>
        </div>
      </div>

    </div>

    <div class="k-process__carousel">
      <?php
      foreach ($site_content['video_gallery'] as $slide) : ?>
      <div class="k-process__carousel__slide">

        <div class="k-process__carousel__text">
          <h2><?php echo $slide['heading']; ?></h2>
          <div class="k-rte-content">
            <?php echo $slide['body']; ?>
          </div>
        </div>

        <div class="k-process__carousel__image">
          <figure class="k-figure">
            <div class="k-figure--liner">
              <img data-src="<?php echo $slide['placeholder_image']['url']; ?>" alt="<?php echo $slide['placeholder_image']['alt'];?>" class="k-figure--img">
            </div>
          </figure>
        </div>

      </div>
      <?php endforeach; ?>
    </div>

    <div class="k-process__controls">
      <span class="k-process__prev">&larr;</span>
      <span class="k-process__current">01/08</span>
      <span class="k-process__next">&rarr;</span>
    </div>

  </div>
</section>
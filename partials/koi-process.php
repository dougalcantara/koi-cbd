<?php
$root = get_template_directory_uri();
?>

<section class="k-process k-block k-block--md">
  <div class="k-inner k-inner--md">

    <div class="k-process__iconrow">
      <div class="k-process__iconrow__item active">
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
          get_template_part('partials/svg/koi-bottle');
          ?>
        </div>
        <div class="k-process__iconrow__title">
          <p>Tracking With Batch Numbers</p>
        </div>
      </div>

    </div>

    <div class="k-process__carousel">
      <?php
      for ($i = 0; $i < 8; $i++) { ?>
      <div class="k-process__carousel__slide">

        <div class="k-process__carousel__text">
          <h2>Vetting Organic CBD Farms. It Starts with the best of the best.</h2>
          <div class="k-rte-content">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsa temporibus incidunt asperiores saepe atque ex est, officia quo quasi amet soluta provident necessitatibus et officiis odit, eius accusantium at magni ducimus labore excepturi? Accusantium est, adipisci recusandae facilis nobis nisi!</p>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Vel officia suscipit perspiciatis cum nobis facilis sed exercitationem cumque assumenda dolor alias necessitatibus quas id, ipsa at quis hic aperiam earum mollitia repellat est autem! Iste?</p>
          </div>
        </div>

        <div class="k-process__carousel__image">
          <figure class="k-figure">
            <div class="k-figure--liner">
              <img data-src="<?php echo $root . '/dist/img/budding-plant.jpg'; ?>" alt="" class="k-figure--img">
            </div>
          </figure>
        </div>

      </div>
      <?php
      }
      ?>
    </div>

    <div class="k-process__controls">
      <span class="k-process__prev">&larr;</span>
      <span class="k-process__current">01/08</span>
      <span class="k-process__next">&rarr;</span>
    </div>

  </div>
</section>
<?php

function k_hero($args) {
  ob_start(); ?>

  <section class="k-hero k-hero--productlisting on-dark">
    <div class="k-hero--bgimg" data-src="<?php echo $args['background_image'] ? $args['background_image'] : 'https://via.placeholder.com/1800x750'; ?>"></div>
    <div class="k-inner k-inner--md">

      <div class="k-hero--content">

        <h4 class="k-hero--preheading k-upcase"><?php echo $args['preheading']; ?></h4>

        <h1 class="k-headline k-headline--md"><?php echo $args['headline'] ?></h1>

        <div class="k-rte-content">
          <h2><?php echo $args['body']; ?></h2>
        </div>

      </div>

    </div>
  </section>

  <?php
    $result = ob_get_contents();
    ob_end_clean();
    return $result;
}

?>

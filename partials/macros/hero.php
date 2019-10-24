<?php

function k_hero($args) {
  ob_start(); ?>

  <section class="k-hero k-hero--productlisting on-dark">
    <div class="k-hero--bgimg" data-src="https://via.placeholder.com/1800x750"></div>
    <div class="k-inner k-inner--md">

      <div class="k-hero--content">

        <div class="k-hero--preheading k-upcase"><?php echo $args['preheading']; ?></div>

        <h2 class="k-headline k-headline--md"><?php echo $args['headline'] ?></h2>

        <div class="k-rte-content">
          <?php echo $args['body']; ?>
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
<?php 

function k_product_video($args) {
  ob_start(); ?>

  <div class="k-productvideo k-block k-block--md k-bg-dark">

    <div class="k-inner k-inner--sm">

      <div class="k-productvideo--title">
        <span class="k-upcase k-productvideo--preheading"><?php echo $args['preheadline']; ?></span>
        <h2 class="k-headline k-headline--sm"><?php echo $args['headline']; ?></h2>
      </div>

      <div class="k-productvideo--main">
        <div class="k-productvideo--videoheading">
          <h2><?php echo $args['video_headline']; ?></h2>
        </div>

        <div class="k-productvideo--body k-rte-content">
          <?php echo $args['body_copy']; ?>
        </div>

        <div class="k-productvideo--video">
          <div class="k-videoembed">
            <figure class="k-figure k-figure--rounded k-figure--fpo">
              <div class="k-figure--liner">
                <!-- <img src="" alt="" class="k-figure--img"> -->
              </div>
            </figure>
          </div>
        </div>
      </div>

    </div>

  </div>

  <?php
    $result = ob_get_contents();
    ob_end_clean();
    return $result;
}

?>


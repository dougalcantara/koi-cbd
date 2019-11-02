<?php
  $root = get_template_directory_uri();
?>

<section class="k-ctabanner">
  <div class="k-inner k-inner--xl">
    <div class="k-ctabanner--bgimg" data-src="<?php echo $root.'/dist/img/koi-cta-bg.jpg'; ?>"></div>
    
    <div class="k-inner k-inner--md">
      <div class="k-ctabanner--content k-block k-block--md">
        <div class="k-preheading k-upcase"><?php echo $cta_fields['preheading']; ?></div>
        <h3 class="k-headline k-headline--sm"><?php echo $cta_fields['heading']; ?></h3>
        <a href="<?php echo $cta_fields['link']['url']; ?>" class="k-button k-button--secondary"><?php echo $cta_fields['link']['title']; ?> &nbsp; &rarr;</a>
      </div>
    </div>
  </div>
</section>

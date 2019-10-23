<?php
  $root = get_template_directory_uri();
?>
<section class="k-hero k-hero--default k-hero--center k-hero--on-dark">
  <div class="k-hero--bgimg" data-src="<?php echo $root.'/dist/img/koi-home-hero.jpg' ?>"></div>
  <div class="k-inner k-inner--md">
    <div class="k-hero--text">
      <h2 class="k-headline k-headline--lg"><?php echo $hero_fields['headline']; ?></h2>
      <div class="k-hero--bigtext">
        <h1 class="k-headline--fake"><?php echo $hero_fields['body']; ?></h1>
      </div>
    </div>
    <div class="k-hero--action">
      <div class="k-button k-button--primary">Shop All CBD Products &nbsp; &rarr;</div>
      <div class="k-button k-button--secondary">Find My CBD Product</div>
    </div>
  </div>
</section>
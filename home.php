<?php
  $root = get_template_directory_uri();

  /* Template Name: Homepage */
  get_header();

  get_template_part('partials/home-hero');
  get_template_part('partials/promo-slider');
?>

<section class="k-overview k-block k-block--lg">
  <div class="k-inner k-inner--default">
    <div class="k-overview--intro">
      <div class="k-overview--intro__text">
        <div class="k-preheading">
          <span class="k-upcase">Koi CBD Products</span>
        </div>
        <div class="k-heading">
          <h2 class="k-headline k-headline--md">Tinctures, Topicals, Edibles, Pets, Vapes & More.</h2>
        </div>
        <div class="k-textbody">
          <p>Welcome to the Awesome World of CBD.</p>
        </div>
        <div class="k-action">
          <a href="#0" class="k-button k-button--primary">Shop All CBD Products &nbsp; &rarr;</a>
        </div>
      </div>
      <div class="k-overview--intro__image">
        <div class="k-figure">
          <div class="k-figure--liner">
            <img src="<?php echo $root.'/dist/img/koi-peppermint-mainimg.jpg' ?>" alt="" />
          </div>
        </div>
        <img src="<?php echo $root.'/dist/img/koi-peppermint-cornerimg@2x.png' ?>" alt="" class="m-cornerimg">
      </div>
    </div>
  </div>
</section>

<?php 
  get_footer();
?>
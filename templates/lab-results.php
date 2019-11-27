<?php

if (!defined('ABSPATH')) {
	exit;
}
/* Template Name: 2019 Lab Results Page */
$root = get_template_directory_uri();

get_header();
?>

<section class="k-hero k-hero--twocol k-hero--labresults">
  <div class="k-hero--bgimg" data-src="<?php echo $root . '/dist/img/koi-cta-bg.jpg'; ?>"></div>
  <div class="k-inner k-inner--md">

    <div class="k-hero__main">
    
      <div class="k-hero__heading">
        <span class="k-preheading k-upcase">Lab Results</span>
        <h2 class="k-headline k-headline--md">From Plant to Finished Product</h2>
      </div>
    
      <div class="k-hero__body k-rte-content">
        <p>All Koi products are lab-tested for purity, consistency, and safety. Plus, we offer full traceability on every batch of our CBD.</p>
      </div>


    </div>
  
  </div>
</section>

<?php get_template_part('partials/components/randoms/breadcrumb'); ?>

<section class="k-labresults k-block k-block--md">
  <div class="k-inner k-inner--md">

    <div class="k-labresults__searchform">
      <span class="k-preheading k-upcase">Search by Batch #</span>
      <form class="k-form" id="k-resultssearch">
        <div class="k-form__content">
          <input
            type="text"
            name="lab-result-search"
            id="k-resultssearchval"
            placeholder="search..."
          />
          <button type="submit" class="k-button k-button--dark k-upcase">Search Results</button>
        </div>
      </form>
    </div>

    <div class="k-labresults__main">
      <div id="resultsembedtarget"></div>
    </div>

  </div>
</section>

<?php
get_footer();
?>

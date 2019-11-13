<?php
defined( 'ABSPATH' ) || exit;
/* Template Name: 2019 About Us Page */

$root = get_template_directory_uri();
$site_content = get_fields('option');

get_header();
?>

<section class="k-hero k-hero--productlisting k-hero--aboutus">
  <div class="k-hero--bgimg" data-src="<?php echo $site_content['about_us_hero_background_image']['url']; ?>"></div>
  <div class="k-inner k-inner--md">

    <div class="k-hero--content">

      <h2 class="k-headline k-headline--md"><?php echo $site_content['about_us_hero_headline']; ?></h2>

      <div class="k-rte-content">
        <p><?php echo $site_content['about_us_hero_body']; ?></p>
      </div>

    </div>

  </div>
</section>

<section class="k-twoup-text k-block k-block--md k-half-padding--bottom">
  <div class="k-inner k-inner--md">

    <div class="k-twoup-text--title">
      <h2 class="k-headline k-headline--md"><?php echo $site_content['trust_section_heading']; ?></h2>
      <p class="k-bigtext"><?php echo $site_content['trust_section_subheading']; ?></p>
      <div class="k-twoup-imagerow">
      <img src="<?php echo $root . '/dist/img/us-hemp-roundtable-badge@2x.png'; ?>" alt="">
      <img src="<?php echo $root . '/dist/img/hia-member-badge@2x.png'; ?>" alt="">
      <img src="<?php echo $root . '/dist/img/chc-badge@2x.png'; ?>" alt="">
      </div>
    </div>

    <div class="k-twoup-text--body k-rte-content">
      <?php echo $site_content['trust_section_body']; ?>
    </div>

  </div>
</section>

<section class="k-presspromo k-block k-block--md">
  <div class="k-inner k-inner--md">
  
    <div class="k-presspromo--image">
      <figure class="k-figure k-figure--rounded">
        <div class="k-figure--liner">
          <img data-src="<?php echo $root . '/dist/img/koi-man-running.jpg' ?>" alt="" class="k-figure--img">
        </div>
      </figure>
    </div>

    <div class="k-presspromo--main">

      <div class="k-presspromo--title">
        <h2 class="k-headline k-headline--sm"><?php echo $site_content['press_section_heading']; ?></h2>
      </div>

      <div class="k-presspromo--cards">
        <div class="k-presspromo--card">
          <div class="k-presspromo--card__liner">
            <span class="k-preheading">01</span>
            <h3 class="k-headline k-headline--body">Press Releases & Announcements Headline Goes Here</h3>
            <div class="k-presspromo--card__body k-rte-content">
              <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Minus animi quaerat quam dolores ab repellat.</p>
            </div>
            <div class="k-presspromo--card__action">
              <a href="#0">&rarr;</a>
            </div>
          </div>
        </div>
        <div class="k-presspromo--card">
          <div class="k-presspromo--card__liner">
            <span class="k-preheading">02</span>
            <h3 class="k-headline k-headline--body">Press Releases & Announcements Headline Goes Here</h3>
            <div class="k-presspromo--card__body k-rte-content">
              <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Minus animi quaerat quam dolores ab repellat.</p>
            </div>
            <div class="k-presspromo--card__action">
              <a href="#0">&rarr;</a>
            </div>
          </div>
        </div>
      </div>

      <div class="k-presspromo--action">
        <a href="<?php echo site_url() . '/blog?category=hot-off-the-press'; ?>" class="k-button k-button--dark">View All &rarr;</a>
      </div>
    </div>

  </div>
</section>

<?php
get_template_part('partials/video-fullwidth');
?>

<section class="k-twoup-text k-block k-block--md k-half-padding--bottom">
  <div class="k-inner k-inner--md">

    <div class="k-twoup-text--title">
      <h2 class="k-headline k-headline--sm"><?php echo $site_content['our_process_section_heading']; ?></h2>
    </div>

    <div class="k-twoup-text--body k-rte-content">
      <?php echo $site_content['our_process_section_body']; ?>
    </div>

  </div>
</section>

<?php
include(locate_template('partials/koi-process.php'));
get_template_part('partials/testimonial-slider');
get_template_part('partials/resources-callout');

$slider_fields = array(
  'headline' => $site_content['about_us_featured_products_heading'],
  'products' => $site_content['about_us_featured_products'],
  'half_padding_top' => true,
);
include(locate_template('partials/promo-slider.php'));

get_footer();
?>
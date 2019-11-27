<?php
/* Template Name: 2019 Wholesale Program Page */

if (!defined('ABSPATH')) {
  exit;
}

get_header();

echo k_hero(array(
  'headline' => get_fields()['wholesale_hero_title'],
  'body' => get_fields()['wholesale_hero_subtitle'],
  'background_image' => get_fields()['wholesale_hero']['url'],
));
get_template_part('partials/components/randoms/breadcrumb');
?>

  <section class="k-introtext k-block k-block--md">
    <div class="k-inner k-inner--sm k-rte-content">
    <?php if(have_posts()): while(have_posts()): the_post(); ?>

        <h2 class="k-headline k-headline--sm"><?php the_title() ;?></h2>
          <?php the_content() ;?>
      <?php endwhile; endif; ?>
    </div>
  </section>

  <section class="k-veterans k-block k-block--md k-no-padding--top">
    <div class="k-inner k-inner--sm">

      <!--[if lte IE 8]>
      <script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/v2-legacy.js"></script>
      <![endif]-->
      <script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/v2.js"></script>
      <script>
        hbspt.forms.create({
          portalId: "6283239",
          formId: "4d59f396-b292-498b-8f94-77b101a16f39"
        });
      </script>

    </div>
  </section>

<?php
get_footer();
?>
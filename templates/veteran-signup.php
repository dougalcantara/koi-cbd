<?php
/* Template Name: 2019 Veteran Signup Page */

if (!defined('ABSPATH')) {
	exit;
}

get_header();

echo k_hero(array(
  'headline' => 'Koi CBD Veteran Program',
  'body' => 'Our way of thanking all those who have served.',
  'background_image' => get_fields()['veteran_hero_background_image']['url'],
));
?>

<section class="k-introtext k-block k-block--md">
  <div class="k-inner k-inner--sm k-rte-content">
    <h2 class="k-headline k-headline--sm">We Honor Those Who Serve & Have Served</h2>
    <p>At Koi, we are grateful for those who’ve served as members of the United States military. We’d like to extend a special lifelong discount program as our way of thanking you for your service to our country. By signing up below you’ll be given access to a special account that automatically applies a 25% to discount to every order you place.</p>
    <p>Use the form below to upload a copy of your VA card, State issued Drivers license or ID which shows your Veteran designation or your most recent “LES” (Military Pay Stub) for active duty.</p>
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
      formId: "98d14bc4-a93c-499b-bc41-fd56e2c631ef"
    });
    </script>

  </div>
</section>

<?php
get_footer();
?>
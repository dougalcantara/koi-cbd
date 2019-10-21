<?php
defined( 'ABSPATH' ) || exit;
/* Template Name: 2019 About Us Page */

$root = get_template_directory_uri();
$aboutus_acf = get_fields();

get_header();

do_action('k_before_first_section');
?>

<section class="k-hero k-hero--productlisting k-hero--aboutus">
  <div class="k-hero--bgimg" style="background-image: url(<?php echo $root . '/dist/img/generic-countertop.jpg'; ?>)"></div>
  <div class="k-inner k-inner--md">

    <div class="k-hero--content">

      <h2 class="k-headline k-headline--md">We Believe In Helping People Live Better</h2>

      <div class="k-rte-content">
        <p>Nature gives us CBD. We simply harvest this gift to help people of all ages, interests, and needs experience its restorative properties.</p>
      </div>

    </div>

  </div>
</section>

<section class="k-twoup-text k-block k-block--md k-half-padding--bottom">
  <div class="k-inner k-inner--md">

    <div class="k-twoup-text--title">
      <h2 class="k-headline k-headline--md">Setting The CBD Quality Standard Since 2015</h2>
      <p class="k-bigtext">Proud to Be Members Driving CBD Forward</p>
      <div class="k-twoup-imagerow">
      <img src="<?php echo $root . '/dist/img/us-hemp-roundtable-badge@2x.png'; ?>" alt="">
      <img src="<?php echo $root . '/dist/img/hia-member-badge@2x.png'; ?>" alt="">
      <img src="<?php echo $root . '/dist/img/chc-badge@2x.png'; ?>" alt="">
      </div>
    </div>

    <div class="k-twoup-text--body k-rte-content">
      <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Explicabo voluptates modi itaque repudiandae, suscipit soluta et facilis numquam quisquam quis tempore sint esse a aliquid! Lorem ipsum dolor sit amet.</p>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloribus ipsum reiciendis libero adipisci veritatis, autem voluptatum est incidunt asperiores facere vel sit omnis quisquam quo? Optio, voluptatum fuga praesentium, non dolore eos assumenda soluta perferendis impedit, cupiditate laboriosam ab sit id. Laborum sunt, aliquam magni quod suscipit nam temporibus unde.</p>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Excepturi, commodi expedita voluptatem debitis dicta magni modi ut odio deserunt quaerat eum nesciunt impedit perferendis sint! Lorem ipsum, dolor sit amet consectetur adipisicing elit. Modi, accusantium.</p>
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
        <h2 class="k-headline k-headline--sm">What's New With Koi</h2>
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
        <a href="#0" class="k-button k-button--dark">View All &rarr;</a>
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
      <h2 class="k-headline k-headline--sm">What Goes Into Creating The Highest Quality CBD?</h2>
    </div>

    <div class="k-twoup-text--body k-rte-content">
      <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Explicabo voluptates modi itaque repudiandae, suscipit soluta et facilis numquam quisquam quis tempore sint esse a aliquid! Lorem ipsum dolor sit amet.</p>
      <p>Doloribus ipsum reiciendis libero adipisci veritatis, autem voluptatum est incidunt asperiores facere vel sit omnis quisquam quo? Optio, voluptatum fuga praesentium, non dolore eos assumenda soluta perferendis impedit, cupiditate laboriosam ab sit id. Laborum sunt, aliquam magni quod suscipit nam temporibus unde.</p>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Excepturi, commodi expedita voluptatem debitis dicta magni modi ut odio deserunt quaerat eum nesciunt impedit perferendis sint! Lorem ipsum, dolor sit amet consectetur adipisicing elit. Modi, accusantium.</p>
    </div>

  </div>
</section>


<?php
get_footer();
?>
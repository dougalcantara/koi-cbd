<?php
  /* Template Name: 2019 Contact Page */
  defined( 'ABSPATH' ) || exit;

  $root = get_template_directory_uri();
  $contact_acf = get_fields();

  get_header();

  do_action('k_before_first_section');
?>
<section class="k-hero k-hero--contact on-dark">
  <div class="k-hero--bgimg" data-src="<?php echo $contact_acf['hero_background_image']['url']; ?>"></div>
  <div class="k-inner k-inner--md">
  
    <div class="k-hero--main">

      <div class="k-hero--title">
        <span class="k-preheading k-upcase"><?php echo $contact_acf['hero_preheading']; ?></span>
        <h2 class="k-headline k-headline--md"><?php echo $contact_acf['hero_headline']; ?></h2>
      </div>

      <div class="k-hero--body">
        <h1 class="k-headline--fake"><?php echo $contact_acf['hero_body']; ?></h1>
      </div>

    </div>

  </div>
</section>

<?php get_template_part('partials/components/randoms/breadcrumb'); ?>

<section class="k-faq k-block k-block--md k-half-padding--top">
  <div class="k-faq--heading">
    <h2 class="k-headline k-headline--md">FAQ</h2>
  </div>
  <div class="k-inner k-inner--md">

    <aside class="k-faq--sidebar">
      <div class="k-faq--sidebar__liner">
        <ul>
          <li>
            <h2>Koi Hotline</h2>
            <a href="tel:8777744779">877 774-4779</a>
          </li>
          <li>
            <h2>Email Us Today</h2>
            <a href="mailto:customerservice@koicbd.com">CustomerService@koicbd.com</a>
          </li>
          <li>
            <h2>U.S. Address</h2>
            <p>14631 Best Ave.</p>
            <p>Norwalk, CA 90650</p>
          </li>
        </ul>
      </div>
    </aside>

    <div class="k-faq--accordion">
      <div class="k-faq--accordion__liner">

      <?php
        foreach($contact_acf['faqs'] as $index => $faq) { ?>
        <div class="k-faq--item">
          <div class="k-faq--item__liner">
            <div class="k-faq--item__heading">
              <h2><?php echo $faq['question']; ?></h2>
              <span class="k-faq--item__status">+</span>
            </div>
            <div class="k-faq--item__drawer">
              <div class="k-faq--item__heighttarget">
                <p><?php echo $faq['answer']; ?></p>
              </div>
            </div>
          </div>
        </div>
      <?php
        }
      ?>

      </div>
    </div>

  </div>
</section>

<section class="k-contactus">
  <div class="k-inner k-inner--xl">
    <div class="k-inner k-inner--md k-block k-block--md">
      <figure class="k-figure k-figure--rounded">
        <div class="k-figure--liner">
          <img src="<?php echo $root . '/dist/img/koi-man-running.jpg' ?>" alt="" class="k-figure--img">
        </div>
      </figure>

      <div class="k-contactus--title">
        <div class="k-preheading k-upcase">Still Have Questions?</div>
        <h2 class="k-headline k-headline--sm">Get In Touch With Us Today</h2>
      </div>
      
      <div class="k-contactus--main">
        
        <form class="k-form" data-hs-form-id="67c23143-5b98-4d3e-9597-c24f1c6efb80">

          <fieldset class="k-form--group">
            <label for="k-firstname">First Name <span>*</span></label>
            <input type="text" name="firstname" id="k-firstname" />
          </fieldset>

          <fieldset class="k-form--group">
            <label for="k-lastname">Last Name <span>*</span></label>
            <input type="text" name="lastname" id="k-lastname" />
          </fieldset>

          <fieldset class="k-form--group">
            <label for="k-email">Email Address <span>*</span></label>
            <input type="email" name="email" id="k-email" />
          </fieldset>

          <fieldset class="k-form--group">
            <label for="k-message">Your Message <span>*</span></label>
            <input type="text" name="message" id="k-message" />
          </fieldset>

          <button type="submit" class="k-button k-button--dark k-upcase">Submit</button>
        </form>

        <div class="k-form--message">
          <p>Thanks for submitting the form. We will be in contact with you shortly.</p>
        </div>

      </div>
    </div>
  </div>
</section>

<?php
  get_footer();
?>
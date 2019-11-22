<?php
$root = get_template_directory_uri();
$fields = get_fields();
$site_content = get_fields('option');

get_header(); ?>

  <section class="koi-error">
    <img src="https://koicbddev.wpengine.com/wp-content/uploads/DSC_6309.jpg" alt="error-image">
    <h1>No results found</h1>
    <p>The page you've requested could not be found. Please try refining your search or using the navigation to locate the page you're looking for.</p>
    <a class="k-button k-button--primary" href="<?php echo get_home_url()?>">Go to homepage</a>
  </section>

  <?php
    $slider_fields = array(
      'headline' => $site_content['product_slider_headline'],
      'products' => $site_content['product_slider_products'],
      'half_padding_top' => true,
    );
    include(locate_template('partials/promo-slider.php'));
  ?>

<?php get_footer(); ?>

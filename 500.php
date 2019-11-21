<?php
$root = get_template_directory_uri();
$fields = get_fields();
$site_content = get_fields('option');

get_header(); ?>

  <section class="koi-error-500">
    <img src="https://koicbddev.wpengine.com/wp-content/uploads/DSC_6309.jpg" alt="error-image">
    <h1>Unexpected Error</h1>
    <p>We've hit an unexpected error with the page you're looking for. Please use the navigation to continue browsing our site.</p>
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

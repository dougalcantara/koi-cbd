<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

function formatAttrName($string)
{
  $arr = explode('-', $string);

  foreach ($arr as $idx => $str) {
    $arr[$idx] = ucfirst($str);
  }

  return join(' ', $arr);
}

get_header( 'shop' ); ?>

	<?php
		/**
		 * woocommerce_before_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action( 'woocommerce_before_main_content' );
	?>

	<?php include(locate_template('partials/product-rich-snippets.php')); ?>

		<?php while ( have_posts() ) : the_post(); ?>
		<?php
		  $product_id = $product->get_id();
  		$product_acf = get_fields();
  		$cat_name = get_the_terms($product_id, 'product_cat');
  		$product_category = reset($cat_name)->slug;
  		$product_wc_type = $product->get_type();
		?>
			<div class="k-inner k-inner--md">
				<?php wc_get_template_part( 'content', 'single-product' ); ?>
			</div>
		<?php endwhile; // end of the loop. ?>
	<?php
		/**
		 * woocommerce_after_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>
	</div>
</div>
<?php
  new Breadcrumbs([
    [
      'name' => 'Home',
      'url' => home_url()
    ],
    [
      'name' => 'Shop All',
      'url' => home_url() . '/cbd-products'
    ],
    [
      'name' => $product_category = reset($cat_name)->name,
      'url' => home_url() . '/' . $product_category = reset($cat_name)->slug
    ],
    [
      'name' => $product->name,
      'url' => home_url() . '/product/' . $product->slug
    ]
  ]);
?>
<?php
	include(locate_template('partials/product-details.php'));
  if ($product_category != 'merchandise' && $product_category != 'vape-devices-cartridges') {
		// these categories don't have lab results associated with them
    include(locate_template('partials/product-latest-batch.php'));	
	}
	include(locate_template('partials/product-reviews.php'));
  $slider_fields = array(
    'headline' => 'Shop Customer Favorites',
    'products' => $product_acf['other_recommended_products'],
  );

  include(locate_template('partials/promo-slider.php'));	
?>
	<?php
		/**
		 * woocommerce_sidebar hook.
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */

		/**
		 * MAG override
		 * 
		 * was not commented out
		 */
		// do_action( 'woocommerce_sidebar' );
	?>

<?php get_footer( 'shop' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */

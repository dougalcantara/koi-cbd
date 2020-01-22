<?php
/* Template Name: 2019 Thank You Page */

get_header();

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$root = get_template_directory_uri();
$order = wc_get_customer_last_order(get_current_user_id());

if ($order && is_user_logged_in()) {
  $order_items           = $order->get_items(apply_filters('woocommerce_purchase_order_item_types', 'line_item'));
  $show_purchase_note    = $order->has_status(apply_filters('woocommerce_purchase_note_order_statuses', array('completed', 'processing')));
  $show_customer_details = is_user_logged_in() && $order->get_user_id() === get_current_user_id(); ?>

  <section class="k-hero k-hero--twocol k-hero--labresults">
    <div class="k-hero--bgimg" data-src="<?php echo $root . '/dist/img/koi-cta-bg.jpg'; ?>"></div>
    <div class="k-inner k-inner--md">

      <div class="k-hero__main">
      
        <div class="k-hero__heading">
          <h2 class="k-headline k-headline--md">Thank you. Your order has been received.</h2>
        </div>

        <div class="k-hero__body k-rte-content">
          <p>Please review your order below.</p>
        </div>
      </div>
    
    </div>
  </section>

  <?php new Breadcrumbs([
    [
      'name' => 'Home',
      'url' => home_url()
    ],
    [
      'name' => get_the_title(),
      'url' => get_the_permalink()
    ]
  ]); ?>

  <section class="woocommerce-order-details k-block k-block--md k-orderreceived">
    <div class="k-inner k-inner--md">
      <?php do_action( 'woocommerce_order_details_before_order_table', $order ); ?>

      <div class="k-orderreceived__table">
        <div class="k-orderreceived__title">
          <h2>Order Details</h2>
        </div>
        <div class="k-orderreceived__head">
          <div class="k-orderreceieved__headitem"><h3>Product</h3></div>
          <div class="k-orderreceieved__headitem"><h3>Total</h3></div>
        </div>
        <div class="k-orderreceived__body">
        <?php
        do_action('woocommerce_order_details_before_order_table_items', $order);

        foreach ($order_items as $item_id => $item) :
        $product = $item->get_product(); ?>

        <div class="k-orderreceived__item">
          <div>
            <p>
              <a href="<?php echo $product->get_permalink($item); ?>"><?php echo $product->get_name(); ?></a>
              <strong>&nbsp;x<?php echo $item->get_quantity(); ?></strong>
            </p>
          </div>
          <div>
            <p class="k-bigtext"><?php echo $order->get_formatted_line_subtotal($item); ?></p>
          </div>
        </div>
        <?php endforeach; ?>

        <div class="k-orderreceived__item">
          <div>
            <p>Subtotal</p>
          </div>
          <div>
            <p class="k-bigtext">$<?php echo $order->get_subtotal(); ?></p>
          </div>
        </div>

        <?php foreach ($order->get_taxes() as $tax_item) : ?>
        <div class="k-orderreceived__item">
          <div>
            <p><?php echo $tax_item->get_label(); ?></p>
          </div>
          <div>
            <p class="k-bigtext">$<?php echo number_format($tax_item->get_tax_total(), 2); ?></p>
          </div>
        </div>
        <?php endforeach; ?>
        
        <div class="k-orderreceived__item">
          <div>
            <p>Payment method</p>
          </div>
          <div>
            <p><?php echo $order->get_payment_method_title(); ?></p>
          </div>
        </div>

        <?php if ($order->get_customer_note()) : ?>
        <div class="k-orderreceived__item">
          <div>
            <p>Purchase note</p>
          </div>
          <div>
            <p><?php echo $order->get_customer_note(); ?></p>
          </div>
        </div>
        <?php endif; ?>

        <div class="k-orderreceived__item">
          <div>
            <p>Total</p>
          </div>
          <div>
            <p class="k-bigtext">$<?php echo $order->get_total(); ?></p>
          </div>
        </div>
        
        <?php do_action( 'woocommerce_order_details_after_order_table_items', $order ); ?>
        </div>
      </div>

      <?php do_action( 'woocommerce_order_details_after_order_table', $order );

      if ( $show_customer_details ) {
        wc_get_template( 'order/order-details-customer.php', array( 'order' => $order ) );
      } ?>
    </div>
  </section>

<?php
} else { ?>
  <section class="k-hero k-hero--twocol k-hero--labresults">
    <div class="k-hero--bgimg" data-src="<?php echo $root . '/dist/img/koi-cta-bg.jpg'; ?>"></div>
    <div class="k-inner k-inner--md">

      <div class="k-hero__main">
      
        <div class="k-hero__heading">
          <h2 class="k-headline k-headline--md" style="margin-bottom: 1em;">No order found.</h2>
          <a href="<?php echo site_url(); ?>" class="k-button k-button--primary">Start Shopping</a>
        </div>
      </div>
    
    </div>
  </section>
<?php
}
get_footer();
?>
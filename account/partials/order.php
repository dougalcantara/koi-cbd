<?php $order = wc_get_order($url[4]); ?>
<h1>Order #<?php echo $order->get_id(); ?></h1>
<div class="order">
  <div class="order-table">

    <div class="order-row">
      <div class="order-label">
        Payment Status:
      </div>
      <div class="order-value">
        <?php echo $order->get_status(); ?>
      </div>
    </div>

    <div class="order-row">
      <div class="order-label">
        Date
      </div>
      <div class="order-value">
        <?php echo $order->get_date_created()->format ('Y-m-d'); ?>
      </div>
    </div>

  </div>
</div>

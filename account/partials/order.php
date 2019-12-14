<?php $order = wc_get_order($url[4]); ?>
<h1>Order #<?php echo $order->get_id(); ?></h1>
<div class="order">
  <table>
    <tr>
      <td colspan="2">
        <span>DETAILS</span>
      </td>
    </tr>
    <tr>
      <td>
        Payment Status
      </td>
      <td>
        <?php echo $order->get_status(); ?>
      </td>
    </tr>
    <tr>
      <td>
        Date
      </td>
      <td>
        <?php echo $order->get_date_created()->format ('Y-m-d'); ?>
      </td>
    </tr>
    <tr>
      <td colspan="3">
        <span>ITEMS</span>
      </td>
    </tr>
    <tr>
      <td colspan="2">
        <table class="order-items">
          <?php $items = $order->get_items(); ?>
          <?php foreach($items as $item): ?>
            <tr>
              <td>
                <?php echo $item['name']; ?>
              </td>
              <td>
                <?php echo $item['quantity']; ?>
              </td>
              <td>
                <?php echo $item['total']; ?>
              </td>
            </tr>
          <?php endforeach; ?>
          <tr>
            <td colspan="2">TOTAL</td>
            <td>$<?php echo $order->get_total(); ?></td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
  <a href="<?php echo home_url(); ?>/account/past-orders" class="back-link">Back To Orders</a>
</div>
<?php check_login();
/**
 * Template Name: Account
 */ get_header(); ?>
<div class="account account-dashboard">
  <nav class="account-breadcrumbs">
    <ul class="account-breadcrumbs-inside">
      <li>
        <a href="<?php echo home_url(); ?>">
          Home
        </a>
      </li>
      <li>
        <span>
          Account
        </span>
      </li>
    </ul>
  </nav>
  <div class="account-inside">
    <main class="account-content">
      <h1>Account Overview</h1>
      <div class="order-list list">
        <div class="list-head">
          <div class="list-head-item">
            Order
          </div>
          <div class="list-head-item">
            Date
          </div>
          <div class="list-head-item">
            Payment
          </div>
          <div class="list-head-item">
            Total
          </div>
        </div>
        <div class="list-body">
          <?php
            $user = get_current_user_id();
            $orders = wc_get_orders( array(
              'meta_key' => '_customer_user',
              'meta_value' => $user,
              'numberposts' => 10
            )); ?>
          <?php if($orders): ?>
            <?php foreach($orders as $order): ?>
              <div class="list-row">
                <div class="list-row-item">
                  <a href="<?php echo $order->get_id(); ?>">#<?php echo $order->get_id(); ?></a>
                </div>
                <div class="list-row-item">
                  <?php echo $order->get_date_created()->format ('Y-m-d'); ?>
                </div>
                <div class="list-row-item">
                  <span class="paid"><?php echo $order->get_status(); ?></span>
                </div>
                <div class="list-row-item">
                  $<?php echo $order->get_total(); ?>
                </div>
              </div>
            <?php endforeach; ?>
            <div class="list-link">
              <a href="#">All Orders</a>
            </div>
          <?php else: ?>
            <p>You have no orders yet</p>
          <?php endif; ?>
        </div>
      </div>
    </main>
    <?php get_template_part('account/partials/sidebar'); ?>
  </div>
</div>
<?php get_footer(); ?>

<?php global $current_user; ?>
<div class="sidebar">
  <div class="sidebar-content">
    <h2 class="sidebar-name">
      <?php echo $current_user->display_name; ?>
    </h2>
    <nav class="sidebar-nav">
      <div class="sidebar-nav-label">
        Manage Account
      </div>
      <ul>
        <li>
          <a href="<?php echo home_url(); ?>/account">
            <?php include(locate_template('partials/svg/icon-account.php')); ?>
            Account
          </a>
        </li>
        <li>
          <a href="<?php echo home_url(); ?>/account" class="highlight">
            <?php include(locate_template('partials/svg/icon-logout.php')); ?>
            Logout
          </a>
        </li>
        <li>
          <a href="<?php echo home_url(); ?>/account/lost-password">
            <?php include(locate_template('partials/svg/icon-password.php')); ?>
            Change Password
          </a>
        </li>
        <li>
          <a href="<?php echo home_url(); ?>/account/billing">
            <?php include(locate_template('partials/svg/icon-billing.php')); ?>
            Billing Address
          </a>
        </li>
        <li>
          <a href="<?php echo home_url(); ?>/account/shipping">
            <?php include(locate_template('partials/svg/icon-shipping.php')); ?>
            Shipping Address
          </a>
        </li>
        <li>
          <a href="<?php echo home_url(); ?>/account/past-orders">
            <?php include(locate_template('partials/svg/icon-order.php')); ?>
            My Orders
          </a>
        </li>
        <li>
          <a href="<?php echo home_url(); ?>/veteran-program">
            <?php include(locate_template('partials/svg/icon-discount.php')); ?>
            Apply For Military Discount
          </a>
        </li>
        <li>
          <a href="<?php echo home_url(); ?>/account/delete">
            <?php include(locate_template('partials/svg/icon-delete.php')); ?>
            Delete Account
          </a>
        </li>
      </ul>
    </nav>
    <div class="sidebar-fields">
      <div class="field">
        <div class="field-label">
          Email Address
        </div>
        <div class="field-value">
          <?php echo $current_user->user_email; ?>
        </div>
      </div>
      <div class="field">
        <div class="field-label">
          Shipping Address
        </div>
        <div class="field-value">
          <?php $customer = new WC_Customer(get_current_user_id()); ?>
          <?php echo $customer->get_billing_company(); ?><br>
          <?php echo $customer->get_billing_address_1(); ?><br>
          <?php echo $customer->get_billing_address_2(); ?><br>
          <?php echo $customer->get_billing_city(); ?><br>
          <?php echo $customer->get_billing_postcode(); ?><br>
        </div>
      </div>
    </div>
  </div>
</div>
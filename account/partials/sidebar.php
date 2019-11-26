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
            <?php get_template_part('partials/svg/icon-account'); ?>
            Account
          </a>
        </li>
        <li>
          <a href="<?php echo home_url(); ?>/account/password">
            <?php get_template_part('partials/svg/icon-password'); ?>
            Change Password
          </a>
        </li>
        <li>
          <a href="<?php echo home_url(); ?>/account/billing">
            <?php get_template_part('partials/svg/icon-billing'); ?>
            Billing Address
          </a>
        </li>
        <li>
          <a href="<?php echo home_url(); ?>/account/shipping">
            <?php get_template_part('partials/svg/icon-shipping'); ?>
            Shipping Address
          </a>
        </li>
        <li>
          <a href="<?php echo home_url(); ?>/account/past-orders">
            <?php get_template_part('partials/svg/icon-order'); ?>
            My Orders
          </a>
        </li>
        <li>
          <a href="<?php echo home_url(); ?>/veteran-program">
            <?php get_template_part('partials/svg/icon-discount'); ?>
            Apply For Military Discount
          </a>
        </li>
        <li>
          <a href="<?php echo home_url(); ?>/account/delete">
            <?php get_template_part('partials/svg/icon-delete'); ?>
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

        </div>
      </div>
    </div>
  </div>
</div>
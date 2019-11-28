<?php check_login();
/**
 * Template Name: Account - Orders
 */ get_header(); ?>
<div class="account account-orders">
  <nav class="account-breadcrumbs">
    <ul class="account-breadcrumbs-inside">
      <li>
        <a href="<?php echo home_url(); ?>">
          Home
        </a>
      </li>
      <li>
        <a href="<?php echo home_url(); ?>/account">
          Account
        </a>
      </li>
      <li>
        <span>
          Orders
        </span>
      </li>
    </ul>
  </nav>
  <div class="account-inside">
    <main class="account-content">
      <?php $url = explode('/', $_SERVER['REQUEST_URI']); ?>
      <?php if(count($url) === 6): ?>
        <?php include(locate_template('account/partials/order.php')); ?>
      <?php else: ?>
        <?php include(locate_template('account/partials/orders.php')); ?>
      <?php endif; ?>
    </main>
    <?php get_template_part('account/partials/sidebar'); ?>
  </div>
</div>
<?php get_footer(); ?>

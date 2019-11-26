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
        <span>
          Account
        </span>
      </li>
    </ul>
  </nav>
  <div class="account-inside">
    <main class="account-content">
      <h1>Orders</h1>
      <pre>
        <?php
        //$url = explode('/', $_SERVER['REQUEST_URI']);
        ?>
      </pre>
    </main>
    <?php get_template_part('account/partials/sidebar'); ?>
  </div>
</div>
<?php get_footer(); ?>

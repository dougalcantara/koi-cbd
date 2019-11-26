<?php check_login();
/**
 * Template Name: Account - Shipping
 */ get_header(); ?>
<div class="account account-shipping">
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
          Shipping
        </span>
      </li>
    </ul>
  </nav>
  <div class="account-inside">
    <main class="account-content">
      <h1>Shipping</h1>
      Shipping
    </main>
    <?php get_template_part('account/partials/sidebar'); ?>
  </div>
</div>
<?php get_footer(); ?>

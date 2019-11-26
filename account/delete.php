<?php check_login();
/**
 * Template Name: Account - Delete
 */ get_header(); ?>
<div class="account account-delete">
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
          Delete
        </span>
      </li>
    </ul>
  </nav>
  <div class="account-inside">
    <main class="account-content">
      <h1>Delete</h1>
      Delete
    </main>
    <?php get_template_part('account/partials/sidebar'); ?>
  </div>
</div>
<?php get_footer(); ?>

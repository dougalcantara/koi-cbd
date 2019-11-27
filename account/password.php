<?php check_login();
/**
 * Template Name: Account - Password
 */ get_header(); ?>
<div class="account account-password">
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
          Password
        </span>
      </li>
    </ul>
  </nav>
  <div class="account-inside">
    <main class="account-content">
      <h1>Change Password</h1>
      <form class="form" id="update-password" data-customer="<?php echo get_current_user_id(); ?>">
        <?php global $current_user; ?>

        <div class="field">
          <label for="password" class="field-label">
            Password
          </label>
          <input id="password" name="password" type="password" class="field-input" value="">
        </div>

        <div class="field">
          <button class="btn btn-submit" type="submit">Change</button>
        </div>

      </form>
    </main>
    <?php get_template_part('account/partials/sidebar'); ?>
  </div>
</div>
<?php get_footer(); ?>

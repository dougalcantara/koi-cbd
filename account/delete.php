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
      <form class="form" id="delete-account" method="post">
        <?php $user = new WC_Customer(get_current_user_id()); ?>
        <div class="field">
          <label for="password" class="field-label">
            Confirm Password
          </label>
          <input id="password" name="password" type="password" class="field-input" required>
        </div>
        <div class="field">
          <button class="btn btn-delete" type="submit">Delete</button>
          <?php Member::delete(); ?>
        </div>
      </form>
    </main>
    <?php get_template_part('account/partials/sidebar'); ?>
  </div>
</div>
<?php get_footer(); ?>

<?php check_login();
/**
 * Template Name: Account - Billing
 */ get_header(); ?>
<div class="account account-billing">
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
          Billing
        </span>
      </li>
    </ul>
  </nav>
  <div class="account-inside">
    <main class="account-content">
      <h1>Billing</h1>
      <form class="form" id="update-billing" data-customer="<?php echo get_current_user_id(); ?>">
        <?php $user = new WC_Customer(get_current_user_id()); ?>

        <div class="field">
          <label for="first_name" class="field-label">
            First Name
          </label>
          <input id="first_name" name="first_name" type="text" class="field-input" value="<?php echo $user->get_billing_first_name(); ?>">
        </div>

        <div class="field">
          <label for="last_name" class="field-label">
            Last Name
          </label>
          <input id="last_name" name="last_name" type="text" class="field-input" value="<?php echo $user->get_billing_last_name(); ?>">
        </div>

        <div class="field">
          <label for="company" class="field-label">
            Company
          </label>
          <input id="company" name="company" type="text" class="field-input" value="<?php echo $user->get_billing_company(); ?>">
        </div>

        <div class="field">
          <label for="address_1" class="field-label">
            Address 1
          </label>
          <input id="address_1" name="address_1" type="text" class="field-input" value="<?php echo $user->get_billing_address_1(); ?>">
        </div>

        <div class="field">
          <label for="address_2" class="field-label">
            Address 2
          </label>
          <input id="address_2" name="address_2" type="text" class="field-input" value="<?php echo $user->get_billing_address_2(); ?>">
        </div>

        <div class="field">
          <label for="city" class="field-label">
            City
          </label>
          <input id="city" name="city" type="text" class="field-input" value="<?php echo $user->get_billing_city(); ?>">
        </div>

        <div class="field">
          <label for="state" class="field-label">
            State
          </label>
          <input id="state" name="state" type="text" class="field-input" value="<?php echo $user->get_billing_state(); ?>">
        </div>

        <div class="field">
          <label for="postcode" class="field-label">
            Postcode
          </label>
          <input id="postcode" name="postcode" type="text" class="field-input" value="<?php echo $user->get_billing_postcode(); ?>">
        </div>

        <div class="field">
          <label for="country" class="field-label">
            Country
          </label>
          <input id="country" name="country" type="text" class="field-input" value="<?php echo $user->get_billing_country(); ?>">
        </div>

        <div class="field">
          <button class="btn btn-submit" type="submit">Update</button>
        </div>

      </form>
    </main>
    <?php get_template_part('account/partials/sidebar'); ?>
  </div>
</div>
<?php get_footer(); ?>

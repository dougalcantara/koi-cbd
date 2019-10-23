const $registerFormToggle = $('.k-toggle-register');
const $loginForm = $('.k-login__form--default');
const $registerForm = $('.k-login__form--register');
const $inputs = $('.k-input');

$inputs.keyup(function() {
  const $t = $(this);
  const hasValue = $t.val().length > 0;

  if (hasValue) {
    $t.addClass('has-value');
  } else {
    $t.removeClass('has-value');
  }
});

$registerFormToggle.click(function() {
  if ($loginForm.hasClass('is-visible')) {
    $loginForm.removeClass('is-visible');
    $registerForm.addClass('is-visible');
  } else {
    $loginForm.addClass('is-visible');
    $registerForm.removeClass('is-visible');
  }
});

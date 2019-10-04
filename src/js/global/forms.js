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

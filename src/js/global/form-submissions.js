const $hubspotForms = $('[data-hs-form-id]');

const BASE_URL =
  'https://api.hsforms.com/submissions/v3/integration/submit/6283239';

$hubspotForms.submit(function(e) {
  e.preventDefault();

  const $t = $(this);
  const $inputs = $t.find('input');
  const $messageField = $t.find('.k-form--message');
  const formId = $t.data('hs-form-id');

  const payload = {
    submittedAt: Date.now(),
    fields: undefined,
  };

  payload.fields = [...$inputs].map(input => ({
    name: input.name,
    value: input.value,
  }));

  $t.addClass('k-form--submitting');

  $.ajax({
    method: 'POST',
    url: `${BASE_URL}/${formId}`,
    contentType: 'application/json',
    data: JSON.stringify(payload),
    complete: function(res) {
      $t.removeClass('k-form--submitting');
      $t.addClass('k-form--submitted');
      $messageField.append(res.inlineMessage);
    },
  });
});

// $blogNewsletterSignup.submit(function(e) {
//   const $t = $(this);
// });

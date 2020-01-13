import $ from 'jquery';
const $hubspotForms = $('[data-hs-form-id]');
const $veteranSignup = $('#k-veteran-signup');

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

$veteranSignup.submit(function(e) {
  e.preventDefault();

  const $t = $(this);
  const formId = '98d14bc4-a93c-499b-bc41-fd56e2c631ef';

  const fields = {
    firstname: $t.find('#k-veterans-firstname').val(),
    lastname: $t.find('#k-veterans-lastname').val(),
    username: $t.find('#k-veterans-username').val(),
    email: $t.find('#k-veterans-email').val(),
    password: $t.find('#k-veterans-password').val(),
    hastried: $t
      .find('.k-has-tried')
      .find('input[type=radio]:checked')
      .val(),
    paperwork: $t.find('#k-veterans-paperwork'),
  };

  const hsPayload = {
    context: {
      ipAddress: undefined,
    },
    submittedAt: Date.now(),
    fields: [
      {
        name: 'firstname',
        value: fields.firstname,
      },
      {
        name: 'lastname',
        value: fields.lastname,
      },
      {
        name: 'email',
        value: fields.email,
      },
      {
        name: 'tried_koi',
        value: fields.hastried,
      },
      // {
      //   name: 'military_id',
      //   value: fields.paperwork,
      // },
      {
        name: 'veteran_program',
        value: 'veteran_applied',
      },
    ],
  };

  const file = fields.paperwork[0].files[0];
  const filename = file.name;
  const fr = new FileReader();

  fr.readAsDataURL(file);
  fr.onload = async function({ target }) {
    console.log(target.result);

    const data = {
      filename: filename.substr(0, filename.lastIndexOf('.')) || filename,
      b64: target.result,
    };

    console.log(data);

    const response = await fetch(
      'https://koi-veteran-paperwork-submit.herokuapp.com/',
      {
        method: 'POST',
        mode: 'no-cors',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(data),
      }
    )
      .then(response => console.log(response))
      .then(json => console.log(json));

    // $.ajax({
    //   method: 'POST',
    //   url:
    //     'https://cors-anywhere.herokuapp.com/',
    //   contentType: 'application/json',
    //   data,
    //   complete: res => console.log(res),
    // });
    // img.onload = function() {
    //   $.ajax({
    //     method: 'POST',
    //     url: `${window.SITE_GLOBALS.root}/wp-admin/admin-ajax.php`,
    //     data: {
    //       action: 'upload_veteran_paperwork',
    //       paperwork: img.src,
    //       filename,
    //     },
    //     complete: res => console.log(res),
    //   });
    // };
  };
});

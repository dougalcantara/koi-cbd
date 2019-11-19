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
    paperwork: $t.find('#k-veterans-paperwork').val(),
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

  const file = $t.find('#k-veterans-paperwork')[0].files[0];
  const filename = file.name;
  const fr = new FileReader();
  const img = new Image();

  fr.readAsDataURL(file);
  fr.onload = function({ target }) {
    img.src = target.result;
    img.onload = function() {
      $.ajax({
        method: 'POST',
        url: `${window.SITE_GLOBALS.root}/wp-admin/admin-ajax.php`,
        data: {
          action: 'upload_veteran_paperwork',
          paperwork: img.src,
          filename,
        },
        complete: res => console.log(res),
      });
    };
  };

  // const fd = new FormData();
  // const file = $t.find('#k-veterans-paperwork')[0].files[0];

  // fd.append('file', file, file.name);

  // $.ajax({
  //   method: 'POST',
  //   url: `${window.SITE_GLOBALS.root}/wp-admin/admin-ajax.php`,
  //   cache: false,
  //   processData: false,
  //   contentType: 'multipart/form-data',
  //   data: fd,
  //   complete: res => console.log(res),
  // });

  // $.ajax({
  //   method: 'POST',
  //   url: `${BASE_URL}/${formId}`,
  //   contentType: 'application/json',
  //   data: JSON.stringify(hsPayload),
  //   complete: res => console.log('HS res: ', res),
  // });

  // const fd = new FormData();
  // const file = $t.find('#k-veterans-paperwork')[0].files[0];

  // fd.append('file', file, file.name);

  // $.ajax({
  //   method: 'POST',
  //   cache: false,
  //   processData: false,
  //   contentType: 'multipart/form-data',
  //   url:
  //
  //     files: fd.get('file'),
  //   },
  //   complete: res => console.log(res),
  // });

  // const f = new FileReader();

  // f.onload = function(img) {
  //   img.src = fields.paperwork;
  // }

  // $.ajax

  // $.ajax({
  //   dataType: 'json',
  //   url: `${window.SITE_GLOBALS.root}/wp-admin/admin-ajax.php`,
  //   method: 'POST',
  //   data: {
  //     action: 'create_veteran_user',
  //     email: $t.find('#k-veterans-email').val(),
  //     password: $t.find('#k-veterans-password').val(),
  //   },
  //   complete: res => {
  //     console.log('WP res: ', res);

  //     $.ajax({
  //       method: 'POST',
  //       url: `${BASE_URL}/${formId}`,
  //       contentType: 'application/json',
  //       data: JSON.stringify(),
  //       complete: res => console.log('HS res: ', res),
  //     });
  //   },
  // });
});

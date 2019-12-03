import WooCommerceRestApi from "@woocommerce/woocommerce-rest-api";
const api = new WooCommerceRestApi({
  url: 'https://koicbddev.wpengine.com',
  consumerKey: 'ck_75c6d7fda38f3ef107c0bbcc934b76b52fd669fd',
  consumerSecret: 'cs_b13d28870ca40b98a4c00f1576aca548ba90f573',
  version: 'wc/v3',
  queryStringAuth: true
});

(() => {

  const button = {
    update: btn => {
      btn.innerHTML = 'Saved';
      btn.classList.remove('btn-loading');
      btn.classList.add('btn-success');
    },
    success: btn => {
      btn.classList.remove('btn-success');
      btn.innerHTML = 'Update';
    },
    error: btn => {
      btn.innerHTML = 'Error';
      btn.classList.remove('btn-loading');
      btn.classList.add('btn-error');
    },
    unmatch: btn => {
      btn.innerHTML = `Don't Match`;
      btn.classList.remove('btn-loading');
      btn.classList.add('btn-error');
    },
    reset: btn => {
      btn.classList.remove('btn-loading');
      btn.classList.remove('btn-error');
      btn.innerHTML = 'Update';
    }
  };

  function update_account(fields, form) {
    const btn = form.querySelector('.btn-submit');
    btn.innerHTML = 'Saving';
    btn.classList.add('btn-loading');
    api.put(`customers/${form.getAttribute('data-customer')}`, fields)
      .then(() => {
        button.update(btn);
        setTimeout(() => {
          button.success(btn);
        }, 2000);
      })
      .catch(() => {
        button.error(btn);
      });
  }

  function change_password(old, next) {
    const btn = document.querySelector('.btn-submit');
    const url = `${window.SITE_GLOBALS.root}/wp-admin/admin-ajax.php`;
    $.ajax({
      url,
      dataType: 'json',
      method: 'post',
      data: {old,next,action: 'change_password'},
      complete: res => {
        if(res.responseJSON) {
          button.update(btn);
          setTimeout(() => {
            button.success(btn);
            document.querySelector('#current-password').classList.remove('error');
            window.location.href = `${window.SITE_GLOBALS.root}/login`;
          }, 2000);
        } else {
          document.querySelector('#current-password').classList.add('error');
          btn.innerHTML = 'Incorrect';
          btn.classList.add('btn-error');
          setTimeout(() => {
            button.reset(btn);
            document.querySelector('#current-password').classList.remove('error');
          }, 2000);
        }
      },
    });
  }

  if(document.querySelector('#update-account')) {
    document.querySelector('#update-account').addEventListener('submit', e => {
      e.preventDefault();
      update_account({
        first_name: document.querySelector('#firstname').value,
        last_name: document.querySelector('#lastname').value,
        email: document.querySelector('#email').value
      }, document.querySelector('#update-account'));
    });
  }

  if(document.querySelector('#delete-account')) {
    document.querySelector('#delete-account').addEventListener('submit', e => {
      e.preventDefault();
      if(confirm('This will delete your account permanently. Are you sure?')) {
        document.querySelector('#delete-account').submit();
      }
    });
  }

  if(document.querySelector('#update-billing')) {
    document.querySelector('#update-billing').addEventListener('submit', e => {
      e.preventDefault();
      update_account({
        billing: {
          first_name: document.querySelector('#first_name').value,
          last_name: document.querySelector('#last_name').value,
          company: document.querySelector('#company').value,
          address_1: document.querySelector('#address_1').value,
          address_2: document.querySelector('#address_2').value,
          city: document.querySelector('#city').value,
          state: document.querySelector('#state').value,
          postcode: document.querySelector('#postcode').value,
          country: document.querySelector('#country').value,
        }
      }, document.querySelector('#update-billing'));
    });
  }

  if(document.querySelector('#update-shipping')) {
    document.querySelector('#update-shipping').addEventListener('submit', e => {
      e.preventDefault();
      update_account({
        shipping: {
          first_name: document.querySelector('#first_name').value,
          last_name: document.querySelector('#last_name').value,
          company: document.querySelector('#company').value,
          address_1: document.querySelector('#address_1').value,
          address_2: document.querySelector('#address_2').value,
          city: document.querySelector('#city').value,
          state: document.querySelector('#state').value,
          postcode: document.querySelector('#postcode').value,
          country: document.querySelector('#country').value,
        }
      }, document.querySelector('#update-shipping'));
    });
  }

  if(document.querySelector('#update-password')){
    document.querySelector('#update-password').addEventListener('submit', e => {
      e.preventDefault();
      const btn = document.querySelector('.btn-submit');
      const passwords = {
        old: document.querySelector('#current-password').value,
        new: document.querySelector('#new-password').value,
        confirm: document.querySelector('#confirm-password').value
      };
      btn.innerHTML = 'Checking';
      btn.classList.add('btn-loading');
      setTimeout(() => {
        if(passwords.new !== passwords.confirm) {
          button.unmatch(btn);
          document.querySelectorAll('.field-match').forEach(field => field.classList.add('error'));
          setTimeout(() => {
            button.reset(btn);
            document.querySelectorAll('.field-match').forEach(field => field.classList.remove('error'));
          }, 1250);
        } else {
          document.querySelectorAll('.field-match').forEach(field => field.classList.remove('error'));
          change_password(document.querySelector('#current-password').value, document.querySelector('#new-password').value);
        }
      }, 1000);
    });
  }

})();
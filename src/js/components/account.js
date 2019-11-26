import WooCommerceRestApi from "@woocommerce/woocommerce-rest-api";
const api = new WooCommerceRestApi({
  url: 'http://localhost:8888/koicbd',
  consumerKey: 'ck_fe76fcf31fe262cd7c36f78fcb98c1f280313aef',
  consumerSecret: 'cs_a9a9c5a41bef061cf30599dd4390bc31d786494c',
  version: 'wc/v3'
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
    }
  };

  function update_account() {
    const form = document.querySelector('#update-account'),
          btn = form.querySelector('.btn-submit');

    btn.innerHTML = 'Saving';
    btn.classList.add('btn-loading');
    api.put(`customers/${form.getAttribute('data-customer')}`, {
      first_name: form.querySelector('#firstname').value,
      last_name: form.querySelector('#lastname').value,
      email: form.querySelector('#email').value
    })
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

  function update_password() {

  }

  if(document.querySelector('#update-account')) {
    document.querySelector('#update-account').addEventListener('submit', e => {
      e.preventDefault();
      update_account();
    });
  }

  if(document.querySelector('#update-password')) {
    document.querySelector('#update-password').addEventListener('submit', e => {
      e.preventDefault();
      update_password();
    });
  }


})();
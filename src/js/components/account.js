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

})();
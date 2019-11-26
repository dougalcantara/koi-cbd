import WooCommerceRestApi from "@woocommerce/woocommerce-rest-api";
const api = new WooCommerceRestApi({
  url: 'http://localhost:8888/koicbd',
  consumerKey: 'ck_fe76fcf31fe262cd7c36f78fcb98c1f280313aef',
  consumerSecret: 'cs_a9a9c5a41bef061cf30599dd4390bc31d786494c',
  version: 'wc/v3'
});

(() => {
  const accountForm = document.querySelector('#update-account');
  if(accountForm) {
   accountForm.addEventListener('submit', e => {
     e.preventDefault();
     api.put(`customers/${accountForm.getAttribute('data-customer')}`, {
       first_name: "James"
     })
       .then(response => {
         console.log(response);
       })
       .catch(error => {
         console.log(error);
       });
   })
  }
})();
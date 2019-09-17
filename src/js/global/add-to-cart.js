const $addToCartButtons = $('.k-add-to-cart');

$addToCartButtons.click(function(e) {
  e.preventDefault();

  const $t = $(this);
  const productId = $t.attr('rel');

  const data = {
    action: 'nopriv_add_product',
    product_id: productId,
  };

  $.post(`${window.SITE_GLOBALS.root}/wp-admin/admin-ajax.php`, data, res => {
    console.log(res);
  })

  // $.ajax({
  //   type: 'POST',
  //   url: `${window.SITE_GLOBALS.root}/wp-admin/admin-ajax.php`,
  //   data,
  //   complete: function(res) {
  //     console.log('complete', res);
  //   },
  //   error: function(err) {
  //     console.log('error', err);
  //   },
  // });

  // $.post('/wp-admin/admin-ajax.php', data, function(response) {
  //   if (response != 0) {
  //     console.log(response);
  //   } else {
  //       // do something else
  //   }
  // });
})

const productHero = document.querySelector('.single-product');

export default $ => {
  if (!productHero) return;

  const module = {
    $nodes: {
      image: $('.woocommerce-product-gallery__wrapper'),
      bundleDropdownTriggers: $('.bundled_products .bundled_product_checkbox'),
    },

    hooks: {
      mounted: $nodes => {
        const { methods } = module;
        methods.addListeners($nodes);
      },
    },

    methods: {
      addListeners: $nodes => {
        const { image, bundleDropdownTriggers } = $nodes;

        // prevent opening image file
        image.click(function() {
          event.preventDefault();
        });

        // flip dropdown arrow upside-down
        bundleDropdownTriggers.click(function() {
          const $label = $(this).closest('.bundled_product_optional_checkbox');
          $label.toggleClass('bundled_product_optional_checkbox--active');
        });
      },
    },
  };

  module.hooks.mounted(module.$nodes);
};

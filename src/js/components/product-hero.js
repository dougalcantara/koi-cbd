import { toggleCartSidebar } from '../global/cart-actions';
const productHero = document.querySelector('.single-product');

export default $ => {
  if (!productHero) return;
  const module = {
    $nodes: {
      form: $('form.cart'),
      imageContainer: $('.woocommerce-product-gallery__wrapper'),
      featuredImage: $(
        '.woocommerce-product-gallery__wrapper div[data-thumb]:first-of-type'
      ),
      imageLinks: $('.woocommerce-product-gallery__wrapper a'),
      bundleDropdownTriggers: $('.bundled_products .bundled_product_checkbox'),
      variantSelects: $('.k-productform__select-container select'),
      primaryPriceField: $('.summary .woocommerce-Price-amount'),
      variantStores: $('[data-product_variations]'),
      minMaxStore: $('.min_max_items'),
    },

    data: {
      bundledProduct: false,
      productVariants: [],
      bundleSettings: {},
      lowestPrice: 0,
      regularPrice: 0,
    },

    hooks: {
      mounted: () => {
        const { methods, data, $nodes } = module;

        if (window.__openCart === true) {
          /**
           * Fires when the PDP is reloaded after being added to the cart.
           */
          $nodes.bundleDropdownTriggers.each(function() {
            const $this = $(this);
            if ($this.is(':checked')) {
              $this.prop('checked', !$this.prop('checked'));
            }
          });

          toggleCartSidebar(false, true);
        }

        if (document.querySelector('.bundled_products')) {
          data.bundledProduct = true;
          methods.setBundleSettings();
          methods.setProductVariants();
          methods.displayInitialPrice();
        }

        methods.setBlankAttr();
        methods.addListeners();
      },
    },

    methods: {
      addListeners: () => {
        const { methods } = module;
        const { bundleDropdownTriggers, variantSelects } = module.$nodes;

        // flip dropdown arrow upside-down
        bundleDropdownTriggers.click(function() {
          const $label = $(this).closest('.bundled_product_optional_checkbox');
          $label.toggleClass('bundled_product_optional_checkbox--active');
        });

        // change ::after color/padding when a value is selected
        variantSelects.change(function(index, el) {
          methods.checkValue($(this));
        });
      },

      checkValue: $el => {
        if ($el.val()) {
          $el.parent().addClass('selected');
        } else {
          $el.parent().removeClass('selected');
        }
      },

      displayInitialPrice: () => {
        const { $nodes, data } = module;
        const { primaryPriceField } = $nodes;

        const cheapestAvailableVariants = [];

        data.productVariants.forEach(product => {
          cheapestAvailableVariants.push(product[0]);
        });

        cheapestAvailableVariants.forEach(variant => {
          data.lowestPrice += variant.price;
          data.regularPrice += parseFloat(variant.regular_price);
        });

        [data.lowestPrice, data.regularPrice] = [
          data.lowestPrice.toFixed(2),
          data.regularPrice.toFixed(2),
        ];

        primaryPriceField.html(/*html*/ `
          <span class="k-price-preheading"">from</span>
          ${data.currency}${data.lowestPrice}
          <span class="k-strikethrough">${data.currency}${data.regularPrice}</span>
        `);
      },

      setBlankAttr: () => {
        const { $nodes } = module;
        $nodes.imageLinks.attr('target', '_blank');
        $nodes.imageLinks.attr('rel', 'noopener noreferrer');
      },

      setBundleSettings: () => {
        const { $nodes, data } = module;
        data.bundleSettings.min = $nodes.minMaxStore.data('min');
        data.bundleSettings.max = $nodes.minMaxStore.data('max');
      },

      setProductVariants: () => {
        const { data } = module;
        const { primaryPriceField, variantStores } = module.$nodes;

        // set the currency symbol
        data.currency = primaryPriceField
          .find('.woocommerce-Price-currencySymbol')
          .text();

        /**
         * Gets the data dumped out by product-bundles
         * and sets it in module.data.productVariants
         */
        variantStores.each(function(index, el) {
          if (index < data.bundleSettings.max) {
            data.productVariants.push(
              JSON.parse(el.dataset.product_variations)
            );
          }
        });
      },
    },
  };
  module.hooks.mounted(module.$nodes);
};

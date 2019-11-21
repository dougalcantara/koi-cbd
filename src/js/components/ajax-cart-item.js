import AjaxCart from '../global/ajax-cart';

export default class CartItem {
  constructor($this, element, key) {
    this.$item = $this;
    this.element = element;
    this.key = key;
    this.$input = $this.find('input');
    this.$updateButton = $this.find('.k-cart-sidebar__item-update');
    this.$increase = $this.find('.k-increase');
    this.$decrease = $this.find('.k-reduce');
    this.$price = $this.find('.k-cart-sidebar__item-price');
    this.originalValue = parseInt(this.$input.val());
    this.appendListeners();
  }

  appendListeners() {
    this.$input.change(() => {
      this.needsUpdate();
    });

    this.$increase.click(() => {
      this.increaseInput();
    });

    this.$decrease.click(() => {
      this.decreaseInput();
    });

    this.$updateButton.click(() => {
      this.updateGlobalQuantities();
    });
  }

  increaseInput() {
    let oldValue = parseInt(this.$input.val());
    this.$input.val((oldValue += 1));
    this.needsUpdate();
  }

  decreaseInput() {
    let oldValue = parseInt(this.$input.val());
    this.$input.val((oldValue -= 1));
    this.needsUpdate();
  }

  needsUpdate() {
    const newValue = parseInt(this.$input.val());

    if (newValue < 0) {
      this.$input.val(0);
    }

    if (newValue !== this.originalValue) {
      this.$updateButton.addClass('k-cart-sidebar__item-update--active');
      this.$price.addClass('fade');
    } else {
      this.$updateButton.removeClass('k-cart-sidebar__item-update--active');
      this.$price.removeClass('fade');
    }
  }

  removeItem() {
    /*
      setting quantity to 0 (or less than 0, if a user attempts to do so)
      removes the item from the cart.
    */
  }

  updateQuantity(newQuantity) {
    AjaxCart.updateItemQuantity(this.key, newQuantity);
  }

  updateGlobalQuantities() {
    const values = [];
    const keys = [];

    window.__cartItems.forEach(item => {
      const newValue = parseInt(item.$input.val());
      const key = item.key;
      values.push(newValue);
      keys.push(key);
    });
    AjaxCart.updateAllItemQuantities(keys, values);
  }
}

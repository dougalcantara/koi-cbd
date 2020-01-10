import $ from 'jquery';
const $accordion = $('.k-faq--accordion');
const $items = $accordion.find('.k-faq--item');
const $drawerTriggers = $accordion.find('.k-faq--item__heading');

$drawerTriggers.click(function() {
  const $t = $(this);
  const $parent = $t.closest('.k-faq--item');
  const $targetDrawer = $t.next();
  const targetHeight = $targetDrawer
    .find('.k-faq--item__heighttarget')
    .outerHeight();
  const isOpen = $parent.hasClass('is-open');

  if (isOpen) {
    $targetDrawer.height(0);
    $parent.removeClass('is-open');
  } else {
    $targetDrawer.height(targetHeight);
    $parent.addClass('is-open');
  }
});

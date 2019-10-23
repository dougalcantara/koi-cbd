import { $header, $getsHeaderMargin, $backdrop } from '../global/selectors';
import debounce from '../helpers/debounce';

const headerHeight = () => $header.outerHeight();
const $nav = $header.find('.k-header--nav');
const $navTrigger = $('#k-nav-trigger');
const $dropdownTriggers = $('.k-has-dropdown a');

let didScroll = false;

function toggleNavDrawer() {
  const isActive = $header.hasClass('is-open');

  if (isActive) {
    $header.removeClass('is-open');
  } else {
    $header.addClass('is-open');
  }
}

function doHeaderOffsets() {
  if (window.innerWidth < 767) {
    $nav.css({ top: headerHeight() });
  } else {
    $nav.removeAttr('style');
  }

  // $getsHeaderMargin.css({ 'margin-top': headerHeight() });
}

(function handleScroll() {
  if (didScroll) {
    if (window.pageYOffset) {
      $header.addClass('k-header--traveling');
    } else {
      $header.removeClass('k-header--traveling');
    }
    didScroll = false;
  }

  requestAnimationFrame(handleScroll);
})();

let interval;

$dropdownTriggers.click(function() {
  const $t = $(this);
  const $dropdown = $t.next();
  const $content = $dropdown.find('.k-dropdown--liner');

  const isOpen = $dropdown.hasClass('k-dropdown--open');

  if (isOpen) {
    $dropdown.height(0);
    $dropdown.removeClass('k-dropdown--open');
    $backdrop.removeClass('active');
  } else {
    $dropdown.height($content.outerHeight());
    $dropdown.addClass('k-dropdown--open');
    $backdrop.addClass('active');
  }
});

$navTrigger.click(toggleNavDrawer);
window.addEventListener('resize', () => debounce(doHeaderOffsets, interval));
window.addEventListener('scroll', () => (didScroll = true));
document.addEventListener('DOMContentLoaded', doHeaderOffsets);

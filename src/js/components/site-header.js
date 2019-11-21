import {
  $header,
  $getsHeaderMargin,
  $backdrop,
  $searchModal,
  $win,
} from '../global/selectors';
import debounce from '../helpers/debounce';
import wasEnter from '../helpers/wasEnter';

const headerHeight = () => $header.outerHeight();
const headerOffset = () => $header.find('.k-header--top').outerHeight();
// const $headerMain = $header.find('.k-header--main');
const $nav = $header.find('.k-header--nav');
const $navTrigger = $('#k-nav-trigger');
const $dropdownTriggers = $('.k-has-dropdown a');
const $accessibleSkip = $('.k-header__skip-to-main');
const $main = $('main');

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

  $header.css({ top: -headerOffset() });

  // $getsHeaderMargin.css({ 'margin-top': headerHeight() });
}

(function handleScroll() {
  if (didScroll) {
    if (window.pageYOffset > headerOffset()) {
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
  const $clickedDropdown = $t.next();
  const $content = $clickedDropdown.find('.k-dropdown--liner');
  const isOpen = $clickedDropdown.hasClass('k-dropdown--open');

  closeAllDropdowns();

  $clickedDropdown.addClass('k-dropdown--open');

  if (isOpen) {
    $clickedDropdown.height(0);
    $clickedDropdown.removeClass('k-dropdown--open');

    if (!$searchModal.hasClass('k-modal--open')) {
      $backdrop.removeClass('active');
    }
  } else {
    $clickedDropdown.height($content.outerHeight());
    $clickedDropdown.addClass('k-dropdown--open');
    $backdrop.addClass('active');
  }
});

export function closeAllDropdowns() {
  $dropdownTriggers.each(function() {
    const $t = $(this);
    $t.next().height(0);
    $t.next().removeClass('k-dropdown--open');
  });
}

$navTrigger.click(toggleNavDrawer);
window.addEventListener('resize', () => debounce(doHeaderOffsets, interval));
window.addEventListener('scroll', () => (didScroll = true));
document.addEventListener('DOMContentLoaded', doHeaderOffsets);

$accessibleSkip.focusin(function() {
  $(this).addClass('k-header__skip-to-main--focused');
});

$accessibleSkip.blur(function() {
  $(this).removeClass('k-header__skip-to-main--focused');
});

$accessibleSkip.click(() => {
  $main.focus();
});

$accessibleSkip.keypress(function(e) {
  if (wasEnter(e)) {
    $main.focus();
  }
});

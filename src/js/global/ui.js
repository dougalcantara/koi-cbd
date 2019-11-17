import {
  $doc,
  $win,
  $header,
  $cartSidebar,
  $searchModal,
  $backdrop,
} from './selectors';

import { closeAllDropdowns } from '../components/site-header';
import { closeSidebar } from './cart-actions';

export const breakpoints = {
  sm: 580,
  md: 767,
  lg: 992,
  xl: 1199,
};

const $tiltTargets = $('.k-tilt');
const $blogFilterBy = $('.k-blognav--filterby select');

function slugify(string) {
  return string.replace(/ /g, '-').toLowerCase();
}

function initializeTilt() {
  if ($win.width() < breakpoints.md || !$tiltTargets.length) return;

  const tiltProps = {
    maxTilt: 5,
    speed: 1200,
    easing: 'cubic-bezier(0.075,  0.820, 0.165, 1.000)',
  };

  $tiltTargets.tilt(tiltProps);
}

function goToCategoryListing() {
  const $t = $(this);
  const selectedCategory = $t.val();
  const slugified = slugify(selectedCategory);

  window.location.href = `${window.SITE_GLOBALS.root}/blog?category=${slugified}`;
}

function setInitialBlogCategory() {
  const selectedCategory = new URLSearchParams(window.location.search).get(
    'category'
  );
  const $optionEls = $blogFilterBy.find('option');
  const slugifiedOptions = [...$optionEls].map(({ value }) => slugify(value));

  slugifiedOptions.forEach((option, idx) => {
    if (option == selectedCategory) {
      $($optionEls[idx]).attr('selected', true);
    }
  });
}

$blogFilterBy.change(goToCategoryListing);

$doc.ready(() => {
  initializeTilt();
  setInitialBlogCategory();
});

$backdrop.click(function() {
  if ($backdrop.hasClass('active')) {
    const headerDropdowns = $header.find('.k-dropdown');

    headerDropdowns.removeClass('k-dropdown--open');
    headerDropdowns.removeAttr('style');

    $cartSidebar.removeClass('k-cart-sidebar--open');

    $searchModal.removeClass('k-modal--open');

    closeAllDropdowns();
    closeSidebar();
  }

  $backdrop.removeClass('active');
});

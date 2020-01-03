import preventScrollOnDrag from '../helpers/FlickityEvents';
import { breakpoints } from '../global/ui';
import { debounce } from '../components/newsletter-signup';

const $promoSlider = $('.k-promoslider');
const $carousel = $promoSlider.find('.k-promoslider--carousel');
const $prev = $promoSlider.find('.k-promoslider__prev');
const $next = $promoSlider.find('.k-promoslider__next');

const flktyOpts = {
  // groupCells set programatically
  contain: true,
  cellSelector: '.k-productcard',
  pageDots: false,
  prevNextButtons: false,
  dragThreshold: 10,
  imagesLoaded: true,
  accessibility: false,
};

document.addEventListener('DOMContentLoaded', () => {
  const cellCount = getGroupCells();
  createPromoSlider(cellCount);

  if ($carousel.length) {
    window.addEventListener('resize', debounce(watchFlickity, 10));
  }
});

function createPromoSlider(groupCellCount) {
  if (!$carousel.length) {
    return;
  } else if (window.__promoFlkty) {
    window.__promoFlkty.destroy();
    $prev.off('click');
    $next.off('click');
  }

  flktyOpts.groupCells = groupCellCount;
  window.__promoFlkty = new Flickity($carousel[0], flktyOpts);
  preventScrollOnDrag(window.__promoFlkty);

  $prev.click(() => window.__promoFlkty.previous());
  $next.click(() => window.__promoFlkty.next());
}

function watchFlickity() {
  const currentCells = window.__promoFlkty.options.groupCells;
  const newCellCount = getGroupCells();

  if (currentCells !== newCellCount) {
    createPromoSlider(newCellCount);
  }
}

function getGroupCells() {
  const { innerWidth: width } = window;

  switch (true) {
    case width < breakpoints.sm: {
      return 1;
    }
    case width >= breakpoints.sm && width < breakpoints.md: {
      return 1;
    }
    case width >= breakpoints.md && width < breakpoints.lg: {
      return 1 / 0.5;
    }
    case width >= breakpoints.lg && width < breakpoints.xl: {
      return 1 / 0.333;
    }
    case width >= breakpoints.xl: {
      return 1 / 0.25;
    }
    default: {
      console.warn('Default groupCell case.');
      return 1;
    }
  }
}

import preventScrollOnDrag from '../helpers/FlickityEvents';

const $promoSlider = $('.k-promoslider');
const $carousel = $promoSlider.find('.k-promoslider--carousel');
const $prev = $promoSlider.find('.k-promoslider__prev');
const $next = $promoSlider.find('.k-promoslider__next');

let flkty;

const flktyOpts = {
  groupCells: 1,
  cellSelector: '.k-productcard',
  // cellAlign: 'bottom',
  pageDots: false,
  prevNextButtons: false,
  contain: true,
  dragThreshold: 10,
  imagesLoaded: true,
  accessibility: false,
};

document.addEventListener('DOMContentLoaded', () => {
  if (!$carousel.length) return;
  flkty = new Flickity($carousel[0], flktyOpts);

  preventScrollOnDrag(flkty);

  $prev.click(() => flkty.previous());
  $next.click(() => flkty.next());
});

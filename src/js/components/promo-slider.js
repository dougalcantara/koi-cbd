import debounce from '../helpers/debounce';

const promoSlider = document.querySelector('.k-promoslider--carousel');

let flkty;

const flktyOpts = {
  groupCells: 1,
  cellSelector: '.k-productcard',
  cellAlign: 'left',
  pageDots: false,
  prevNextButtons: false,
  contain: true,
  dragThreshold: 10,
};

document.addEventListener('DOMContentLoaded', () => {
  if (!promoSlider) return;
  flkty = new Flickity(promoSlider, flktyOpts);
});

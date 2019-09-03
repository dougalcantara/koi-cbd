import debounce from '../helpers/debounce';

const promoSlider = document.querySelector('.k-promoslider--carousel');

let flkty;

const flktyOpts = {
  // groupCells: 1,
  cellSelector: '.k-productcard',
  cellAlign: 'left',
  pageDots: false,
  prevNextButtons: false,
  contain: true,
  dragThreshold: 10,
  freeScroll: true,
};

window.addEventListener('resize', () => debounce(() => {
  // if (window.innerWidth < 767) {
  //   flktyOpts.groupCells = 1;
  // } else if (window.innerWidth < 992) {
  //   flktyOpts.groupCells = 2;
  // } else if (window.innerWidth < 1199) {
  //   flktyOpts.groupCells = 3;
  // } else {
  //   flktyOpts.groupCells = 4;
  // }

  // flkty = new Flickity(promoSlider, flktyOpts);
}));

document.addEventListener('DOMContentLoaded', () => {
  // if (window.innerWidth < 767) {
  //   flktyOpts.groupCells = 1;
  // } else if (window.innerWidth < 992) {
  //   flktyOpts.groupCells = 2;
  // } else if (window.innerWidth < 1199) {
  //   flktyOpts.groupCells = 3;
  // } else {
  //   flktyOpts.groupCells = 4;
  // }

  flkty = new Flickity(promoSlider, flktyOpts);

  console.log(flktyOpts);
});

const carousel = document.querySelector('.k-testimonialslider .k-testimonialslider--carousel');

let flkty;

const flktyOpts = {
  // groupCells: 1,
  cellSelector: '.k-testimonialslider--slide',
  cellAlign: 'center',
  pageDots: true,
  prevNextButtons: false,
  dragThreshold: 10,
};

function initializeSlider() {
  flkty = new Flickity(carousel, flktyOpts);
}

document.addEventListener('DOMContentLoaded', initializeSlider);
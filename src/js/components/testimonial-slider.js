import preventScrollOnDrag from '../helpers/FlickityEvents';

const carousel = document.querySelector(
  '.k-testimonialslider .k-testimonialslider--carousel'
);

let flkty;

const flktyOpts = {
  // groupCells: 1,
  cellSelector: '.k-testimonialslider--slide',
  cellAlign: 'center',
  pageDots: true,
  prevNextButtons: false,
  dragThreshold: 10,
  imagesLoaded: true,
  autoPlay: true,
};

function initializeSlider() {
  if (!carousel) return;
  flkty = new Flickity(carousel, flktyOpts);

  preventScrollOnDrag(flkty);
}

document.addEventListener('DOMContentLoaded', initializeSlider);

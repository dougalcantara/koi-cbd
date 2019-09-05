import { addEventListeners, removeClass } from '../helpers/dom';

const videoGallery = document.querySelector('.k-videogallery');
const videoSelectTriggers = videoGallery.querySelectorAll('.k-videogallery--actions__item');

addEventListeners(videoSelectTriggers, 'click', ({target}) => {
  removeClass(videoSelectTriggers, 'active');

  target.classList.add('active');
});

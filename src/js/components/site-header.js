import { header, $getsHeaderMargin } from '../global/selectors';
import debounce from '../helpers/debounce';

const headerHeight = () => header.clientHeight;
const nav = header.querySelector('.k-header--nav');
const navTrigger = document.querySelector('#k-nav-trigger');

let didScroll = false;

function toggleNavDrawer() {
  const isActive = header.classList.contains('is-open');

  if (isActive) {
    header.classList.remove('is-open');
  } else {
    header.classList.add('is-open');
  }
}

function doHeaderOffsets() {
  if (window.innerWidth < 767) {
    nav.style.top = `${headerHeight()}px`;
  } else {
    nav.removeAttribute('style');
  }

  $getsHeaderMargin.css({ 'margin-top': `${header.clientHeight}px` });
}

(function handleScroll() {
  if (didScroll) {
    if (window.pageYOffset) {
      header.classList.add('k-header--traveling');
    } else {
      header.classList.remove('k-header--traveling');
    }
    didScroll = false;
  }

  requestAnimationFrame(handleScroll);
})();

let interval;

navTrigger.addEventListener('click', toggleNavDrawer);
window.addEventListener('resize', () => debounce(doHeaderOffsets, interval));
window.addEventListener('scroll', () => didScroll = true);
document.addEventListener('DOMContentLoaded', doHeaderOffsets);

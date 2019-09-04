import { header, getsHeaderMargin } from '../global/selectors';
import debounce from '../helpers/debounce';

const headerHeight = () => header.clientHeight;
const nav = header.querySelector('.k-header--nav');
const navTrigger = document.querySelector('#k-nav-trigger');

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

  getsHeaderMargin.style.marginTop = `${header.clientHeight}px`;
}

let interval;

navTrigger.addEventListener('click', toggleNavDrawer);
window.addEventListener('resize', () => debounce(doHeaderOffsets, interval));
document.addEventListener('DOMContentLoaded', doHeaderOffsets);

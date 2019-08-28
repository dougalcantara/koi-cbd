const header = document.querySelector('header.k-header');
const headerHeight = header.querySelector('.k-header--main').clientHeight;
const nav = header.querySelector('.k-header--nav');
const navTrigger = document.querySelector('#k-nav-trigger');

navTrigger.addEventListener('click', () => {
  const isActive = header.classList.contains('is-open');

  if (isActive) {
    header.classList.remove('is-open');
  } else {
    header.classList.add('is-open');
  }
});

document.addEventListener('DOMContentLoaded', () => {
  nav.style.top = `${headerHeight}px`;
});

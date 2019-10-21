import { $doc } from './selectors';

const targets = document.querySelectorAll('img[data-src]');

function startWatcher(handler) {
  const opts = {
    threshold: 0.125,
  };

  const observer = new IntersectionObserver(handler, opts);

  targets.forEach(el => observer.observe(el));
}

function checkInView(entries) {
  entries.forEach(entry => {
    if (entry.intersectionRatio > 0) {
      lazyload(entry.target);
    }
  });
}

function lazyload(imageElement) {
  const img = new Image();
  const src = imageElement.getAttribute('data-src');

  imageElement.classList.add('lazyload--progress');

  img.src = src;
  img.onload = () => {
    imageElement.setAttribute('src', src);
    imageElement.classList.add('lazyload--complete');

    if (typeof onComplete === 'function') onComplete();
  };
}

$doc.ready(startWatcher(checkInView));

import { $doc } from './selectors';

const targets = document.querySelectorAll('*[data-src]');

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
  const src = imageElement.getAttribute('data-src');

  /**
   * the data-src gets removed once lazyload is complete, so we can check
   * against this attribute to keep from doubling-up
   */

  if (!src) return;

  if (
    imageElement.tagName === 'DIV' &&
    imageElement.classList.contains('k-overview--bgimg')
  ) {
    /**
     * There's a particularly nasty SVG on the homepage that is being used as a BG texture.
     * It's so nasty, that it makes the initial document request > 1MB *on it's own*.
     *
     * While loading it this way won't necessarily make the download any smaller, we won't
     * get penalized for total # of DOM Nodes, which was the case before this hack.
     */
    const $el = $(imageElement);
    $el.load(src);
  } else {
    const img = new Image();

    imageElement.classList.add('lazyload--progress');

    img.src = src;
    img.onload = () => {
      if (imageElement.tagName === 'DIV') {
        imageElement.setAttribute('style', `background-image: url(${src})`);
      } else {
        imageElement.setAttribute('src', src);
      }

      // Lazy load hero images and alert the parent onComplete
      const parent = imageElement.parentElement;
      if (parent.classList.contains('k-hero')) {
        parent.classList.add('k-hero--loaded');
      }

      imageElement.classList.add('lazyload--complete');

      if (typeof onComplete === 'function') onComplete();
    };
  }

  imageElement.removeAttribute('data-src');
}

$doc.ready(startWatcher(checkInView));

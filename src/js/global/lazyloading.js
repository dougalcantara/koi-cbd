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

function lazyload(element) {
  const src = element.getAttribute('data-src');
  const isAlreadyLoaded =
    element.classList.contains('lazyload--progress') ||
    element.classList.contains('lazyload--complete');

  /**
   * the data-src gets removed once lazyload is complete, so we can check
   * against this attribute to keep from doubling-up
   */

  if (isAlreadyLoaded) return;

  const isBigNastySVG =
    element.tagName === 'DIV' &&
    element.classList.contains('k-overview--bgimg');

  if (isBigNastySVG) {
    /**
     * There's a particularly nasty SVG on the homepage that is being used as a BG texture.
     * It's so nasty, that it makes the initial document request > 1MB *on it's own*.
     *
     * While loading it this way won't necessarily make the download any smaller, we won't
     * get penalized for total # of DOM Nodes, which was the case before this hack.
     */
    const $el = $(element);
    $el.load(src);
    $el.addClass('lazyload--progress lazyload--complete');
  } else {
    const img = new Image();

    element.classList.add('lazyload--progress');

    img.src = src;
    img.onload = () => {
      const isBgImg = element.tagName === 'DIV';
      if (isBgImg) {
        element.setAttribute('style', `background-image: url(${src})`);
      } else {
        element.setAttribute('src', src);
      }

      // Lazy load hero images and alert the parent onComplete
      const parent = element.parentElement;
      if (parent.classList.contains('k-hero')) {
        parent.classList.add('k-hero--loaded');
      }

      element.classList.add('lazyload--complete');

      if (typeof onComplete === 'function') onComplete();
    };
  }
}

$doc.ready(startWatcher(checkInView));

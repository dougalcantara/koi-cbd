import { $doc } from './selectors';

/**
 * This is really only necessary since the background image for the
 * banner currently has whitespace at the top (mountain w/ hiker.)
 * If this background image to something w/o whitespace at the top,
 * this partial can probably be removed from the bundle.
 */

$doc.ready(() => {
  const $takeover = $('.k-ctabanner--takeover');
  const $last = getLastSection($takeover);

  if ($last) {
    $last.addClass('k-no-padding--bottom');
  }
});

function getLastSection($el) {
  const $siblingSections = $el.siblings('section');
  let lastSection;

  if ($siblingSections.length === 1) {
    lastSection = $siblingSections[$siblingSections.length - 1];
  } else {
    lastSection = $('main').children('section:last-of-type');
  }

  lastSection = lastSection.last();
  return lastSection;
}

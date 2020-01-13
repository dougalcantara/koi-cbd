import $ from 'jquery';
import { $doc, $header } from '../global/selectors';
import getQueryVar from '../helpers/getQueryVar';
import preventScrollOnDrag from '../helpers/FlickityEvents';

const $parent = $('.k-process');
const $slideSelectors = $parent.find('.k-process__iconrow__item');
const $carousel = $parent.find('.k-process__carousel');
const $slides = $parent.find('.k-process__carousel__slide');
const $prev = $parent.find('.k-process__prev');
const $next = $parent.find('.k-process__next');
const $currentSlide = $parent.find('.k-process__current');

let flkty;

$prev.click(() => flkty.previous());
$next.click(() => flkty.next());

$slideSelectors.click(function() {
  const $t = $(this);

  $slideSelectors.removeClass('active');

  $t.addClass('active');

  flkty.select($slideSelectors.index($t));
});

/**
 * This page can be traveled to from the homepage "Process Preview" module.
 *
 * Clicking on one of those items will set a query param that will tell us
 * to automatically scroll the user to this module, with the appropriate
 * item selected in the carousel.
 */
function handlePageLand() {
  const scrollToSelected = getQueryVar('scrollToSelected');

  if (scrollToSelected) {
    window.scrollTo({
      top: $parent.offset().top + $header.outerHeight(),
    });

    const index = parseInt(scrollToSelected);

    $($slideSelectors[index]).addClass('active');
    flkty.select(index);
  } else {
    $slideSelectors.first().addClass('active');
  }
}

$doc.ready(function() {
  if (!$carousel.length) return;

  flkty = new Flickity($carousel[0], {
    cellSelector: '.k-process__carousel__slide',
    pageDots: false,
    prevNextButtons: false,
    dragThreshold: 10,
    on: {
      change: () => {
        const idx = flkty.selectedIndex;

        $currentSlide.text(`0${idx + 1}/0${$slides.length}`);
        $slideSelectors.removeClass('active');
        $($slideSelectors[idx]).addClass('active');
      },
    },
  });

  preventScrollOnDrag(flkty);

  handlePageLand();
});

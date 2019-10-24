import { $doc } from '../global/selectors';

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

  flkty.select($slideSelectors.index($t));
});

$doc.ready(function() {
  if (!$carousel.length) return;

  flkty = new Flickity($carousel[0], {
    cellSelector: '.k-process__carousel__slide',
    pageDots: false,
    prevNextButtons: false,
    dragThreshold: 10,
    on: {
      change: () => {
        $currentSlide.text(`0${flkty.selectedIndex + 1}/0${$slides.length}`);
      },
    },
  });
});

import $ from 'jquery';
import { $body } from '../global/selectors';

export function scrollToTarget($target, top = false) {
  if (!$target) {
    console.warn('Invalid scroll target provided.');
    console.warn($target);
    return;
  }

  let scrollTo = 0;

  if (top === false) {
    scrollTo = $target.offset().top;
  } else {
    scrollTo = 0;
  }

  $('html, body').animate(
    {
      scrollTop: scrollTo,
    },
    50
  );
}

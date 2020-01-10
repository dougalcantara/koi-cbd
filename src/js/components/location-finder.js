import $ from 'jquery';
import { $doc, $body, $header } from '../global/selectors';

$doc.ready(() => {
  if ($body.hasClass('page-template-location-finder')) {
    const mapSection = document.querySelector(
      '.Layout__MapSection-sc-1fs3kl3-2'
    );

    const headerMain = document.querySelector('.k-header--main');
    const styles = window.getComputedStyle($header[0]);

    let state = {
      height: $header.outerHeight(),
      top: parseFloat(
        styles
          .getPropertyValue('top')
          .split('px')
          .join('')
      ),
      value: 0,
      lerpCoef: 0.2,
      difference: 0,
    };

    const waitForReact = setInterval(() => {
      if (mapSection) {
        setTop();
        clearInterval(waitForReact);
      }
    }, 100);

    function setTop() {
      if ($header.hasClass('k-header--traveling')) {
        state.height = headerMain.offsetHeight;
      } else {
        state.height = $header.outerHeight();
      }

      state.value += (state.height - state.value) * state.lerpCoef;

      mapSection.style.transform = `translate3d(0, ${state.value}px, 0)`;
      requestAnimationFrame(setTop);
    }
  }
});

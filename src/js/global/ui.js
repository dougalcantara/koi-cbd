import { $doc } from './selectors';

function initializeTilt() {
  const $tiltTargets = $('.k-tilt');

  const tiltProps = {
    maxTilt: 5,
    speed: 1200,
    easing: 'cubic-bezier(0.075,  0.820, 0.165, 1.000)',
  };

  $tiltTargets.tilt(tiltProps);
}

$doc.ready(initializeTilt);

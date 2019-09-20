import { $doc, $win } from './selectors';

export const breakpoints = {
  sm: 580,
  md: 767,
  lg: 992,
  xl: 1199,
};

const $tiltTargets = $('.k-tilt');

function initializeTilt() {
  if ($win.width() < breakpoints.md || !$tiltTargets.length) return;

  const tiltProps = {
    maxTilt: 5,
    speed: 1200,
    easing: 'cubic-bezier(0.075,  0.820, 0.165, 1.000)',
  };

  $tiltTargets.tilt(tiltProps);
}

$doc.ready(initializeTilt);

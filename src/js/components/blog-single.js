import { breakpoints } from '../global/ui';
import { $doc, $win } from '../global/selectors';

const offset = $('.k-header').outerHeight();
const $content = $('.k-blogcontent');
const $sidebar = $('.k-blogcontent .k-sidebar--content');
const $sidebarSticky = $sidebar.find('.k-sidebar--newsletter');

function setTravelDist() {
  $sidebar.removeAttr('style');
  $sidebarSticky.removeAttr('style');

  if ($win.width() < breakpoints.md) return;

  $sidebar.height($content.outerHeight());
  $sidebarSticky.css({ top: `calc(${offset}px + 2em)` });
}

$doc.ready(setTravelDist);
$win.resize(setTravelDist);

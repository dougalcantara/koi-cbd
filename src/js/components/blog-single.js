import { $doc, $win } from '../global/selectors';

const offset = $('.k-header').outerHeight();
const $content = $('.k-blogcontent');
const $sidebar = $('.k-blogcontent .k-sidebar');
const $sidebarSticky = $sidebar.find('.k-sidebar--content');

$doc.ready(function() {
  $sidebar.height($content.outerHeight());
  $sidebarSticky.css({ top: `calc(${offset}px + 2em)`});
});

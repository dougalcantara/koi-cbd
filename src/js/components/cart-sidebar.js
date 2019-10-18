import { $doc, $win } from '../global/selectors';

const $sidebar = $('.k-cart-sidebar');
const $liner = $sidebar.children().first();

function setSidebarHeight() {
  $liner.height($win[0].innerHeight);
}

$doc.ready(setSidebarHeight);
$win.resize(setSidebarHeight);

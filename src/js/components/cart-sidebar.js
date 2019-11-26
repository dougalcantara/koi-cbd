import { $doc, $win } from '../global/selectors';

const $sidebar = $('.k-cart-sidebar');

const $title = $sidebar.find('.k-cart-sidebar__title');
const $actions = $sidebar.find('.k-cart-sidebar__actions');
const $content = $sidebar.find('.k-cart-sidebar__content');
const $cartItems = $('#k-ajaxcart-cartitems');
const $liner = $sidebar.children().first();

// some weirdness with padding going on between mobile/desktop
const wiggleRoom = 64;

function setSidebarHeight() {
  const finalHeight = $win[0].innerHeight - $actions.outerHeight() - wiggleRoom;
  $content.height(finalHeight);
  $cartItems.height(finalHeight);
}

$doc.ready(setSidebarHeight);
$win.resize(setSidebarHeight);

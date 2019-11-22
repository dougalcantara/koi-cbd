import {$backdrop, $header, $searchModal} from './selectors';
import { closeAllDropdowns } from '../components/site-header';

const $searchTrigger = $('.k-searchtrigger');
const $searchModalForm = $searchModal.find('form');

$searchTrigger.click(function() {
  const isOpen = $searchModal.hasClass('k-modal--open');

  if (isOpen) {
    closeAllDropdowns();
    $searchModal.removeClass('k-modal--open');
    $backdrop.removeClass('active');
  } else {
    $searchModal.addClass('k-modal--open');
    $backdrop.addClass('active');
    $header.removeClass('is-open');
  }
});

$searchModalForm.submit(function(e) {
  e.preventDefault();

  const searchVal = $(this)
    .find('input[type="text"]')
    .val();

  window.location.href = `${window.SITE_GLOBALS.root}?s=${searchVal}`;
});

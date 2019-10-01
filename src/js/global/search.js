import { $backdrop } from './selectors';

const $searchTrigger = $('.k-searchtrigger');
const $searchModal = $('.k-modal.k-modal--search');
const $searchModalForm = $searchModal.find('form');

$searchTrigger.click(function() {
  const isOpen = $searchModal.hasClass('k-modal--open');

  if (isOpen) {
    $searchModal.removeClass('k-modal--open');
    $backdrop.removeClass('active');
  } else {
    $searchModal.addClass('k-modal--open');
    $backdrop.addClass('active');
  }
});

$searchModalForm.submit(function(e) {
  e.preventDefault();

  const searchVal = $(this).find('input[type="text"]').val();

  window.location.href = `${window.SITE_GLOBALS.root}?s=${searchVal}`;
});

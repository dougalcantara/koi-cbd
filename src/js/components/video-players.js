const $playButtons = $('.k-play-button');
const plyr = new Plyr('.k-player');

$playButtons.click(function() {
  const $t = $(this);
  const $parent = $t.closest('section');

  $parent.addClass('video-playing');

  setTimeout(function() {
    plyr.play();
  }, 250);
});

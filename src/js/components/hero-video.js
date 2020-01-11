(() => {
  if (document.querySelector('.hero-media')) {
    let played = false;
    const video = document.querySelector('.hero-media-video'),
      player = video.querySelector('video'),
      img = document.querySelector('.hero-media-img');

    // Set the name of the hidden property and the change event for visibility
    let hidden, visibilityChange;
    if (typeof document.hidden !== 'undefined') {
      // Opera 12.10 and Firefox 18 and later support
      hidden = 'hidden';
      visibilityChange = 'visibilitychange';
    } else if (typeof document.msHidden !== 'undefined') {
      hidden = 'msHidden';
      visibilityChange = 'msvisibilitychange';
    } else if (typeof document.webkitHidden !== 'undefined') {
      hidden = 'webkitHidden';
      visibilityChange = 'webkitvisibilitychange';
    }

    // If the page is hidden, pause the video;
    // if the page is shown, play the video
    function handleVisibilityChange() {
      if (document[hidden]) {
        player.pause();
      } else if (!played) {
        player.play();
      }
    }

    if (hidden) {
      document.addEventListener(
        visibilityChange,
        handleVisibilityChange,
        false
      );
    }

    // if we get approval to remove looping, uncomment
    player.addEventListener('canplaythrough', () => {
      // if (!played) {
      player.play();
      video.classList.add('active');
      // }
    });

    // player.addEventListener('ended', () => {
    //   played = true;
    //   video.classList.remove('active');
    // });
  }
})();

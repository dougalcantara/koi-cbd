(() => {
  if(document.querySelector('.hero-media')) {
    const video = document.querySelector('.hero-media-video'),
          player = video.querySelector('video'),
          img = document.querySelector('.hero-media-img');

    player.addEventListener('canplaythrough', () => {
      console.log('works');
      player.play();
      video.classList.add('active');
    });
  }
})();
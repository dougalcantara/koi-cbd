document.addEventListener('DOMContentLoaded', () => {
  /*
    This func is delayed to provide time for all asyncronous actions (reviews, DOM manipulation, etc)
    involving markup to occur. There's no way to know for sure when all of these actions are completed since
    They're handled by several different functions across multiple files, so instead we're just waiting a
    couple seconds.
  */
  setTimeout(() => {
    const anchors = document.querySelectorAll('a');
    anchors.forEach(anchor => {
      if (anchor.getAttribute('target') === '_blank') {
        anchor.setAttribute('rel', 'noopener noreferrer');
      }
    });
  }, 2000);
});

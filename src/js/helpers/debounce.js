export default (cb, interval, duration = 250) => {
  clearInterval(interval);

  interval = setInterval(function() {
    clearInterval(interval);
    cb();
  }, 250);
};

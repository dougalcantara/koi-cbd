export default function preventScrollOnDrag(flickityInstance) {
  flickityInstance.on('dragStart', (event, pointer) => {
    document.ontouchmove = e => {
      e.preventDefault();
    };
  });

  flickityInstance.on('dragEnd', (event, pointer) => {
    document.ontouchmove = e => {
      return true;
    };
  });
}

export default function wasEnter(event) {
  /*
    takes a standard or jQuery keydown/keypress event and determines if the key was Enter.
  */
  if (event.originalEvent) {
    return (
      event.originalEvent.key === 'Enter' || event.originalEvent.keyCode === 13
    );
  } else {
    return event.key === 'Enter' || event.keyCode === 13;
  }
}

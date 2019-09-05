export function addEventListeners(nodeList, evt, fn) {
  [].forEach.call(nodeList, item => item.addEventListener(evt, fn, false));

  return nodeList;
}

export function removeClass(from, str) {
  const isNodeList = NodeList.prototype.isPrototypeOf(from);

  if (isNodeList) {
    from.forEach(item => item.classList.remove(str));
  } else {
    from.classList.remove(str);
  }

  return from;
}

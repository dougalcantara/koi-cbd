const triggers = document.querySelectorAll('.k-productdetails--accordion__trigger');

function handleDrawerState(clickedElement) {
  if (!triggers) return;

  const container = clickedElement.parentElement;
  const targetDrawer = clickedElement.nextElementSibling;
  const targetHeight = [...targetDrawer.children].shift().clientHeight;
  const isOpen = container.classList.contains('open');

  if (isOpen) {
    targetDrawer.style.height = `0px`;
    container.classList.remove('open');
  } else {
    targetDrawer.style.height = `${targetHeight}px`;
    container.classList.add('open');
  }
}

triggers.forEach(trigger => trigger.addEventListener('click', () => handleDrawerState(trigger)));

// set the first one to be open by default
document.addEventListener('DOMContentLoaded', () => handleDrawerState(triggers[0]));

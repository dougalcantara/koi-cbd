import { $win } from '../global/selectors';

const $trigger = $('.k-header__newsletter-trigger');
const $signup = $('.k-header__newsletter-signup');
const $submit = $('.k-header__newsletter-submit');
const openClass = 'k-header__newsletter-signup--open';

function debounce(func, wait, immediate) {
  let timeout;
  return function() {
    let context = this,
      args = arguments;
    let later = function() {
      timeout = null;
      if (!immediate) func.apply(context, args);
    };
    let callNow = immediate && !timeout;
    clearTimeout(timeout);
    timeout = setTimeout(later, wait);
    if (callNow) func.apply(context, args);
  };
}

$trigger.click(() => {
  $signup.slideToggle({
    duration: 300,
    complete: () => {
      $signup.toggleClass(openClass);
    },
  });
});

$win.scroll(debounce(checkSignup, 10));

$submit.click(e => {
  submitForm(e);
});

function checkSignup() {
  if ($signup.hasClass(openClass)) {
    $signup.slideUp();
    $signup.removeClass(openClass);
  } else {
    return;
  }
}

function submitForm(e) {
  e.preventDefault();

  let formSubmit = false;
  $submit[0].innerHTML = 'Submitting...';
  $submit.addClass('k-header__newsletter-submit--submitting');

  const formEndpoint =
    'https://api.hsforms.com/submissions/v3/integration/submit/6283239/eae9de54-3f3d-46f7-a523-5e504254f49f';

  const fields = {
    firstName: document.querySelector('#k-newsletter-first'),
    lastName: document.querySelector('#k-newsletter-last'),
    email: document.querySelector('#k-newsletter-email'),
  };

  const payload = {
    fields: [
      {
        name: 'email',
        value: fields.email.value,
      },
      {
        name: 'firstname',
        value: fields.firstName.value,
      },
      {
        name: 'lastname',
        value: fields.lastName.value,
      },
    ],
    submittedAt: Date.now(),
  };

  const xhr = new XMLHttpRequest();
  xhr.open('POST', formEndpoint, true);
  xhr.setRequestHeader('content-type', 'application/json');
  xhr.send(JSON.stringify(payload));
  xhr.onreadystatechange = () => {
    if (xhr.readyState == 4 && xhr.status >= 200 && xhr.status < 300) {
      formSubmit = true;
    }
  };

  const wait = setInterval(() => {
    if (formSubmit === true) {
      $submit.removeClass('k-header__newsletter-submit--submitting');
      $submit.css({ background: 'transparent' });
      $submit[0].innerHTML = 'Complete!';

      setTimeout(() => {
        $signup.slideUp();
      }, 3000);

      clearInterval(wait);
    }
  }, 2500);
}

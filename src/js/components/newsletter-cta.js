import { submitForm } from './newsletter-signup';

const $cta = $('.k-cta--subscribe');

$cta.each(function() {
  const $scopedCta = $(this);

  const $ctaButton = $(this).find('.k-cta__form-trigger');
  const $formContent = $(this).find('.k-cta__form-container');
  const $form = $(this).find('.k-cta__form');

  $ctaButton.click(e => {
    e.preventDefault();
    $ctaButton.addClass('k-cta--fading');

    setTimeout(() => {
      $ctaButton.slideToggle({
        complete: revealForm(),
      });
    }, 750);
  });

  $form.submit(e => {
    const fieldSelectors = {
      firstName: $scopedCta[0].querySelector('.k-cta-first'),
      lastName: $scopedCta[0].querySelector('.k-cta-last'),
      email: $scopedCta[0].querySelector('.k-cta-email'),
      button: $scopedCta[0].querySelector('.k-cta__form button'),
    };
    submitForm(e, fieldSelectors);
  });

  function revealForm() {
    $formContent.slideToggle({
      complete: () => {
        $formContent.addClass('k-cta__form-container--open');
      },
    });
  }
});

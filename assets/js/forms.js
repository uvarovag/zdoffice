$('.if-enabled-required').on('click', (evt) => {

  if (evt.target.checked) {
    if (evt.target.dataset.required)
      $(evt.target.dataset.required).attr('required', '');
    if (evt.target.dataset.dnone)
      $(evt.target.dataset.dnone).removeClass('d-none');
  } else {
    if (evt.target.dataset.required)
      $(evt.target.dataset.required).removeAttr('required');
    if (evt.target.dataset.dnone)
      $(evt.target.dataset.dnone).addClass('d-none');
  }

});

$(document).on('click', (evt) => {

  if (evt.target.nodeName == 'INPUT' && $('.at-least-one-enabled:checked').length > 0) {
    $('.at-least-one-enabled_disabled').removeAttr('disabled');
    $('.at-least-one-enabled_dnone').removeClass('d-block').addClass('d-none');
  } else if (evt.target.nodeName == 'INPUT') {
    $('.at-least-one-enabled_disabled').attr('disabled', '');
    $('.at-least-one-enabled_dnone').removeClass('d-none').addClass('d-block');
  }

});
'use strict';

window.rocketMain = (function() {


  $(function() {
    $('[data-toggle="tooltip"]').tooltip();
  });


  $('#daterangepicker').daterangepicker({
    'opens': 'center',
    'autoUpdateInput': true,
    'maxDate': moment(),
    'locale': {
      'format': 'DD.MM.YYYY',
      'separator': ' - ',
      'applyLabel': 'Применить',
      'cancelLabel': 'Отменить',
      'fromLabel': 'С',
      'toLabel': 'По',
      'customRangeLabel': 'Custom',
      'weekLabel': 'Нед',
      'daysOfWeek': [
        'Вс',
        'Пн',
        'Вт',
        'Ср',
        'Чт',
        'Пт',
        'Сб'
      ],
      'monthNames': [
        'Январь',
        'Февраль',
        'Март',
        'Апрель',
        'Май',
        'Июнь',
        'Июль',
        'Август',
        'Сентябрь',
        'Октябрь',
        'Ноябрь',
        'Декабрь'
      ],
      'firstDay': 1
    }
  }).on('cancel.daterangepicker', function(ev, picker) {
    $(this).val(moment().subtract(1, 'months').format('DD.MM.YYYY') + ' - ' + moment().format('DD.MM.YYYY'));
  });


  return false;

})();


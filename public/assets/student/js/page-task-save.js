$('[name="delivery_date"]').inputmask('99/99/9999 99:99');

$('#delivery_date_input').datetimepicker({
    format: 'DD/MM/YYYY HH:mm',
    locale: 'pt-br',
    icons: {
        time: 'far fa-clock'
    }
});
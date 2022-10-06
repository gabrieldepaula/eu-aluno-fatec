var columns = [
    {
        data: 'code',
        name: 'code',
        title: 'Código',
        searchable: true,
        orderable: true,
        width: '1%',
    },
    {
        data: 'title',
        name: 'title',
        title: 'Tarefa',
        searchable: true,
        orderable: true,
    },
    {
        data: 'subject',
        name: 'subject',
        title: 'Matéria',
        searchable: true,
        orderable: true,
    },
    {
        data: 'delivery_date',
        name: 'delivery_date',
        title: 'Data De Entrega',
        searchable: true,
        orderable: true,
    },
    {
        data: 'status',
        name: 'status',
        title: 'Status',
        searchable: true,
        orderable: true,
    },
    {
        data: 'actions',
        name: 'actions',
        title: 'Ações',
        searchable: false,
        orderable: false,
        width: '100px',
    },
];

var $table = $('#items').DataTable({
    orderCellsTop: true,
    fixedHeader: true,
    oLanguage : datatables_ptbr,
    order: [[0, "desc"]],
    pageLength: 25,
    ajax: {url: window.location.href},
    serverSide: true,
    processing: true,
    columns: columns,
    stateSave: true,
    // initComplete: function () {

    //     var state = $table.state.loaded();
    //     $(this).find('thead').append('<tr role="row" class="filters"></tr>');

    //     this.api().columns().every(function(colIndex) {

    //         var th = $('<th></th>').appendTo($('tr.filters'));

    //         var column = this;
    //         var column_name = column.dataSrc();

    //         if(column_name == 'id') {
    //             $('<input type="text" class="form-control form-control-sm" placeholder="Buscar" value="'+(state ? state.columns[colIndex].search.search : '')+'" />')
    //                     .appendTo(th)
    //                     .on('keyup', function() {
    //                         column.search($(this).val(), false, true).draw();
    //                     });
    //         }

    //         if(column_name == 'language') {
    //             var select = $('<select class="form-control form-control-sm"><option value="">Todos</option></select>');
    //             select.append('<option value="PT" '+(state && state.columns[colIndex].search.search == 'PT' ? 'selected' : '')+'>PT</option>');
    //             select.append('<option value="EN" '+(state && state.columns[colIndex].search.search == 'EN' ? 'selected' : '')+'>EN</option>');
    //             select.appendTo(th).on('change', function() {
    //                 column.search($(this).val()).draw();
    //             });
    //         }

    //         if(column_name == 'artist') {
    //             $('<input type="text" class="form-control form-control-sm" placeholder="Buscar" value="'+(state ? state.columns[colIndex].search.search : '')+'" />')
    //                     .appendTo(th)
    //                     .on('keyup', function() {
    //                         column.search($(this).val(), false, true).draw();
    //                     });
    //         }

    //         if(column_name == 'artist_name') {
    //             $('<input type="text" class="form-control form-control-sm" placeholder="Buscar" value="'+(state ? state.columns[colIndex].search.search : '')+'" />')
    //                     .appendTo(th)
    //                     .on('keyup', function() {
    //                         column.search($(this).val(), false, true).draw();
    //                     });
    //         }

    //         if(column_name == 'gender') {
    //             var select = $('<select class="form-control form-control-sm"><option value="">Todos</option></select>');
    //             $.each(JSON.parse(genderItems), function(i, e) {
    //                 select.append('<option value="'+e.replace('. Qual?', '')+'" '+(state && state.columns[colIndex].search.search == e.replace('. Qual?', '') ? 'selected' : '')+'>'+e.replace('. Qual?', '')+'</option>');
    //             });
    //             select.appendTo(th).on('change', function() {
    //                 column.search($(this).val()).draw();
    //             });
    //         }

    //         if(column_name == 'color') {
    //             var select = $('<select class="form-control form-control-sm"><option value="">Todos</option></select>');
    //             $.each(JSON.parse(colorItems), function(i, e) {
    //                 select.append('<option value="'+e.replace('. Qual?', '')+'" '+(state && state.columns[colIndex].search.search == e.replace('. Qual?', '') ? 'selected' : '')+'>'+e.replace('. Qual?', '')+'</option>');
    //             });
    //             select.appendTo(th).on('change', function() {
    //                 column.search($(this).val()).draw();
    //             });
    //         }

    //         if(column_name == 'is_lgbt') {
    //             var select = $('<select class="form-control form-control-sm"><option value="">Todos</option></select>');
    //             select.append('<option value="Sim" '+(state && state.columns[colIndex].search.search == 'Sim' ? 'selected' : '')+'>Sim</option>');
    //             select.append('<option value="Não" '+(state && state.columns[colIndex].search.search == 'Não' ? 'selected' : '')+'>Não</option>');
    //             select.appendTo(th).on('change', function() {
    //                 column.search($(this).val()).draw();
    //             });
    //         }

    //         if(column_name == 'job_class') {
    //             var select = $('<select class="form-control form-control-sm"><option value="">Todos</option></select>');
    //             $.each(JSON.parse(jobClassItems), function(i, e) {
    //                 select.append('<option value="'+e.replace('. Qual?', '')+'" '+(state && state.columns[colIndex].search.search == e.replace('. Qual?', '') ? 'selected' : '')+'>'+e.replace('. Qual?', '')+'</option>');
    //             });
    //             select.appendTo(th).on('change', function() {
    //                 column.search($(this).val()).draw();
    //             });
    //         }

    //         if(column_name == 'table_type') {
    //             var select = $('<select class="form-control form-control-sm"><option value="">Todos</option></select>');
    //             $.each(JSON.parse(tableTypeItems), function(i, e) {
    //                 select.append('<option value="'+e.short_title+'" '+(state && state.columns[colIndex].search.search == e.short_title ? 'selected' : '')+'>'+e.short_title+'</option>');
    //             });
    //             select.appendTo(th).on('change', function() {
    //                 column.search($(this).val()).draw();
    //             });
    //         }

    //         if(column_name == 'state') {
    //             var select = $('<select class="form-control form-control-sm"><option value="">Todos</option></select>');
    //             $.each(JSON.parse(stateItems), function(i, e) {
    //                 select.append('<option value="'+i+'" '+(state && state.columns[colIndex].search.search == i ? 'selected' : '')+'>'+i+'</option>');
    //             });
    //             select.appendTo(th).on('change', function() {
    //                 column.search($(this).val()).draw();
    //             });
    //         }

    //         if(column_name == 'country') {
    //             var select = $('<select class="form-control form-control-sm"><option value="">Todos</option></select>');
    //             $.each(JSON.parse(countryItems), function(i, e) {
    //                 select.append('<option value="'+i+'" '+(state && state.columns[colIndex].search.search == i ? 'selected' : '')+'>'+i+'</option>');
    //             });
    //             select.appendTo(th).on('change', function() {
    //                 column.search($(this).val()).draw();
    //             });
    //         }

    //         if(column_name == 'rating') {
    //             var select = $('<select class="form-control form-control-sm"><option value="">Todos</option></select>');
    //             for(let i = 1; i <= 5; i++) {
    //                 select.append('<option value="rating-value-'+i+'" '+(state && state.columns[colIndex].search.search == 'rating-value-'+i ? 'selected' : '')+'>'+i+'</option>');
    //             }
    //             select.appendTo(th).on('change', function() {
    //                 column.search($(this).val()).draw();
    //             });
    //         }

    //         if(column_name == 'has_match') {
    //             var select = $('<select class="form-control form-control-sm"><option value="">Todos</option></select>');
    //             select.append('<option value="Sim" '+(state && state.columns[colIndex].search.search == 'Sim' ? 'selected' : '')+'>Sim</option>');
    //             select.append('<option value="Não" '+(state && state.columns[colIndex].search.search == 'Não' ? 'selected' : '')+'>Não</option>');
    //             select.appendTo(th).on('change', function() {
    //                 column.search($(this).val()).draw();
    //             });
    //         }

    //         if(column_name == 'match') {
    //             $('<input type="text" class="form-control form-control-sm" placeholder="Buscar" value="'+(state ? state.columns[colIndex].search.search : '')+'" />')
    //                     .appendTo(th)
    //                     .on('keyup', function() {
    //                         column.search($(this).val(), false, true).draw();
    //                     });
    //         }

    //         if(column_name == 'phase') {
    //             var select = $('<select class="form-control form-control-sm"><option value="">Todos</option></select>');
    //             for(let i = 1; i <= 5; i++) {
    //                 select.append('<option value="'+i+'" '+(state && state.columns[colIndex].search.search == i ? 'selected' : '')+'>'+i+'</option>');
    //             }
    //             select.appendTo(th).on('change', function() {
    //                 column.search($(this).val()).draw();
    //             });

    //         }

    //         if(column_name == 'status') {
    //             var phaseStatus = JSON.parse(statusItems);
    //             var select = $('<select class="form-control form-control-sm"><option value="">Todos</option></select>');
    //             $.each(phaseStatus, function(i, e) {
    //                 select.append('<option value="status-'+e.id+'" '+(state && state.columns[colIndex].search.search == 'status-'+e.id ? 'selected' : '')+'>'+e.title+'</option>');
    //             });
    //             select.appendTo(th).on('change', function() {
    //                 column.search($(this).val()).draw();
    //             });
    //         }

    //         if(column_name == 'created_at') {
    //             $('<input type="text" class="form-control form-control-sm" placeholder="Buscar" value="'+(state ? state.columns[colIndex].search.search : '')+'" />')
    //                     .appendTo(th)
    //                     .on('keyup', function() {
    //                         column.search($(this).val(), false, true).draw();
    //                     });
    //         }
    //     });
    // },
});

$(document).on('click', '[data-action]', function(e) {
    e.preventDefault();
    var $btn = $(this);
    var html = $btn.html();
    var id = $btn.attr('data-id');
    var action = $btn.attr('data-action');
    var confirm = window.confirm('Confirma esta ação?');

    if(confirm) {

        $btn.html('<i class="fas fa-sync-alt fa-spin"></i>').attr('disabled', true);

        $.post(window.location.href + '/actions', {id: id, action: action}, function(resp) {
            if(!resp.error) {
                $table.ajax.reload(null, false);
            } else {
                $btn.html(html).attr('disabled', false);
                alert('Erro ao processar a requisição. Por favor, tente novamente mais tarde.');
            }
        });
    }
});

$('[name="delivery_date"]').inputmask('99/99/9999 99:99');

$('#delivery_date_input').datetimepicker({
    format: 'DD/MM/YYYY HH:mm',
    locale: 'pt-br',
    icons: {
        time: 'far fa-clock'
    }
});
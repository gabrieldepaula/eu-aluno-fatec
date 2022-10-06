const columns = [
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
        data: 'done_at',
        name: 'done_at',
        title: 'Feito em',
        searchable: true,
        orderable: true,
    },
    {
        data: 'delivered_at',
        name: 'delivered_at',
        title: 'Entregue em',
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

const $table = $('#items').DataTable({
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
    initComplete: function () {

        const state = $table.state.loaded();
        $(this).find('thead').append('<tr role="row" class="filters"></tr>');

        this.api().columns().every(function(colIndex) {

            let th = $('<th></th>').appendTo($('tr.filters'));
            let column = this;
            let column_name = column.dataSrc();

            if(column_name == 'code') {
                $('<input type="text" class="form-control form-control-sm" placeholder="Buscar" value="'+(state ? state.columns[colIndex].search.search : '')+'" />')
                        .appendTo(th)
                        .on('keyup', function() {
                            column.search($(this).val(), false, true).draw();
                        });
            }

            if(column_name == 'title') {
                $('<input type="text" class="form-control form-control-sm" placeholder="Buscar" value="'+(state ? state.columns[colIndex].search.search : '')+'" />')
                        .appendTo(th)
                        .on('keyup', function() {
                            column.search($(this).val(), false, true).draw();
                        });
            }

            if(column_name == 'subject') {
                const subjectsItems = JSON.parse(subjects);
                const select = $('<select class="form-control form-control-sm"><option value="">Todos</option></select>');
                $.each(subjectsItems, function(i, e) {
                    select.append('<option value="subject-'+e.id+'" '+(state && state.columns[colIndex].search.search == 'subject-'+e.id ? 'selected' : '')+'>'+e.title+'</option>');
                });
                select.appendTo(th).on('change', function() {
                    column.search($(this).val()).draw();
                });
            }

            if(column_name == 'delivery_date') {
                $('<input type="text" class="form-control form-control-sm" placeholder="Buscar" value="'+(state ? state.columns[colIndex].search.search : '')+'" />')
                        .appendTo(th)
                        .on('keyup', function() {
                            column.search($(this).val(), false, true).draw();
                        });
            }

            if(column_name == 'done_at') {
                $('<input type="text" class="form-control form-control-sm" placeholder="Buscar" value="'+(state ? state.columns[colIndex].search.search : '')+'" />')
                        .appendTo(th)
                        .on('keyup', function() {
                            column.search($(this).val(), false, true).draw();
                        });
            }

            if(column_name == 'delivered_at') {
                $('<input type="text" class="form-control form-control-sm" placeholder="Buscar" value="'+(state ? state.columns[colIndex].search.search : '')+'" />')
                        .appendTo(th)
                        .on('keyup', function() {
                            column.search($(this).val(), false, true).draw();
                        });
            }

            if(column_name == 'status') {
                const select = $('<select class="form-control form-control-sm"><option value="">Todos</option></select>');
                select.append('<option value="status-1" '+(state && state.columns[colIndex].search.search == 'status-1' ? 'selected' : '')+'>Pendentes</option>');
                select.append('<option value="status-2" '+(state && state.columns[colIndex].search.search == 'status-2' ? 'selected' : '')+'>Feitas</option>');
                select.append('<option value="status-3" '+(state && state.columns[colIndex].search.search == 'status-3' ? 'selected' : '')+'>Entregues</option>');
                select.append('<option value="status-4" '+(state && state.columns[colIndex].search.search == 'status-4' ? 'selected' : '')+'>Atrasadas</option>');
                select.appendTo(th).on('change', function() {
                    column.search($(this).val()).draw();
                });
            }
        });
    },
});

$(document).on('click', '[data-action]', function(e) {
    e.preventDefault();
    const $btn = $(this);
    const html = $btn.html();
    const id = $btn.attr('data-id');
    const action = $btn.attr('data-action');
    const confirm = window.confirm('Confirma esta ação?');

    if(confirm) {
        $btn.html('<i class="fas fa-sync-alt fa-spin"></i>').attr('disabled', true);
        $.post(cmsRoute('student.task.actions'), {id: id, action: action}, function(resp) {
            if(!resp.error) {
                $table.ajax.reload(null, false);
            } else {
                $btn.html(html).attr('disabled', false);
                alert('Erro ao processar a requisição. Por favor, tente novamente mais tarde.');
            }
        });
    }
});
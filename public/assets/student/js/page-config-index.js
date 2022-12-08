$('.select2').select2();

$('.btn-delete-account').on('click', function(e) {
    e.preventDefault();
    const $btn = $(this);
    const confirm = window.confirm('Tem certeza que deseja apagar sua conta e todas as suas tarefas?');

    if(confirm) {
        $btn.html('<i class="fas fa-sync-alt fa-spin"></i>').attr('disabled', true);
        $.post(cmsRoute('student.config.actions'), {action: 'delete-account'}, function(resp) {
            if(!resp.error) {
                window.location.href = login_url;
            } else {
                $btn.html(html).attr('disabled', false);
                alert('Erro ao processar a requisição. Por favor, tente novamente mais tarde.');
            }
        });
    }
});
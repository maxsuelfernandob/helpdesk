function novaSugestao() {
    $('#btnNovaSugestao').attr('disabled', 'disabled');
    destino = "../../interacao/iSugestao.php";
    param = $("#frmNovaSugestao").serialize() + "&acao=inserir"; 
    
    $.post(destino, param, function(data) {
        if (data.length > 0) {
            $('#btnNovaSugestao').removeAttr('disabled');
            $.smkAlert({
                text: data,
                type: 'danger',
                time: 10
            });
            return false;
        } else {
            data = 'Sucesso! Sua sugestão foi enviada para a equipe de suporte!';
            $.smkAlert({
                text: data,
                type: 'success'
            });
        }
    });
}
function novaOcorrencia() {
    $('#btnNovaOcorrencia').attr('disabled', 'disabled');
    destino = "../../interacao/iOcorrencia.php";
    param = $("#frmNovaOcorrencia").serialize() + "&acao=inserir"; 
    
    $.post(destino, param, function(data) {
        if (data.length > 0) {
            $('#btnNovaOcorrencia').removeAttr('disabled');
            $.smkAlert({
                text: data,
                type: 'danger',
                time: 10
            });
            return false;
        } else {
            data = 'Sucesso! Uma nova ocorrencia foi solicitada, aguarde!';
            $.smkAlert({
                text: data,
                type: 'success'
            });
        }
    });
}
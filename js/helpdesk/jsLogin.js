function efetuarLogin() { 
    $('#btnLogin').attr('disabled', 'disabled');
    destino = "interacao/iLogin.php";
    param = $("#frmLogin").serialize() + "&acao=efetuarLogin"; 
    
    $.post(destino, param, function(data) {
        if (data.length > 0) {
            $('#btnLogin').removeAttr('disabled');
            $.smkAlert({
                text: data,
                type: 'danger',
                time: 10
            });
            return false;
        }
        location.href = "view/validarTipoUsuario.php";
    });
}
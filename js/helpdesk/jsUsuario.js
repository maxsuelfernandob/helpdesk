function inserirUsuario() {   
    $('#btnCadastrarUsuario').attr('disabled', 'disabled');
    destino = "interacao/iUsuario.php";
    param = $("#frmCadastroUsuario").serialize() + "&acao=inserirUsuario";
    
    $.post(destino, param, function(data) {
        if (data.length > 0) { 
            $('#btnCadastrarUsuario').removeAttr('disabled');
            $.smkAlert({
                text: data,
                type: 'danger',
                time: 10
            });
            return false;
        } else {
            data = 'Sucesso! Os dados foram armazenados com sucesso!';
            //$("#limparCampos").click();
            $.smkAlert({
                text: data,
                type: 'success'
            });
        }
    });
}

function inserirUsuarioPorAdmin() {   
    $('#btnCadastrarUsuario').attr('disabled', 'disabled');
    destino = "../../interacao/iUsuario.php";
    param = $("#frmCadastroUsuario").serialize() + "&acao=inserirUsuario";
    
    $.post(destino, param, function(data) {
        if (data.length > 0) { 
            $('#btnCadastrarUsuario').removeAttr('disabled');
            $.smkAlert({
                text: data,
                type: 'danger',
                time: 10
            });
            return false;
        } else {
            data = 'Sucesso! Os dados foram armazenados com sucesso!';
            //$("#limparCampos").click();
            $.smkAlert({
                text: data,
                type: 'success'
            });
        }
    });
}

function recuperarSenha() {
    $('#btnRecuperarSenha').attr('disabled', 'disabled');
    destino = "interacao/iUsuario.php";
    param = $("#frmRecuperaSenha").serialize() + "&acao=recuperarSenha";    

    $.post(destino, param, function(data) {
        if (data.length > 0) { 
            $('#btnRecuperarSenha').removeAttr('disabled');
            $.smkAlert({
                text: data,
                type: 'danger',
                time: 10
            });
            return false;
        } else {
            //document.location.href = 'index.php';
            data = 'Verifique seu endereço de email cadastrado ou entre em contato com o suporte!';
            //$("#limparCampos").click();
            $.smkAlert({
                text: data,
                type: 'success'
            });
        }
    });
}

function alterarSenha() {
    $('#btnAlterarSenha').attr('disabled', 'disabled');
    destino = "interacao/iUsuario.php";
    param = $("#frmAlteraSenha").serialize() + "&acao=alterarSenha";    

    $.post(destino, param, function(data) {
        if (data.length > 0) {
            $('#btnAlterarSenha').removeAttr('disabled');
            $.smkAlert({
                text: data,
                type: 'danger',
                time: 10
            });
            return false;
        } else {
            //document.location.href = 'index.php';
            data = 'Senha alterada com sucesso!';
            //$("#limparCampos").click();
            $.smkAlert({
                text: data,
                type: 'success'
            });
        }
    });
}
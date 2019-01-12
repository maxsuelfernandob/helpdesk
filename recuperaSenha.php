<?php
    @session_start();
    
    if((isset ($_SESSION['usu_login']) == true) and (isset ($_SESSION['usu_senha']) == true)){
        if($_SESSION['usu_tipo'] == 'U') {
            header('location:view/usuario/index.php');
        } else if($_SESSION['usu_tipo'] == 'A') {
            header('location:view/admin/index.php');
        }
    }    
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>RECUPERAR SENHA</title>

    <script src="js/jquery-2.1.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link href="css/helpdesk/style.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="smoke-v2.2.4/css/smoke.min.css" rel="stylesheet">

    <nav class="navbar navbar-default" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Início</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav"> 
                <form class="navbar-form navbar-left signin-wrapper" role="form" action="view/validarTipoUsuario.php" id="frmLogin" name="frmLogin">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Login:" name="USU_LOGIN" id="USU_LOGIN">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Senha:" name="USU_SENHA" id="USU_SENHA">
                    </div>
                    <input id="btnLogin" class="btn btn-primary" type="button" value="Entrar" onclick="efetuarLogin()">
                </form>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="cadastro.php">Cadastrar</a>
                </li>
            </ul>
        </div>
    <!-- /.navbar-collapse -->
    </nav>

</head>
	
<body class="main">

    <br><br><br>

    <div class="tgeral" id="t01forgot"><br/>Recuperar senha</div><br/>

    <center>
        <form class="form-signin" role="form" action="#" id="frmRecuperaSenha" name="frmRecuperaSenha">
            <div class="form-group" id="inputcenter">
                <input type="text" class="form-control" id="USU_LOGIN_EMAIL" placeholder="Login ou email:" name="USU_LOGIN_EMAIL">
            </div>
            <br/>
            <div class="actions">
                <input id="btnRecuperarSenha" class="btn btn-success" type="button" value="Recuperar" onclick="recuperarSenha()">
                <button type="reset" class="btn btn-danger"><span class="glyphicon glyphicon-repeat"></span> Limpar campo</button>
            </div>
        </form>
    </center> 

    <script language="javascript" src="js/helpdesk/jsLogin.js"></script>
    <script language="javascript" src="js/helpdesk/jsUsuario.js"></script>
    <script src="smoke-v2.2.4/js/smoke.min.js"></script>
    <script src="smoke-v2.2.4/lang/es.min.js"></script>

</body>
    
</html>
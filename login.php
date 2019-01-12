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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     
    <title>HELPDESK! - T.I</title>
 
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
            <div class="navbar-brand">HelpDesk - T.I</div>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="recuperaSenha.php">Esqueceu sua senha?</a>
                </li>
                <li class="dropdown">
                    <a href="cadastro.php">Cadastrar</a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </nav>

</head>

<body class="main">

    <br><br><br><br>
    <div id="msgRetorno"></div>
    <!--<div class="tgeral" id="t01main">HelpDesk!</div>-->
    <center>
        
        

    <br><br>
     
    <form role="form" action="view/validarTipoUsuario.php" class="signin-wrapper" id="frmLogin" name="frmLogin">
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Login:" name="USU_LOGIN" id="USU_LOGIN"> 
        </div>
        <div class="form-group">
            <input type="password" class="form-control" placeholder="Senha:" name="USU_SENHA" id="USU_SENHA">
        </div>
        <div class="actions">  
            <input id="btnLogin" class="btn btn-primary" type="button" value="Entrar" onclick="efetuarLogin()">
            <a href="recuperaSenha.php"><input id="btnLogin" class="btn btn-danger" type="button" value="Esqueceu a senha?" ></a>
        </div>
    </form>

    <br><br>

    </center>

<script language="javascript" src="js/helpdesk/jsLogin.js"></script>

<script src="smoke-v2.2.4/js/smoke.min.js"></script>
<script src="smoke-v2.2.4/lang/es.min.js"></script>
</body>

</html>
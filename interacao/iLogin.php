<?php

@session_start();
ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);
 
require_once '../controller/cUsuario.php';

$objetoLogin = new cUsuario();
$acao = @$_REQUEST["acao"];

if ($acao == 'efetuarLogin') { 
 
    $objetoLogin->setForm($_REQUEST);
    $retorno = $objetoLogin->recebeDadosForm();    
    
    if (sizeof($retorno) > 0) {
        if ($retorno[0]["case"] == "LOGIN_ERRO") { 
            print "Senha inválida. Digite novamente!";
            die;
        } else { 
            $_SESSION['usu_login'] = $objetoLogin->getUsu_login();
            $_SESSION['usu_senha'] = $objetoLogin->getUsu_senha();
            $_SESSION['usu_id'] = $objetoLogin->getUsu_id();            
            $_SESSION['usu_nome'] = $objetoLogin->getUsu_nome();
            $_SESSION['usu_sobrenome'] = $objetoLogin->getUsu_sobrenome();
            $_SESSION['usu_tipo'] = $objetoLogin->getUsu_tipo();
            $_SESSION['usu_email'] = $objetoLogin->getUsu_email();
        }
        $_SESSION['retorno'] = $retorno[0];
        die;
    } else {
        print "Login inválido. Por favor tente novamente.";
        die;
    }
    die;
}

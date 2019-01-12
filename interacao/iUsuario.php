<?php

@session_start();
ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);
 
require_once '../controller/cUsuario.php';

$objetoUsuario = new cUsuario();
$acao = @$_REQUEST["acao"];

if($acao == 'inserirUsuario') {
    $objetoUsuario->setForm($_REQUEST);
    $retorno = $objetoUsuario->recebeDadosForm();    
    return $objetoUsuario->getForm();
    die;
}

if($acao == 'mostrarGridUsuarios') {
    $vUsuarios = $objetoUsuario->Select();
    
    $grid = '';
    if (count($vUsuarios) == 0) {
        print "Nenhum resultado encontrado!";
    } else {
    $grid = "
      <table class='table table-striped table-hover' id='tableList'>
      <thead>
        <tr>
          <th class='text-primary'>Nome</th>
          <th class='text-primary'>Sobrenome</th>
          <th class='text-primary'>Login</th>
          <th class='text-primary'>Email</th>
          <th class='text-primary'>Setor</th>
          <th class='text-primary'>Ramal</th>
          <th class='text-primary'>Tipo</th>
        </tr>
      </thead>
      <tbody>";
        foreach ($vUsuarios as $usuario) {
 $grid .= "<tr>
                <td>
                    ".$usuario['usu_nome']."
                </td>
                <td>
                    ".$usuario['usu_sobrenome']."
                </td>   
                <td>
                    ".$usuario['usu_login']."
                </td>  
                <td>
                    ".$usuario['usu_email']."
                </td> 
                <td>
                    ".$usuario['usu_setor']."
                </td>  
                <td>
                    ".$usuario['usu_ramal']."
                </td>
                <td>
                    ".$usuario['usu_tipo']."
                </td>
                <td>
                    <input type='button' class='btn btn-success' value='Alterar'>
                    <input type='button' class='btn btn-danger' value='Excluir'>
                </td>                   
           </tr>";
        }
$grid .= " </tbody>
    </table>"; 
        }
    print $grid;
}

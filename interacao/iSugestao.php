<?php

@session_start();
ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);
 
require_once '../controller/cSugestao.php';

$objetoSugestao = new cSugestao();
$acao = @$_REQUEST["acao"];

if($acao == "inserir") {
    $objetoSugestao->setForm($_REQUEST);
    $retorno = $objetoSugestao->recebeDadosForm();    
    return $objetoSugestao->getForm();
    die;
}

if($acao == "mostrarGridSugestoes") {
    $vSugestoes = $objetoSugestao->Select();
    
    $grid = '';
    if (count($vSugestoes) == 0) {
        print "Nenhum resultado encontrado!";
    } else {
    $grid = "
      <table class='table table-striped table-hover' id='tableList'>
      <thead>
        <tr>
          <th class='text-primary'>Usuario</th>
          <th class='text-primary'>Setor</th>
          <th class='text-primary'>Sugestão</th>
          <th class='text-primary'>Data</th>
          <th class='text-primary'>Hora</th>
          <th class='text-primary'>IP acessado</th>
        </tr>
      </thead>
      <tbody>";
        foreach ($vSugestoes as $sugestao) {
 $grid .= "<tr>
                <td>
                    ".$sugestao['usu_nome']."
                </td>
                <td>
                    ".$sugestao['usu_setor']."
                </td>   
                <td>
                    ".$sugestao['sug_descricao']."
                </td>  
                <td>
                    ".$sugestao['sug_data']."
                </td> 
                <td>
                    ".$sugestao['sug_hora']."
                </td>  
                <td>
                    ".$sugestao['sug_ip']."
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


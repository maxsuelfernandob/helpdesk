<?php

@session_start();
ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);
 
require_once '../controller/cOcorrencia.php';

$objetoOcorrencia = new cOcorrencia();
$acao = @$_REQUEST["acao"];

if($acao == "inserir") {
    $objetoOcorrencia->setForm($_REQUEST);
    $retorno = $objetoOcorrencia->recebeDadosForm();    
    return $objetoOcorrencia->getForm();
    die;
}

if($acao == 'mostrarGridOcorrenciasUsuario') { 
    $vOcorrencias = $objetoOcorrencia->Select('and oco_usu_id='.$_SESSION['usu_id']);
//    print_r($vOcorrencias);die;
    $grid = '';
    if (count($vOcorrencias) == 0) {
        print "Nenhum resultado encontrado!";
    } else {
    $grid = "
      <table class='table table-striped table-hover' id='tableList'>
      <thead>
        <tr>
          <th class='text-primary'>Assunto</th>
          <th class='text-primary'>Ocorrência</th>
          <th class='text-primary'>Data</th>
          <th class='text-primary'>Hora</th>
          <th class='text-primary'>Status</th>
          <th class='text-primary'>Atendente</th>
        </tr>
      </thead>
      <tbody>";
        foreach ($vOcorrencias as $ocorrencia) {
 $grid .= "<tr>
                <td>
                    ".$ocorrencia['oco_relacionado']."
                </td>
                <td>
                    ".$ocorrencia['oco_descricao']."
                </td>   
                <td>
                    ".$ocorrencia['oco_data']."
                </td>  
                <td>
                    ".$ocorrencia['oco_hora']."
                </td> 
                <td>
                    ".$ocorrencia['oco_status']."
                </td>  
                <td>
                    ".$ocorrencia['oco_atendente']."
                </td>  
           </tr>";
        }
$grid .= " </tbody>
    </table>"; 
        }
    print $grid;
}

if($acao == 'mostrarGridOcorrenciasAbertas') { 
    $vOcorrencias = $objetoOcorrencia->Select("and oco_status='Aberto'");
    $grid = '';
    if (count($vOcorrencias) == 0) {
        print "Nenhum resultado encontrado!";
    } else {
    $grid = "
      <table class='table table-striped table-hover' id='tableList'>
      <thead>
        <tr>
          <th class='text-primary'>Usuario</th>
          <th class='text-primary'>Setor</th>
          <th class='text-primary'>Assunto</th>
          <th class='text-primary'>Ocorrência</th>
          <th class='text-primary'>Data</th>
          <th class='text-primary'>Hora</th>
          <th class='text-primary'>Status</th>
          <th class='text-primary'>IP acessado</th>
          <th class='text-primary'>Atendente</th>
        </tr>
      </thead>
      <tbody>";
        foreach ($vOcorrencias as $ocorrencia) {
 $grid .= "<tr>
                <td>
                    ".$ocorrencia['usu_nome']."
                </td>
                <td>
                    ".$ocorrencia['usu_setor']."
                </td>
                <td>
                    ".$ocorrencia['oco_relacionado']."
                </td>
                <td>
                    ".$ocorrencia['oco_descricao']."
                </td>   
                <td>
                    ".$ocorrencia['oco_data']."
                </td>  
                <td>
                    ".$ocorrencia['oco_hora']."
                </td> 
                <td>
                    ".$ocorrencia['oco_status']."
                </td>  
                <td>
                    ".$ocorrencia['oco_ip']."
                </td> 
                <td>
                    ".$ocorrencia['oco_atendente']."
                </td>  
                <td>
                    <input type='button' class='btn btn-primary' value='Atender' onclick='atenderOcorrencia()'>
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

if($acao == 'mostrarGridOcorrencias') { 
    $vOcorrencias = $objetoOcorrencia->Select();
    $grid = '';
    if (count($vOcorrencias) == 0) {
        print "Nenhum resultado encontrado!";
    } else {
    $grid = "
      <table class='table table-striped table-hover' id='tableList'>
      <thead>
        <tr>
          <th class='text-primary'>Usuario</th>
          <th class='text-primary'>Setor</th>
          <th class='text-primary'>Assunto</th>
          <th class='text-primary'>Ocorrência</th>
          <th class='text-primary'>Data</th>
          <th class='text-primary'>Hora</th>
          <th class='text-primary'>Status</th>
          <th class='text-primary'>IP acessado</th>
          <th class='text-primary'>Atendente</th>
        </tr>
      </thead>
      <tbody>";
        foreach ($vOcorrencias as $ocorrencia) {
 $grid .= "<tr>
                <td>
                    ".$ocorrencia['usu_nome']."
                </td>
                <td>
                    ".$ocorrencia['usu_setor']."
                </td>
                <td>
                    ".$ocorrencia['oco_relacionado']."
                </td>
                <td>
                    ".$ocorrencia['oco_descricao']."
                </td>   
                <td>
                    ".$ocorrencia['oco_data']."
                </td>  
                <td>
                    ".$ocorrencia['oco_hora']."
                </td> 
                <td>
                    ".$ocorrencia['oco_status']."
                </td>
                <td>
                    ".$ocorrencia['oco_ip']."
                </td>
                <td>
                    ".$ocorrencia['oco_atendente']."
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
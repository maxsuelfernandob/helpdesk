<?php

@session_start();
require_once '../db/dao.php';
require_once '../controller/cUsuario.php';

class mOcorrencia extends dao {

    private $oco_id;
    private $oco_relacionado;
    private $oco_descricao;
    private $oco_ip;
    private $oco_status;
    private $oco_obs;
    private $oco_atendente;
    private $usuario;
    
    function __construct() {
        $this->usuario = new cUsuario;
        $this->atendente = new cUsuario();
    }
    
    function getUsuario() {
        return $this->usuario;
    }
    
    function getOco_atendente() {
        return $this->oco_atendente;
    }
    
    function setOco_atendente($oco_atendente) {
        $this->oco_atendente = $oco_atendente;
    }
    
    function getOco_id() {
        return $this->oco_id;
    }

    function getOco_relacionado() {
        return $this->oco_relacionado;
    }

    function getOco_descricao() {
        return $this->oco_descricao;
    }

    function setOco_id($oco_id) {
        $this->oco_id = $oco_id;
    }

    function setOco_relacionado($oco_relacionado) {
        $this->oco_relacionado = $oco_relacionado;
    }

    function setOco_descricao($oco_descricao) {
        $this->oco_descricao = $oco_descricao;
    }

    function getOco_ip() {
        return $this->oco_ip;
    }

    function setOco_ip($oco_ip) {
        $this->oco_ip = $oco_ip;
    }
    
    function getOco_status() {
        return $this->oco_status;
    }

    function getOco_obs() {
        return $this->oco_obs;
    }

    function setOco_status($oco_status) {
        $this->oco_status = $oco_status;
    }

    function setOco_obs($oco_obs) {
        $this->oco_obs = $oco_obs;
    }
    
}


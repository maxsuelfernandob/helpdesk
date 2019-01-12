<?php

@session_start();
require_once '../db/dao.php';
require_once '../controller/cUsuario.php';

class mSugestao extends dao {

    private $sug_id;
    private $sug_descricao;
    private $sug_ip;
    
    private $usuario;
    
    function __construct() {
        $this->usuario = new cUsuario;
    }
    
    function getSug_id() {
        return $this->sug_id;
    }

    function getSug_descricao() {
        return $this->sug_descricao;
    }

    function getSug_ip() {
        return $this->sug_ip;
    }

    function getUsuario() {
        return $this->usuario;
    }

    function setSug_id($sug_id) {
        $this->sug_id = $sug_id;
    }

    function setSug_descricao($sug_descricao) {
        $this->sug_descricao = $sug_descricao;
    }

    function setSug_ip($sug_ip) {
        $this->sug_ip = $sug_ip;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }
    
}
<?php

interface ifControle {
    public function getForm();
    public function setForm($form);
    public function getAcao();
    public function setAcao($acao);
    public function recebeDadosForm();   
    public function validarDadosComuns();
}

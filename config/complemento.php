<?php

require_once '../db/db.class.php';

class complemento extends conexao {

    private $form, $acao, $where, $url, $order;

    public function getForm() {
        return $this->form;
    }

    public function setForm($form) {
        $this->form = $form;
    }

    public function getAcao() {
        return $this->acao;
    }

    public function setAcao($acao) {
        $this->acao = $acao;
    }

    function getWhere() {
        return $this->where;
    }

    function setWhere($where) {
        $this->where = $where;
    }

    public function getOrder() {
        return $this->order;
    }

    public function setOrder($order) {
        $this->order = $order;
    }

    public function getUrl() {
        return $this->url;
    }
    
    public function setUrl($url) {
        $this->url = $url;
    }

}

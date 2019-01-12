<?php
@session_start();
require_once "../db/dao.php";

class mLogAcesso extends dao {
    private $lac_id;
    private $lac_data_hora;
    private $lac_usu_id;
    private $lac_ip;
    
    public function getLac_id() {
        return $this->lac_id;
    }

    public function getLac_data_hora() {
        return $this->lac_data_hora;
    }

    public function getLac_usu_id() {
        return $this->lac_usu_id;
    }

    public function getLac_ip() {
        return $this->lac_ip;
    }

    public function setLac_id($lac_id) {
        $this->lac_id = $lac_id;
    }

    public function setLac_data_hora($lac_data_hora) {
        $this->lac_data_hora = $lac_data_hora;
    }

    public function setLac_usu_id($lac_usu_id) {
        $this->lac_usu_id = $lac_usu_id;
    }

    public function setLac_ip($lac_ip) {
        $this->lac_ip = $lac_ip;
    }
}

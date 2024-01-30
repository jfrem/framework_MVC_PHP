<?php
class Artticulo{
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function getArticulo(){
        $this->db->query("SELECT * FROM ArticuloS");
        return $this->db->setResul();
    }
}
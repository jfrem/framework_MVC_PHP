<?php
class Pages extends Controllers{
    public function __construct(){
        //echo 'Controlador pagina cargada';
        $this->articuloModelo = $this->modelo();
    }
    public function index(){
        $data = [
            'Titulo' => 'frameworks',
        ];
        $this->views('pages/index', $data);
    }
}
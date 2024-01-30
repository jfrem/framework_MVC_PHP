<?php
//Controlador principal
class Controllers {
    public function modelo($modelo) {
        require_once '../app/models/'. $modelo . '.php';
        return new $modelo();
    }
    public function views($viewName, $data = []) {
        if(file_exists('../app/views/'. $viewName . '.php')){
            require_once '../app/views/'. $viewName . '.php';
        }else{
            die("La vista no existe");
        }
    }
}
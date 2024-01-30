<?php
/*Mapear la URL
-Controlador
-Método
-Parámetro
*/


class Core
{
    protected $controladorActual = 'pages';
    protected $metodoActual = 'index';
    protected $parametros = [];

    public function __construct()
    {
        // print_r($this->getUrl());
        $url = $this->getUrl();

        //Buscar en controladores si el controlador existe 
        if (isset($url[0]) && file_exists('../app/Controllers/' . ucwords($url[0]) . '.php')) {
            //Si extite se setea como cotrolador por defecto
            $this->controladorActual = ucwords($url[0]);

            //Unset indice 
            unset($url[0]);
        }
        //queriri el controlador 
        require_once '../app/Controllers/' . $this->controladorActual . '.php';
        $this->controladorActual = new $this->controladorActual;


        //Verificar la segunda parte de la url (El Método)
        if (isset($url[1])) {
            if (method_exists($this->controladorActual, $url[1])) {
                $this->metodoActual = $url[1];
                //Unset indice 
                unset($url[1]);
            }
        }
        //Obtener los parámetros 
        $this->parametros = $url ? array_values($url) : [];
        
        //Llamar callback con parámetros array
        call_user_func_array([$this->controladorActual, $this->metodoActual], $this->parametros);
    }

    public function getUrl()
    {
        //echo $_GET['url'];
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode("/", $url);
            return $url;
        }
    }
}

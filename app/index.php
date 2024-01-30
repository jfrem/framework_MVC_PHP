<?php
//Cargar librerias

require_once 'config/Config.php';
// require_once 'library/Controller.php';
// require_once 'library/Core.php';
// require_once 'library/Database.php';

//Autoload php
spl_autoload_register(function($className){
    require_once 'library/' . $className . '.php';
});
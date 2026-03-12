<?php 
spl_autoload_register(function($class) { //vasculha no sistema arquivos com o nome do $class.php
    if(file_exists($class.'.php')){
        require_once $class.'.php';
    }
});

$classe = $_REQUEST['class'] ?? null;
$method = isset($_REQUEST['method']) ? $_REQUEST['method'] : null;

if(class_exists($classe)){
    $pagina = new $classe($_REQUEST);
    if(!empty($method) AND (method_exists($classe, $method))){
        $pagina->$method($_REQUEST);
    }
    $pagina->show();
}

    

?>
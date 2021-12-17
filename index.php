<?php
spl_autoload_register(function($class) {
    if (file_exists($class.'.php')) {
        require_once $class.'.php';
    }
});

$template = file_get_contents('templates/template.html');
$content = '';

if( $_REQUEST) {
    $classe = $_REQUEST['class'];
    $method = isset($_REQUEST['method']) ? $_REQUEST['method'] : null;

    if (class_exists($classe))
    {
        try 
        {
            $pagina = new $classe( $_REQUEST );
            
            if (!empty($method) AND (method_exists($classe, $method)))
            {
                $pagina->$method( $_REQUEST );
            }

            ob_start();
            $pagina->show();
            $content = ob_get_contents();
            ob_end_clean();
        } catch(Exception $e) {
            $content = $e->getMessage() . '<br>' .$e->getTraceAsString();
        }
    } else {
        $content = "Class <b>{$classe}</b> not found"; 
    }
}

if ($content == ''){
    $content = file_get_contents('templates/bem_vindo.html');
}

$output = str_replace('{content}', $content, $template);

echo $output;
?>
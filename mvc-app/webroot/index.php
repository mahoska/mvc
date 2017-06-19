<?php
error_reporting(E_ALL);

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', __DIR__.DS.'..'.DS);//   ../
define('VIEW_DIR', ROOT.'View'.DS);

    spl_autoload_register(function($className){
        $file = ROOT . str_replace('\\', DS, "{$className}.php");
        if(!file_exists($file)){
            throw new \Exception("{$file} not found".PHP_EOL.__FILE__.PHP_EOL."- in ".__LINE__.PHP_EOL);
        }
        
        require_once $file;
        
//        if(file_exists("Library/$file")){
//            require_once "Library/$file";
//        }elseif(file_exists("Controller/$file")){
//            require_once "Controller/$file";
//        }else{
//            throw new Exception("{$file} not found");
//        }
    });
    
    
    \Library\Session::start();

//    try{
        
        $request = new \Library\Request();
        
        $isAdminUri = strpos($request->getUri(), '/admin') === 0;
        
        if($isAdminUri){
            \Library\Controller::setAdminLoyout();
        }
        $pdo = new \PDO('mysql: host=localhost; dbname=mvc_17_03', 'root', '');
        //при любых ошибках будет выдавать exception
        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $pdo->exec("SET NAMES utf8");
        
        $container = new \Library\Container();
        $container->set('router', new \Library\Router());
        $container->set('db_connect', $pdo);
        $container->set('repository', (new \Library\RepositoryManager())->setPdo($pdo));
        //var_dump($container);
         
        $route = $request->get('route','default/index');//если параметра route вообще нет
        $route = explode('/',$route);
        //todo_1: если нет action
        if(count($route)<2){
            //throw new Exception("Not found action");
            $route = ["default","index"];//перенаправить на default/index
        }

        $controller = 'Controller\\'. ($isAdminUri ? "Admin\\": "") .ucfirst($route[0]).'Controller';//с большой буквы по стандарту
        
        $action = $route[1].'Action';

        $controller = (new $controller())->setContainer($container);//закидываем в контроллер контейнер с нужными нам свойствами

        if(!method_exists($controller, $action)){
             throw new Exception("{$action} not found".PHP_EOL.__FILE__.PHP_EOL."- in ".__LINE__.PHP_EOL);
        }
        
        //var_dump($controller,$action);
        echo $content = $controller->$action($request); //echo а не require чтоб мы мошли возвращать не обязательно html, а например xml
        //подгрузку layout делаем в контроллере
       
        
//}catch(PDOException $e) {
//    $time = date('Y m d H:i:s');
//    file_put_contents("errors",  "Connect error($time): ".PHP_EOL.$e->getMessage().PHP_EOL.PHP_EOL, FILE_APPEND);
//    $path = ROOT."index.php?route=default/error";
//    $controller->get('router')->redirect($path);
//    //header("Location: {$path}");
//}
//catch(Exception $e){
//    $time = date('Y m d H:i:s');
//    file_put_contents("errors", "ERROR_TIME:$time".PHP_EOL.$e->getMessage().PHP_EOL.PHP_EOL, FILE_APPEND);
//    $path = ROOT."index.php?route=default/index";
//    $controller->get('router')->redirect($path);
//    //header("Location: {$path}");
//}
    
?>

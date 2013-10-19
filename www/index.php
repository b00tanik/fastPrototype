<?php
error_reporting(E_ALL);
include 'path.php';
if(!isset($_GET['q']) || $_GET['q']=='') $_GET['q']='index/Main.show';
// dirname показывает папку, куда смотреть в контроллерах
// filename - название контроллера
// extension - метод контроллера

$includePath = array(LIBS, MODELS, ABSTRACT_LIBS, SMARTY_MAIN);
set_include_path(implode($includePath,PATH_SEPARATOR));
   function autoloadMain($class) {
      if(!class_exists($class))
         require $class.'.php';
   }
spl_autoload_register('autoloadMain');


include CONFIG.'system.php';
include LIBS.'Exceptions.php';

try{
    $path = pathinfo($_GET['q']);
    $controllerName = ucfirst(strtolower($path['filename']));
   $controllerPath = CONTROLLERS.$path['dirname'].'/'.$controllerName.'.php';
    $controllerMethod = $path['extension'];
    if(empty($controllerMethod)) $controllerMethod = 'show';
    if(file_exists($controllerPath)){
        include $controllerPath;
       /**
        * @var $controller Controller
        */
       $controller = new $controllerName;
        if(method_exists($controller, $controllerMethod)){
            $ret = $controller->{$controllerMethod}();
            if(!is_array($ret)) $ret = array();
            if(isset($_GET['view'])){
                if($_GET['view']=='json'){
                    echo json_encode($ret);
                } elseif($_GET['view']="raw"){
                    // controller manage output itself
                }
            } else {
               if($controller->getTemplate()===null){
                   $templatePath = TEMPLATES.$path['dirname'].'/'.$controllerName.'.'.$path['extension'].'.tpl';
                   if(file_exists($templatePath)){
                       include LIBS.'Smarty.php';
                       $smarty = new Smarty();
                       $smarty->caching=false;
                       foreach($ret as $ind=>$val){
                           $smarty->assign($ind, $val);
                       }
                       $smarty->display($templatePath);
                   } else throw new Exception500Error('TEMPLATE', $templatePath);
               }   else {

               }
            }
        } else throw new Exception404Error('CORE', $controllerPath.'.'.$controllerMethod);
        ;
    } else throw new Exception404Error('CORE', $controllerPath);

} catch (Exception $e) {

     // TODO: написать класс, который бы занимался оформлением
    if(!DEBUG){
      if($e instanceof Exception404Error){
        include('error404.html');
      } elseif ($e instanceof Exception500Error){
          include('error500.html');
      } else {
         include('error.html');
      }
    }
    else {
        echo '<pre>';
        echo $e->getMessage().'<br>'.$e->getTraceAsString();
    }
}

?>
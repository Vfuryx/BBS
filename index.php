<?php

//确定当前平台
$p = isset($_GET['p'])?$_GET['p']:'front';
define('PLATFORM',$p);

//确定控制器
$c = isset($_GET['c'])?$_GET['c']:'Login';

//确定调用方法
$a = isset($_GET['a'])?$_GET['a']:'Login';


//管理路径常量

//简化目录分隔符的名称
define('DS',DIRECTORY_SEPARATOR);
//根目录
define('ROOT_DIR',dirname(__FILE__).DS);

//应用程序入口
define('APP_DIR',ROOT_DIR.'app'.DS);
//控制器
define('CONT_DIR',APP_DIR.'controller'.DS);

//视图
define('VIEW_DIR',APP_DIR.'view'.DS);

//模型
define('MODEL_DIR',APP_DIR.'model'.DS);
//框架路径
define('FRAME_DIR',ROOT_DIR.'public'.DS.'furyx'.DS);

//当前控制器
define('CURR_CONT_DIR',CONT_DIR.PLATFORM.DS);

//当前视图
define('CURR_VIEW_DIR',VIEW_DIR.PLATFORM.DS);





if(is_writable(ROOT_DIR.'install'.DS.'install.php')){

    require ROOT_DIR.'install'.DS.'install.php';
}

if(is_writable(ROOT_DIR.'install'.DS.'install.lock')) {

    //自动加载函数
    function __autoload($class_name){
        $map = array(
            'Model' => FRAME_DIR.'Model.class.php',
            'MysqlDB' => FRAME_DIR.'MysqlDB.class.php',
            'Controller' => FRAME_DIR.'Controller.class.php',

        );

        if(isset($map[$class_name])){
            require_once $map[$class_name];
        }elseif(substr($class_name,-10) == 'Controller'){
            require_once CURR_CONT_DIR.$class_name.'.class.php';
        }elseif(substr($class_name,-5) == 'Model'){
            require_once MODEL_DIR.$class_name.'.class.php';
        }
    }

    //人口
    $controller_name = $c.'Controller';

    $action_name = $a.'Action';

    //实例化控制类
    $controller = new $controller_name;

    //调用方法
    $controller->$action_name();




}
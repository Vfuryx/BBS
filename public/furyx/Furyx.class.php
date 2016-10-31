<?php

class Furyx{
//    fury的框架初始化类


    public static function run(){


        //初始化请求参数
        self::initRequest();
        //初始化路经常量
        self::initPath();

        //初始化配置文件
        self::loadConfig();

        //注册自动加载
        spl_autoload_register(array('Furyx','furyx_autoload'));

        //初始化请求分发
        self::dispatch();


    }




    /**
     * 请求参数
     */
    private static function initRequest(){
        //确定当前平台
        define('PLATFORM',isset($_GET['p'])?$_GET['p']:'front');

        //确定控制器
        define('CONTROLLER',isset($_GET['c'])?$_GET['c']:'Login');

        //确定调用方法
        define('ACTION',isset($_GET['a'])?$_GET['a']:'Login');
    }


    /**
     * 路径常量
     */
    private static function initPath(){
        //管理路径常量

        //简化目录分隔符的名称
        define('DS',DIRECTORY_SEPARATOR);
        //根目录
        define('ROOT_DIR',dirname(dirname(dirname(__FILE__))).DS);

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

        //配置文件路径
        define('CONFIG_DIR',APP_DIR.'config'.DS);
    }


    /**
     * 自动加载方法
     * @param $class_name //类名
     */
    public static function furyx_autoload($class_name){
        $map = array(
            'Model' => FRAME_DIR.'Model.class.php',
            'MysqlDB' => FRAME_DIR.'MysqlDB.class.php',
            'Controller' => FRAME_DIR.'Controller.class.php',

        );

        if(isset($map[$class_name])){
            require_once $map[$class_name];
        }elseif(substr($class_name,-10) == 'Controller'){
//            var_dump(file_exists(CURR_CONT_DIR.$class_name.'.class.php'));
            require_once CURR_CONT_DIR.$class_name.'.class.php';
        }elseif(substr($class_name,-5) == 'Model'){
            require_once MODEL_DIR.$class_name.'.class.php';
        }
    }

    /*
     * 请求分发（路由？）
     */

    private static function dispatch(){

        $controller_name = CONTROLLER.'Controller';

        $action_name = ACTION.'Action';

        //实例化控制类
        $controller = new $controller_name;


        //调用方法
        $controller->$action_name();
    }

    private static function loadConfig(){
        $GLOBALS['config'] = require_once CONFIG_DIR.'config.php';
    }


}
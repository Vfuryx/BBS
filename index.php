<?php

    /**
     * 安装
     */

     if(is_writable('.'.DIRECTORY_SEPARATOR.'install'.DIRECTORY_SEPARATOR.'install.php')){
         require '.'.DIRECTORY_SEPARATOR.'install'.DIRECTORY_SEPARATOR.'install.php';
         die();
     }


    //入口
    require_once '.'.DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'furyx'.DIRECTORY_SEPARATOR.'Furyx.class.php';
Furyx::run();

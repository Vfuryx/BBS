<?php

//require_once WEB_APP.'/model/LoginModel.class.php';

class LoginController{


    function loginAction(){
        require_once CURR_VIEW_DIR.$GLOBALS['c'].'.html';
    }

    function signinAction(){
        session_start();

        $user = $_POST['user'];
        $passw = $_POST['passw'];
        $admin = new LoginModel();

        if($admin->checkByLogin($user,$passw)){
//            echo "<script>alert('登录成功')</script>";
            $_SESSION['user'] = $user;

            $message='登录成功';
            $url='index.php?c=Index&p=front&a=index';
            require_once CURR_VIEW_DIR.'refresh.html';
            die();

        }else{
//            echo "<script>alert('非法用户')</script>";
            $message='非法用户';
            $url='index.php?c=Login&p=front&a=login';
            require_once CURR_VIEW_DIR.'refresh.html';
            die();
        }
    }


}










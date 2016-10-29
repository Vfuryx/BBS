<?php

class Controller{


    public function getlogin(){
        session_start();

        $fun = isset($GLOBALS['f'])?$GLOBALS['f']:false;
        if($fun=='getUser'){
            unset($_SESSION['user']);
        }

        if($user = isset($_SESSION['user'])?$_SESSION['user']:false){
            $top_login = "
                <p class='welcom'>欢迎 {$user}</p>
                <a href='index.php?c=Index&p=front&f=getUser'>注销</a>
            ";
        }else{
            $top_login = "
                <a href='index.php?c=Register&p=front'>注册</a>
                <a href='index.php?c=Login&p=front'>登录</a>
            ";
        }

    }
}
<?php

class RegisterController extends Controller{

    function registerAction(){
        require_once CURR_VIEW_DIR.'Register.html';
    }


    function signinAction(){

        $obj = new RegisterModel();
        $array = array(
            'user' => trim($_POST['user']),
            'passw' => md5(trim($_POST['passw'])),
            'email' => trim($_POST['email']),
            'tele' => isset($_POST['tele'])?trim($_POST['tele']):'',
            'intro' => isset($_POST['intro'])?trim($_POST['intro']):''
        )
        ;

        if($obj -> repeat($array['user'])){
//            echo "<script>alert('重复用户，注册失败')</script>";

            $message='重复用户，注册失败';
            $url='index.php?c=Register&p=front&a=register';
//            require_once CURR_VIEW_DIR.'refresh.html';
//            die();
            $this->jump($url,$message,3);

        } elseif($obj ->register($array)){
//            echo "<script>alert('注册成功')</script>";
            $message='注册成功';
            $url='index.php?c=Login&p=front&a=login';
//            require_once CURR_VIEW_DIR.'refresh.html';
//            die();
            $this->jump($url,$message,3);

        }else{
//            echo "<script>alert('注册失败')</script>";

            $message='注册失败';
            $url='index.php?c=Register&p=front&a=register';
//            require_once CURR_VIEW_DIR.'refresh.html';
//            die();
            $this->jump($url,$message,3);
        }
    }


}








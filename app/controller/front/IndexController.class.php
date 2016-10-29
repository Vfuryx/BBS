<?php
class IndexController{

    function indexAction(){

//        开启session
        session_start();

        $index_model = new IndexModel();

        if($user = isset($_SESSION['user'])?$_SESSION['user']:false){
            $top_login = "
                <p class='welcom'>欢迎 {$user}</p>
                <a href='index.php?c=Index&p=front&a=logout'>注销</a>
            ";
        }else{
            $user='游客';
            $top_login = "
                <a href='index.php?c=Register&p=front&a=register'>注册</a>
                <a href='index.php?c=Login&p=front&a=login'>登录</a>
            ";
        }

        $rows = $index_model->getMess();

        //载入view
        require_once CURR_VIEW_DIR.$GLOBALS['c'].'.html';
    }



    function logoutAction(){
        $index_model = new IndexModel();
        $index_model->logout();
        header('Location: index.php?c=Index&p=front&a=index');
    }


    function postAction(){
        session_start();

        $index_model = new IndexModel();

        $array = array(
            'user' => isset($_SESSION['user'])?$_SESSION['user']:'游客',
            'mess' => trim($_POST['userpost'])
        );

        if ($index_model->postMess($array)) {

        } else {
            echo "<script>alert('失败')</script>";
        }

        header('Location: index.php?c=Index&p=front&a=index');
    }

}
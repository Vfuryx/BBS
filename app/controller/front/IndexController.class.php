<?php
class IndexController extends Controller{

    function indexAction(){

//        开启session
        @session_start();

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

        //分页参数
        //显示每一页多少条记录
        $perPage = 5;
        //总记录数 
        $totalRecord = $index_model->getTotalPages($perPage);
        //显示第几页 if $_GET['cur']<0 或者 大于总页数 则返回第一页
        $curPage = isset($_GET['cur']) && $_GET['cur']>0&&$_GET['cur']<=$totalRecord ? $_GET['cur']:1;

        $rows = $index_model->getMess($curPage,$perPage);

        //载入view
        require_once CURR_VIEW_DIR.'Index.html';


    }



    function logoutAction(){
        $index_model = new IndexModel();
        $index_model->logout();
        $url = 'index.php?c=Index&p=front&a=index';
        $this->jump($url);
    }


    function postAction(){
        @session_start();

        $index_model = new IndexModel();

        $array = array(
            'user' => isset($_SESSION['user'])?$_SESSION['user']:'游客',
            'mess' => trim($_POST['userpost'])
        );

        if ($index_model->postMess($array)) {

        } else {
            echo "<script>alert('失败')</script>";
        }

        $url = 'index.php?c=Index&p=front&a=index';


        $this->jump($url);
    }

}
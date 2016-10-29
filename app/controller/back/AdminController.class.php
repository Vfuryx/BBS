<?php

class AdminController{
    function __construct()
    {
       $this->adminLogin();
    }

    function adminLogin(){

        if (isset($_POST['submit'])) {

            $admin = new LoginModel();

            if($admin->admin($_POST['user'],$_POST['passw'])){
                echo "<script>alert('登录成功')</script>";
            }else{
                echo "<script>alert('非法用户')</script>";
            }

        }

        require_once CURR_VIEW_DIR.$GLOBALS['c'].'.html';

    }

}
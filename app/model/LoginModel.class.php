<?php
//require_once WEB_ROOT.'/public/furyx/Model.class.php';

class LoginModel extends Model
{
    public function login()
    {
        if (isset($_POST['submit'])) {
            $user = trim($_POST['user']);
            $passw = trim($_POST['passw']);

            $sql = "select password from {$this->db_prefix}_user_info where username = '$user'";
            $rows = $this->db->fetchRow($sql);

            if ($rows) {
                if ($passw == $rows[0]) {
                    echo "<script>alert('登录成功')</script>";
                } else {
                    echo "<script>alert('非法用户')</script>";
                }
            } else {
                echo "<script>alert('非法用户')</script>";
            }
        }
    }


    public function checkByLogin($user,$passw){
            $user = trim($user);
            $passw = md5(trim($passw));

            $sql = "select password from {$this->db_prefix}_user_info where username = '$user' and password = '$passw' ";
            $rows = $this->db->fetchAll($sql);

            return (bool)$rows;
    }


}


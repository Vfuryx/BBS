<?php

class RegisterModel extends Model
{
    public function register($array)
    {
        $sql="insert into {$this->db_prefix}_user_info values (null,'{$array['user']}','{$array['passw']}',1,100,'{$array['email']}','{$array['tele']}','{$array['intro']}');";

        $rows = $this->db->query($sql);
        //var_dump($sql,$rows,(bool)$rows);
        return (bool)$rows;

    }

    public function repeat($user){
        $user = trim($user);

        $sql="select * from {$this->db_prefix}_user_info where username = '$user'";

        $rows = $this->db->fetchAll($sql);
        //var_dump($sql,$rows,(bool)$rows);
        return (bool)$rows;
    }


}


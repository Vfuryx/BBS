<?php
class IndexModel extends Model{


    function logout(){
        session_start();
        unset($_SESSION['user']);
    }

    function postMess($array){
        $sql = "insert into {$this->db_prefix}_message_board values (null,'{$array['user']}','{$array['mess']}',now())";

        $rows = $this->db->query($sql);

        return (bool)$rows;
    }

    function getMess(){
        $sql = "select * from {$this->db_prefix}_message_board";

        $rows = $this->db->fetchAll($sql);

        return $rows;
    }


}
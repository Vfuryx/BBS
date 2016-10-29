<?php
require_once WEB_ROOT.'/public/furyx/Model.class.php';

class ShowModel extends Model{
    public function show(){

        $sql="desc {$this->db_prefix}_user_info";

        return $this->db->fetchRow($sql);

    }
}


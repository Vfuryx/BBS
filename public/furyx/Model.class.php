<?php
//基础模型类
class Model {

    public  $db;//保存MySQLDB类的对象****
    public  $db_prefix ;//保存表前缀****


    public function __construct()
    {
        $this->intoLink();
    }

    protected function intoLink(){
        $this->db_prefix=$GLOBALS['config']['database']['db_prefix'];
        $this->db = MysqlDB::getInstance($GLOBALS['config']['database']);
    }

}

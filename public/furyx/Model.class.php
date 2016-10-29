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

        require ROOT_DIR.'/public/furyx/config.php';
        $this->db_prefix=$params['db_prefix'];
        $arr = $params;
        $this->db = MysqlDB::getInstance($arr);


    }

}

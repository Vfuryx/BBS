<?php
class IndexModel extends Model{


    /**
     * 清除session用户
     */
    function logout(){
        session_start();
        unset($_SESSION['user']);
    }



    function postMess($array){
        $sql = "insert into {$this->db_prefix}_message_board values (null,'{$array['user']}','{$array['mess']}',now())";

        $rows = $this->db->query($sql);

        return (bool)$rows;
    }

    /**
     * 查询留言信息
     * @param $curPage //第几页
     * @param $perPage //显示每一页多少条记录
     * @return mixed //返回显示资源
     */

    function getMess($curPage,$perPage){
        $curPage=($curPage-1)*$perPage;
        $sql = "select * from {$this->db_prefix}_message_board where 1 order by id desc limit {$curPage},{$perPage}  ";

        $rows = $this->db->fetchAll($sql);

        return $rows;
    }

    function paging(){

    }

    /**
     * 获得总记录的条目数
     * @param $perPage //显示每一页多少条记录
     * @return float 返回总页数
     */

    function getTotalPages($perPage){
        //获得总记录的条目数
        $sql = "select COUNT(*) from {$this->db_prefix}_message_board where 1 ";
        $rows = $this->db->fetchRow($sql);
        //获得显示记录的页数
        $totalpages = ceil($rows[0]/$perPage);
        return $totalpages;
    }


}
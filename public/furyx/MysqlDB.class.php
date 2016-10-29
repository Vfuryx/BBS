<?php

class MysqlDB{

	private $host;
	private $port;
	private $user;
	private $passw;
	private $dbname;
	private $charset;


	private $link;
	private $last_sql;

	private static $instance;

	public static function getInstance($params){
		if(!(self::$instance instanceof self)){
			return new MysqlDB($params);
		}else{
			return self::$instance;
		}
	}

	private function __construct($array){
		$this->host=isset($array['host'])?$array['host']:'127.0.0.1';
		$this->port=isset($array['port'])?$array['port']:'3306';
		$this->user=isset($array['user'])?$array['user']:'root';
		$this->passw=isset($array['passw'])?$array['passw']:'';
		$this->dbname=isset($array['dbname'])?$array['dbname']:'';
		$this->charset=isset($array['charset'])?$array['charset']:'utf8';
		//var_dump($this->host,$this->port,$this->user,$this->passw,$this->dbname,$this->charset);
		$this->connect();
		$this->setCharset();
		$this->selectDB();

	}

	/**
	 * 克隆
	 * @access private
	 */
	private function __clone(){}


	public function query($sql){
		$this->last_sql=$sql;
		if(!$result=mysql_query($sql,$this->link)){
			echo 'sql执行失败'.'<br />';
			echo '错误语句：'.$sql.'<br />';
			echo '错误代码：'.mysql_errno($this->link).'<br />';
			echo '错误信息：'.mysql_error($this->link).'<br />';
			die();
			//return false;
		}else{
			return $result;
		}
	}

//$link=mysql_connect("127.0.0.1:3306",'root',123456);
	private function connect(){
		if(@!$link=mysql_connect("{$this->host}:{$this->port}",$this->user,$this->passw)){
			echo '连接数据库失败';
			die();
		}else{
			$this->link=$link;
			//var_dump($link);
		}
	}


//mysql_query("set names 'utf8'");
	private function setCharset(){
		$sql='set names '.$this->charset;
		//mysqli_query($sql,$this->link);
		return $this->query($sql);
	}

//mysql_select_db('blog') or die('xxxx');
	private function selectDB(){

		if($this->dbname===''){
			return '';
		}
		$sql="use {$this->dbname}";
		return $this->query($sql);
	}


	public function fetchAll($sql){
		if($result = $this->query($sql)){
			$rows = array();
			while($row = mysql_fetch_assoc($result)){
				$rows[] = $row;
			}
			mysql_free_result($result);

			return $rows;
		}
		return false;

	}

	////row返回的是索引数组，因此0元素
	public function fetchColumn($sql){
		if($result = $this->query($sql)){
			$rows = array();
			while( $row = mysql_fetch_row($result)){
				$rows []= $row;
			}
			mysql_free_result($result);
			return $rows;
		}
		return false;
	}

	//输出第一列
	public function fetchRow($sql){

		if($result = $this->query($sql)){

			$rows = array();
			while( $row = mysql_fetch_row($result)){
				$rows []= $row[0];
			}
			mysql_free_result($result);

			return $rows;
		}
		return false;
	}


//	public function show(){
//		$sql='show tables';
//		//$result = $this->query($sql);
//		//return $this->fetchAll($sql);
//		return $this->fetchColumn($sql);
//		//return $this->fetchRow($sql);
//		//echo $sql;
//	}

}//end_mysqldb



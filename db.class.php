<?php

header("content-type:text/html,charset=utf-8");
error_reporting('E_NOTICE');


class db{

	protected $connect;
	protected $host;
	protected $user;
	protected $password;
	protected $database;
	public $table_name;


	//连接数据库
	function db_connect(){

		$this->connect = mysqli_connect($this->host,$this->user,$this->password,$this->database);

		if(!$this->connect){

			echo "mysql连接失败".mysqli_connect_error();

		}


		mysqli_set_charset($this->connect,'utf8');

	}


	//初始化赋值
	function __construct($host,$user,$password,$database){

		$this->connect = $connect;
		$this->host = $host;
		$this->user = $user;
		$this->password = $password;
		$this->database = $database;

	}


	//插入数据
	function d_insert($typearr,$valuearr){

		$sql = "insert into $this->table_name (".implode(',',$typearr).") values(".implode(',',$valuearr).")";

		$result = mysqli_query($this->connect,$sql);

		if(!$result){

			echo mysqli_error($this->connect);

		}else{

			echo "insert successfully";
		}

	}


	//查询单条、多条数据
	function d_select($fieldArr="",$where="",$limit=""){

		if(empty($where)){

			$where = "";

		}else{

			$where = " where ".$where;

		}


		if(empty($fieldArr)){

			$field = "*";

		}else{

			$field = implode(',', $fieldArr);
		}


		if(empty($limit)){

			$limit = "";
		
		}else{

			$limit = " limit ".$limit;

		}

		$sql = "select {$field} from ".$this->table_name.$where.$limit;

		$result = mysqli_query($this->connect,$sql);


		if(!$result){

			echo mysqli_error($this->connect);
		}


		while($line = mysqli_fetch_ASSOC($result)){

			var_dump($line);
		}
		
	}


	//删除操作
	function d_delete($where){

		if(empty($where)){

			$where = "";

		}else{

			$where = "where ".$where;

		}


		$sql = "delete from ".$this->table_name." $where ";

		$result = mysqli_query($this->connect,$sql);

		if(!$result){

			echo mysqli_error($this->connect);

		}else{

			echo "Delete successfully";

		}

	}


	//更新操作
	function d_update($fieldArr,$valueArr,$where=""){

		if(empty($where)){

			$where = "";

		}else{

			$where = " where ".$where;
		}


		foreach($fieldArr as $key => $value){

			$field = $value. '=' . $valueArr[$key];

		}


		$sql = "update ".$this->table_name." set ".$field .$where;

		$result = mysqli_query($this->connect,$sql);

		if(!$result){

			echo mysqli_error($this->connect);

		}else{

			echo 'updated';

		}

	}


	//关闭数据库
	function __destruct(){

		$close = mysqli_close($this->connect);

		if(!$close){

			echo mysqli_error($this->connect);

		}

	}


}


//测试

/*
$one = new db('127.0.0.1','root','newc','library');
$one->db_connect();
$one ->table_name = 'l_user';
*/

//插入数据测试
/*
$typearr = array('id','name');
$valuearr = array(13,'"xy"');
$one->d_insert($typearr,$valuearr);
*/



//查询数据测试
/*
$fieldArr = array('id','name');
$one->d_select($fieldArr,'id > 3',5);
*/


//删除数据测试
//$one->d_delete('id > 100');



//更新数据测试
/*
$fieldArr = array('id','name');
$valueArr = array(7,'"qq"');
$one->d_update($fieldArr,$valueArr,'id = 7');
*/

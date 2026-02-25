<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

//require_once(APPPATH.'third_party/Zend/Cache.php');
require_once('Zend/Db.php');
require_once('Zend/Db/Expr.php');

class MY_Model extends CI_Model {

	public $parent_name = null;
	public $tbname = null;
	private $_hasLoadConstructor = false;
	private static $_conn = null;
	private static $_cache = null;
	public $db_master = 'default';
	public $conn = null;
	
	public function __construct()
	{
		log_message('debug', "Model Class Initialized");
	}
	
	public function connect($profile=null)
	{
		require(APPPATH.'config/database.php');

		if (is_null($profile))
		{
			$profile = $active_group;
		}
		$dbConf = $db[$profile];
		$params = array(
						'host' => $dbConf['hostname'],
						'username' => $dbConf['username'],
						'password' => $dbConf['password'],
						'dbname' => $dbConf['database']
					);
		if(!$this->conn){
			$this->conn = Zend_Db::factory($dbConf['dbdriver'], $params);
			if ($dbConf['char_set'] && $dbConf['dbcollat'])
			{
				$this->conn->Query('SET character_set_results='.$dbConf['char_set']);
				$this->conn->Query('SET collation_connection='.$dbConf['dbcollat']);
				$this->conn->Query('SET NAMES '.$dbConf['char_set']);
			}
			//echo 'X';
		}else{
			//echo 'S';
		}
		self::$_conn = $this->conn;
	}

	public function qoute($string)
	{
		$this->connect($this->db_master);
		return self::$_conn->quoteIdentifier($string);
	}
	
	public function quoteInto($text, $value, $type= null, $count=null)
	{
		$this->connect($this->db_master);
		return self::$_conn->quoteInto($text, $value, $type, $count);
	}
	
	public function select()
	{	
		$this->connect($this->db_master);
		return self::$_conn->select();
	}
	
	public function fetchObject($sql, $attrs=null)
	{
		$this->check_command($sql);
		$this->connect($this->db_master);
		return self::$_conn->fetchObject($sql, $attrs);
	}

	public function fetchAll($sql, $attrs=null)
	{
		$this->check_command($sql);
		$this->connect($this->db_master);
		return self::$_conn->fetchAll($sql, $attrs);
	}
	
	public function fetchRow($sql, $attrs=null)
	{
		$this->check_command($sql);
		$this->connect($this->db_master);
		return self::$_conn->fetchRow($sql, $attrs);
	}

	public function fetchOne($sql, $attrs=null)
	{
		$this->check_command($sql);
		$this->connect($this->db_master);
		return self::$_conn->fetchOne($sql, $attrs);
	}
	
	public function fetchCol($sql, $attrs=null)
	{
		$this->check_command($sql);
		$this->connect($this->db_master);
		return self::$_conn->fetchCol($sql, $attrs);
	}
	
	public function fetchPair($sql, $attrs=null)
	{
		$this->check_command($sql);
		$this->connect($this->db_master);
		return self::$_conn->fetchPair($sql, $attrs);
	}
	
	/**
	 * fetchPage
	 * This function only work with Zend_db_Select statement
	 *
	 *
	 * @access	 public
	 * @param object (Zend_Db_Select)
	 * @param array
	 * @param integer
	 * @param integer
	 * @return	array
	 */
	public function fetchPage($sql, $attrs=array(), $page=1, $limit_per_page=20)
	{
		$this->check_command($sql);
		$page = ((int) $page < 1) ? 1 : $page;

		$sql->limitPage($page, $limit_per_page);
		$rows = self::$_conn->fetchAll($sql, $attrs);

		$sql->reset(Zend_Db_Select::COLUMNS);
		$sql->reset(Zend_Db_Select::ORDER);
		$sql->reset(Zend_Db_Select::LIMIT_COUNT);
		$sql->reset(Zend_Db_Select::LIMIT_OFFSET);

		$sql->columns('COUNT(*)');

		if ($sql->getPart(Zend_Db_Select::GROUP))
		{
			$records = self::$_conn->fetchAll($sql, $attrs);
			$row_count = count($records);
		}
		else
		{
			$row_count = self::$_conn->fetchOne($sql, $attrs);
		}
		
		if($limit_per_page <= 0) $limit_per_page = 20;
		
		$data = array(
			'rows' => $rows,
			'row_count' => $row_count,
			'limit_per_page' => $limit_per_page,
			'current_page' => $page,
			'total_page' => ceil($row_count/$limit_per_page)
		);
		
		return $data;
	}

	public function insert($table, $data)
	{
		$this->connect($this->db_master);
		if (self::$_conn->insert($table, $data))
		{
			return self::$_conn->lastInsertId();
		}
		return false;
	}

	public function update($table, $data, $where)
	{
		$this->connect($this->db_master);
		return self::$_conn->update($table, $data, $where);
	}
	
	public function delete($table, $where)
	{
		$this->connect($this->db_master);
		return self::$_conn->delete($table, $where);
	}
	
	public function expr($string)
	{
		return new Zend_Db_Expr($string);
	}

	private function check_command($sql){
		$filter = ' union ';
		$sql = urldecode(strtolower($sql));
		//echo '['.$sql.']';
		//echo '<br>';
		//echo '['.$filter.']';
		if(stripos($sql,$filter) !== FALSE){
			$url =@site_url($_SERVER["REQUEST_URI"]);
			$filename = site_path("assets/logs/sql/".date("Y-m-d").".htm");
			$handle = fopen($filename, 'a+');
			fwrite($handle,"<br />TIMESTAMP : ".date("Y-m-d H:i:s")."<br />URL : ".$url."<br />COMMAND : ".$sql."<br />IP : ".$_SERVER['REMOTE_ADDR']."<br />");
			fclose($handle);	
			
			die('ERROR : SQL Commend.');
		}
	}
}
?>
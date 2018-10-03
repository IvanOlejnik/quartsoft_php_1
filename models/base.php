<?php
class DB
{
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $db = "my_web_r_magaz_one";
    private $charset = "utf8";
    public $pdo = "";
 
    public function __construct()
    {
        $dsn = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset";
        $opt = array(
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        );
        $this->pdo = new PDO($dsn, $this->user, $this->password, $opt);
    }
 	/**
	* функция добавления записи в базу данных
	* @param Array $data массив данных для добавления
	* @return Bollean
	*/
	public function add($data){
		$fields = $this->set_fields($data);
		$sql = "INSERT INTO {$this->table_name} SET ".$fields;
		//var_dump($sql);
		$stmt = $this->pdo->prepare($sql);
		return $stmt->execute($data);
	}
	
	/**
	 * Внутренная функция для формирования строки SET
	 * @param Array $items
	 * @return String
	 */
	private function set_fields($items)
	{
	$str = array();
	if (empty($items)) {
		return "";
	}
	foreach ($items as $key => $value){
		$str[] = "`".$key."`=:".$key;
	}
	return implode(',', $str);
	}
	
	/**
	 * функция извлечения всех данных из таблицы
	 * @return Bollean
	 */
	public function get_all(){
		$sql = "SELECT * FROM {$this->table_name} ";
		$stmt = $this->pdo->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();
		return $result;
	}
	
	
}
?>
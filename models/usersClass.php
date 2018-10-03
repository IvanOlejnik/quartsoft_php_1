<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/models/base.php';
class Users extends DB{
	public $table_name = "users";
	
	//проверка введенного значения на совпадение в базе
	public function serchField($valuetwo){
		$sql = "SELECT * FROM {$this->table_name}";
		$stmt = $this->pdo->query($sql);
		$row = $stmt->fetchAll();
			foreach ($row as $key => $value) {
				if($value["email"]===$valuetwo){
						$flag = false;
						return $flag;
				}
				else{
					$flag = true;
				}
			}
		return $flag;
	}

	public function matchPassword($valuEmail, $valuePass){
		$sql = "SELECT * FROM {$this->table_name}";
		$stmt = $this->pdo->query($sql);
		$row = $stmt->fetchAll();
			foreach ($row as $key => $value) {
				if($value["email"]===$valuEmail){
					if($value["password"]===$valuePass){
						$flag = false;
						return $flag;
					}
				}
				else{
					$flag = true;
				}
			}
		return $flag;
	}
}
?>
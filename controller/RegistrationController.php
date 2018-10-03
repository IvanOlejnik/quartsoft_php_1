<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/models/usersClass.php';
//класс обработки формы регистрации
class Registration{
	public $errors= array();
	private $NEW_POST = array();
	public $errorFlag; 
	public $user;
	private $password;
	private $passwordPovtor;
	private $email;

	//конструктор принимает данные из формы регистрации
	function __construct($NEW_POST){
		$this->errorFlag = false;
		$this->user = $NEW_POST["user"];	
		$this->password = $NEW_POST["password"];	
		$this->passwordPovtor = $NEW_POST["passwordPovtor"];	
		$this->email = $NEW_POST["email"];
	}
		//метод обработки данных формы, содержащий приватные методы для обработки определенных полей, возвращает массив ошибок
		public function fieldValidator(){ 
				$this->validateTextField($this->user);
				$this->passwordAuthentication($this->password,$this->passwordPovtor);
				$this->fieldEmail($this->email);
				if((!$this->errorFlag)){
					$usersClass = new Users();
					$this->errorFlag = $usersClass->serchField($this->NEW_POST["email"]);
					if($this->errorFlag){
						$usersClass->add($this->NEW_POST);
						$this->errorFlag = false;
					}else{
						$this->errors["email"] = "юзер с таким емайлом уже зарегестрировался</br>";
						$this->errorFlag = true;
					}
				}
	        	return $this->errors; 
		}

		//приватный метод проверки на пустоту поля логина, а также обрезка пробелов и удаление тэгов
		private function validateTextField($user){
			$user=trim($user); 
			if(empty($user)){ 
				$this->errors["user"] = "Missing required field user </br>"; 
				$this->errorFlag = true;
				return $this->errors;
			}
			else{
				$user=strip_tags($user);
				$this->NEW_POST["name"] = $user;
				return $this->NEW_POST["name"];
			}	
		}

		//приватный метод проверки на пустоту поля пароля и повтора пароля, а также обрезка пробелов и удаление тэгов. Данный метод проверяет правильность повтора пароля.
		private function passwordAuthentication($password,$passwordPovtor){
			$password=trim($password);
			$passwordPovtor=trim($passwordPovtor);
			if(!(empty($password) && empty($passwordPovtor))){ 
				if(!($password === $passwordPovtor)){
					$this->errors["password"] = "Passwords do not match!!"."</br>";
					$this->errorFlag = true;
					return $this->errors;
				}
				else{
					$password=strip_tags($password);
					$this->NEW_POST["password"] = md5($password);
					return $this->NEW_POST["password"];
					
				}
			}
			else{
				$this->errors["password"] = "Missing required field password </br>"; 
				$this->errorFlag = true;
				return $this->errors;
			}
		}
		//приватный метод проверки на пустоту поля и на правильность значения email, а также обрезка пробелов и удаление тэгов
		private function fieldEmail($email){
			$email=trim($email); 
			if(empty($email)){ 
				$this->errors["email"] = "Missing required field email </br>"; 
				$this->errorFlag = true;
				return $this->errors;
			}
			elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				$this->errors["email"] = "Incorrect Email </br>";
				$this->errorFlag = true;
				return $this->errors; 
			}
			else{
				$email=strip_tags($email);
				$this->NEW_POST["email"] = $email;
				return $this->NEW_POST["email"];
			}
		}
}
?>			

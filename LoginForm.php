<?php	
include_once $_SERVER['DOCUMENT_ROOT'].'/models/usersClass.php';
	class LoginForm
	{
	    public $email;
	    private $password;
		public $NEW_POST = array();
		public $errorFlag;
		public $errors = array();
 
	    //конструктор принимает данные из формы авторизации
	    function __construct($NEW_POST){
			$this->errorFlag = false;
			$this->email = $NEW_POST["email"];	
			$this->password = $NEW_POST["password"];
		}
		//публичный метод проверки логина и пароля пользователя, для авторизации
		public function fieldValidator(){ 
				$this->validateTextField($this->email);
				$this->password($this->password);
				if(!($this->errorFlag)){
					$usersClass = new Users();
					$this->errorFlag = $usersClass->matchPassword($this->NEW_POST["email"],$this->NEW_POST["password"]);
					if(!$this->errorFlag){
						$_SESSION['name'] = $this->NEW_POST["email"];
            			$_SESSION['password'] = $this->NEW_POST["password"];
					}else{
						$this->errors["email"] = "Неправильній логин или пароль</br>";
						$this->errorFlag = true;
						return $this->errors;
					}
				}
				else{return $this->errors;} 
		}

		//приватный метод проверки на пустоту поля логина, а также обрезка пробелов и удаление тэгов
		private function validateTextField($email){
			$email=trim($email); 
			if(empty($email)){ 
				$this->errors["email"] = "Missing required field email </br>"; 
				$this->errorFlag = true;
				return $this->errors;
			}
			else{
				$email=strip_tags($email);
				$this->NEW_POST["email"] = $email;
				return $this->NEW_POST["email"];
			}	
		}

		//приватный метод проверки на пустоту поля пароля, а также обрезка пробелов, удаление тэгов и хеширование пароля. 
		private function password($password){
			$password=trim($password);
			if(!(empty($password))){ 
					$password=strip_tags($password);
					$this->NEW_POST["password"] = md5($password);
					return $this->NEW_POST["password"];
			}
			else{
				$this->errors["password"] = "Missing required field password</br>"; 
				$this->errorFlag = true;
				return $this->errors;
			}
		}

	}
?>	
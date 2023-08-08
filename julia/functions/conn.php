<?php

class Database {
    public $con;
    public $error;
    public function __construct()
    {
        try {
            $this->con=new PDO("mysql:host=localhost;dbname=users","root","");
            $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e){
            echo 'Coś poszło nie tak'.$e->getMessage();
        }
    }
        public function required_validation($field)
        {
            $count = 0;
            foreach($field as $k => $v) {
                if(empty($v)) {
                    $count++;
                    $this->error .= " <p> Uzupełnij ".$k."</p>";
                }
                if($count == 0) {
                    return true;
                }
            }
        }

        public function can_login($table_name, $fields)
        {
            $login = $fields['username'];
            $password = $fields['password'];
            $password = sha1($password);
            $stmt = $this->con->prepare("SELECT * FROM $table_name WHERE uname=:uname AND password = :password");
            $stmt->bindParam(':uname', $login, PDO::PARAM_STR);
            $stmt->bindParam(':password', $password, PDO::PARAM_STR);
             $stmt->execute();
            if($stmt->rowCount() <= 0) {
                $this->error = 'Zły login lub hasło';
            } else {
                    return true;
            }
        }

        public function getUserByEmail($email)
        {
           $stmt = $this->con->prepare("SELECT * FROM users_table WHERE email=:email");
           $stmt -> bindParam(':email', $email, PDO::PARAM_STR);
           $stmt -> execute();
           if ($stmt ->rowCount() <= 0) {
               return true; 
           } else {
               return false;
           }
        }

        public function register($fields)
        {
            $email = $fields['email'];
            $uname = $fields['username'];
            $passwd = $fields['password'];
            $rpasswd = $fields['repassword'];
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $passwd = sha1($passwd);
                $rpasswd = sha1($rpasswd);
                if ($this -> getUserByEmail($email)) {
                    $stmt = $this->con->prepare("INSERT INTO users_table(uname,password,email,role) VALUES (:uname, :passwd, :email, 3)");
                    $stmt -> bindParam(':uname', $uname, PDO::PARAM_STR);
                    $stmt -> bindParam(':passwd', $passwd, PDO::PARAM_STR);
                    $stmt -> bindParam(':email', $email, PDO::PARAM_STR);
                    if ($passwd === $rpasswd) {
                        $stmt ->execute();
                        return true;
                    } else {
                        $this->error = 'Podane hasła nie są ze sobą zgodne!';
                    }
                } else {
                    $this->error = 'Taki użytkownik już istnieje!';
                }
            } else {
                $this->error = 'Podany email jest nieprawidłowy!';
            }
        }
        public function checkRole($login)
        {
            $stmt = $this->con->prepare("SELECT roles.name FROM roles JOIN users_table ON users_table.role = roles.id WHERE users_table.uname = :login");
            $stmt -> bindParam(':login', $login, PDO::PARAM_STR);
            $stmt ->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                switch($row['name']) {
                    case 'admin':
                        return $_SESSION['admin'] = 'admin';
                        break;
                    case 'editor':
                        return $_SESSION['editor'] = 'editor';
                        break;
                    case 'user':
                        return $_SESSION['user'] = 'user';
                        break;
                }
            }                
        }
        
}
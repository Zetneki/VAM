<?php

class LoginContr extends Login {

    private $email;
    private $pwd;


    public function __construct($email, $pwd) {
        $this->email = $email;
        $this->pwd = $pwd;
    }

    public function loginUser() {
        if ($this->emptyInput() == false) {
            echo "Üresen maradt!";
            header("location: ../homepg.php?error=emptyinput");
            exit();
        }
        
        $this->getUser($this->email, $this->pwd);
    }

    private function emptyInput() {
        if (empty($this->email || empty($this->fullname) || empty($this->pwd) || empty($this->pwdRepeat))) return false;
        return true;
    }
}

?>
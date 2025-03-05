<?php

class RegistrationContr extends Registration {

    private $email;
    private $fullname;
    private $pwd;
    private $pwdRepeat;

    public function __construct($email, $fullname, $pwd, $pwdRepeat) {
        $this->email = $email;
        $this->fullname = $fullname;
        $this->pwd = $pwd;
        $this->pwdRepeat = $pwdRepeat;
    }

    public function createUser() {
        if ($this->emptyInput() == false) {
            echo "Üresen maradt!";
            header("location: ../registration.php?error=emptyinput");
            exit();
        }
        if ($this->invalidEmail() == false) {
            echo "Nem megfelelő email!";
            header("location: ../registration.php?error=email");
            exit();
        }
        if ($this->invalidName() == false) {
            echo "Nem megfelelő név!";
            header("location: ../registration.php?error=name");
            exit();
        }
        if ($this->invalidPwd() == false) {
            echo "Nem megfelelő jelszó!";
            header("location: ../registration.php?error=password");
            exit();
        }
        if ($this->pwdMatch() == false) {
            echo "Nem egyeznek meg a jelszavak!";
            header("location: ../registration.php?error=passwordmatch");
            exit();
        }
        if ($this->emailTakenCheck() == false) {
            echo "Az email már foglalt!";
            header("location: ../registration.php?error=emailtaken");
            exit();
        }

        $this->setUser($this->email, $this->fullname, $this->pwd);
    }

    private function emptyInput() {
        if (empty($this->email || empty($this->fullname) || empty($this->pwd) || empty($this->pwdRepeat))) return false;
        return true;
    }

    private function invalidEmail() {
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) return false;
        return true;
    }

    private function invalidName() {
        $regex = "/^[A-Za-záéíóöőúüűÁÉÍÓÖŐÚÜŰ]+(?: [A-Za-záéíóöőúüűÁÉÍÓÖŐÚÜŰ]+)*$/";
        if (!preg_match($regex, $this->fullname)) return false;
        return true;
    }

    private function invalidPwd() {
        if (strlen($this->pwd) < 8 || !preg_match('/[A-Z]/', $this->pwd) || !preg_match('/[a-z]/', $this->pwd) || !preg_match('/[0-9]/', $this->pwd)) return false;
        return true;
    }

    private function pwdMatch() {
        if ($this->pwd !== $this->pwdRepeat) return false;
        return true;
    }

    private function emailTakenCheck() {
        if (!$this->checkUser($this->email)) return false;
        return true;
    }

}

?>
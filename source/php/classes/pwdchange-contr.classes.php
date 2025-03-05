<?php

class NewPwdContr extends NewPwd {

    private $currentPwd;
    private $newPwd1;
    private $newPwd2;
    private $currentEmail;

    public function __construct($currentPwd, $newPwd1, $newPwd2, $currentEmail) {
        $this->currentPwd= $currentPwd;
        $this->newPwd1 = $newPwd1;
        $this->newPwd2 = $newPwd2;
        $this->currentEmail = $currentEmail;
    }

    public function changePassword() {
        if ($this->emptyInput() == false) {
            echo "Üresen maradt!";
            header("location: ../profile.php?error=emptyinput");
            exit();
        }
        if ($this->correctPwd() == false) {
            echo "Nem jól adtad meg a jelszavad!";
            header("location: ../profile.php?error=incorrectpwd");
            exit();
        }
        if ($this->invalidPwd() == false) {
            echo "Nem megfelelő jelszó!";
            header("location: ../profile.php?error=invalidpwd");
            exit();
        }
        if ($this->pwdMatch() == false) {
            echo "Nem egyeznek meg a jelszavak!";
            header("location: ../profile.php?error=passwordmatch");
            exit();
        }

        $this->setPassword($this->newPwd1, $this->currentEmail);
    }

    private function emptyInput() {
        if (empty($this->currentPwd) || empty($this->newPwd1) || empty($this->newPwd2)) return false;
        return true;
    }

    private function correctPwd() {
        $stmt = $this->connect()->prepare('SELECT jelszo FROM felhasznalo WHERE email = ?;');
        $stmt->execute(array($this->currentEmail));
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!password_verify($this->currentPwd, $result["jelszo"])) return false;
        return true;
    }

    private function invalidPwd() {
        if (strlen($this->newPwd1) < 8 || !preg_match('/[A-Z]/', $this->newPwd1) || !preg_match('/[a-z]/', $this->newPwd1) || !preg_match('/[0-9]/', $this->newPwd1)) return false;
        return true;
    }

    private function pwdMatch() {
        if ($this->newPwd1 !== $this->newPwd2) return false;
        return true;
    }

}

?>



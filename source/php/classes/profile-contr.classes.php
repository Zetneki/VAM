<?php

class ProfileContr extends Profile {

    private $newEmail;
    private $newFullname;
    private $currentEmail;

    public function __construct($newEmail, $newFullname, $currentEmail) {
        $this->newEmail= $newEmail;
        $this->newFullname = $newFullname;
        $this->currentEmail = $currentEmail;
    }

    public function changeProfile() {
        if ($this->emptyInput() == false) {
            echo "Üresen maradt!";
            header("location: ../profile.php?error=emptyinput");
            exit();
        }
        if ($this->invalidEmail() == false) {
            echo "Nem megfelelő email!";
            header("location: ../profile.php?error=email");
            exit();
        }
        if ($this->invalidName() == false) {
            echo "Nem megfelelő név!";
            header("location: ../profile.php?error=name");
            exit();
        }

        $this->setProfile($this->newEmail, $this->newFullname, $this->currentEmail);
    }

    private function emptyInput() {
        if (empty($this->newEmail) && empty($this->newFullname)) return false;
        return true;
    }

    private function invalidEmail() {
        if (empty($this->newEmail)) return true;
        elseif (!filter_var($this->newEmail, FILTER_VALIDATE_EMAIL)) return false;
        return true;
    }

    private function invalidName() {
        if (empty(trim($this->newFullname))) return true;
        $regex = "/^[A-Za-záéíóöőúüűÁÉÍÓÖŐÚÜŰ]+(?: [A-Za-záéíóöőúüűÁÉÍÓÖŐÚÜŰ]+)*$/";
        if (!preg_match($regex, $this->newFullname)) return false;
        return true;
    }


}

?>



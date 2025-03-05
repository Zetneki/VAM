<?php

class NewPwd extends Dbh {
    
    protected function setPassword($newPwd1, $currentEmail) {

        $hashedPwd1 = password_hash($newPwd1, PASSWORD_DEFAULT);

        $stmt = $this->connect()->prepare('UPDATE felhasznalo SET jelszo = ? WHERE email = ?;');
        if (!$stmt->execute(array($hashedPwd1, $currentEmail))) {
            $stmt = null;
            header("location: ../profile.php?error=stmtfailed");
            exit();
        }   

        $stmt = null;
    }

}

?>
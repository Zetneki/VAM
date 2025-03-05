<?php

class Registration extends Dbh {

    protected function setUser($email, $fullname, $pwd) {
        $stmt = $this->connect()->prepare('INSERT INTO felhasznalo (email, nev, jelszo, milyen_szid) VALUES (?, ?, ?, ?);');
        
        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

        if (!$stmt->execute(array($email, $fullname, $hashedPwd, 1))) {
            $stmt = null;
            header("location: ../registration.php?error=stmtfailed");
            exit();
        } 

        $stmt = null;
    }

    protected function checkUser($email) {
        $stmt = $this->connect()->prepare('SELECT email FROM felhasznalo WHERE email = ?;');
    
        if (!$stmt->execute(array($email))) {
            $stmt = null;
            header("location: ../registration.php?error=stmtfailed");
            exit();
        } 

        if ($stmt->rowCount() > 0) return false;
        else return true;
    }

}

?>
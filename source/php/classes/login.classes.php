<?php

class Login extends Dbh {

    protected function getUser($email, $pwd) {
        $stmt = $this->connect()->prepare('SELECT * FROM felhasznalo WHERE email = ?;');

        if (!$stmt->execute(array($email))) {
            $stmt = null;
            header("location: ../homepg.php?error=stmtfailed");
            exit();
        } 

        if ($stmt->rowCount() == 0) {
            $stmt = null;
            header("location: ../homepg.php?error=usernotfound");
            exit();
        }

        $pwdHashed = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $checkPwd = password_verify($pwd, $pwdHashed[0]["jelszo"]);

        if ($checkPwd == false) {
            $stmt = null;
            header("location: ../homepg.php?error=wrongpassword");
            exit();
        }
        elseif ($checkPwd == true) {
            $stmt = $this->connect()->prepare('SELECT * FROM felhasznalo WHERE email = ? AND jelszo = ?;');

            if (!$stmt->execute(array($email, $pwdHashed[0]["jelszo"]))) {
                $stmt = null;
                header("location: ../homepg.php?error=stmtfailed");
                exit();
            } 

            if ($stmt->rowCount() == 0) {
                $stmt = null;
                header("location: ../homepg.php?error=usernotfound");
                exit();
            }

            $user = $stmt->fetchAll(PDO::FETCH_ASSOC);

            session_start();
            $_SESSION["email"] = $user[0]["email"];
            $_SESSION["nev"] = $user[0]["nev"];
            $_SESSION['busz'] = "";
            $_SESSION['vonat'] = "";
            $_SESSION['repulo'] = "";
            $_SESSION['start'] = null;
            $_SESSION['end'] = null;

            $stmt = $this->connect()->prepare("SELECT milyen_szid FROM felhasznalo WHERE email = ?");
            $stmt->execute([$email]);
            $szerep = $stmt->fetchColumn();

            $_SESSION['szerep'] = $szerep;
        }

        $stmt = null;
    }

}

?>
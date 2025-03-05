<?php

class Profile extends Dbh {
    
    protected function setProfile($newEmail, $newFullname, $currentEmail) {
        
        if(empty($newEmail)) {

            $stmt = $this->connect()->prepare('UPDATE felhasznalo SET nev = ? WHERE email = ?;');
            if (!$stmt->execute(array($newFullname, $currentEmail))) {
                $stmt = null;
                header("location: ../profile.php?error=stmtfailed");
                exit();
            }
            $_SESSION["nev"] = $newFullname;
        }
        elseif(empty(trim($newFullname))) {

            $stmt = $this->connect()->prepare('UPDATE felhasznalo SET email = ? WHERE email = ?;');
            if (!$stmt->execute(array($newEmail, $currentEmail))) {
                $stmt = null;
                header("location: ../profile.php?error=stmtfailed");
                exit();
            }
            $_SESSION["email"] = $newEmail;
        }
        else { 

            $stmt = $this->connect()->prepare('UPDATE felhasznalo SET email = ?, nev = ? WHERE email = ?;');
            if (!$stmt->execute(array($newEmail, $newFullname, $currentEmail))) {
                $stmt = null;
                header("location: ../profile.php?error=stmtfailed");
                exit();
            } 
            $_SESSION["email"] = $newEmail;
            $_SESSION["nev"] = $newFullname;
        }

        $stmt = null;
    }

    public function getAllBoughtTickets() {

        $email = $_SESSION['email'];
        $sql = "SELECT 
                v.vid AS vasarolt_id,
                v.tulajdonos_email AS tulajdonos,
                ja.tipus AS jarat_tipus, 
                a1.nev AS indulo_allomas,
                a1.varos AS indulo_varos,
                a2.nev AS cel_allomas,
                a2.varos AS cel_varos,
                ja.datum AS indulasi_datum,
                ja.idopont AS indulasi_ido,
                jegy.ar AS jegyar,
                v.darab AS vasarolt_darab
                FROM 
                    VasaroltJegyek v
                JOIN 
                    Jarat ja ON v.melyik_jaid = ja.jaid
                JOIN 
                    Allomas a1 ON ja.indulo_aid = a1.aid
                JOIN 
                    Allomas a2 ON ja.cel_aid = a2.aid
                JOIN 
                    Jegy jegy ON jegy.melyik_jaid = ja.jaid
                WHERE 
                    v.tulajdonos_email = ?;";
        $stmt = $this->connect()->prepare($sql); 
        if (!$stmt->execute([$email])) {
            $stmt = null;
            header("location: ../profile.php?error=stmtfailed");
            exit();
        } 

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProfitByUser() {
        $sql = "SELECT 
                v.tulajdonos_email AS felhasznalo,
                COUNT(v.vid) AS osszes_vasarolas, -- Összes vásárlás tranzakció
                SUM(v.darab) AS osszes_jegydarab, -- Összes vásárolt jegy darabszám
                SUM(v.darab * jegy.ar) AS osszes_koltseg -- Vásárolt jegyek összesített költsége
                FROM 
                    VasaroltJegyek v
                JOIN 
                    Jegy jegy ON v.melyik_jaid = jegy.melyik_jaid
                GROUP BY 
                    v.tulajdonos_email;";

        $stmt = $this->connect()->prepare($sql); 
        if (!$stmt->execute()) {
            $stmt = null;
            header("location: ../profile.php?error=stmtfailed");
            exit();
        } 

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProfitByCity() {
        $sql = "SELECT 
                a.varos AS indulo_varos,
                COUNT(vj.vid) AS osszes_vasarolt_jegy,
                SUM(je.ar * vj.darab) AS osszes_bevetel
                FROM 
                    VasaroltJegyek vj
                JOIN 
                    Jarat j ON vj.melyik_jaid = j.jaid
                JOIN 
                    Allomas a ON j.indulo_aid = a.aid
                JOIN 
                    Jegy je ON je.melyik_jaid = j.jaid
                GROUP BY 
                    a.varos
                ORDER BY 
                    osszes_bevetel DESC;";

        $stmt = $this->connect()->prepare($sql); 
        if (!$stmt->execute()) {
            $stmt = null;
            header("location: ../profile.php?error=stmtfailed");
            exit();
        } 

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProfitByType() {
        $sql = "SELECT 
                j.tipus AS jarmutipus,
                SUM(je.elerhetodb) AS osszes_elerhetojegy,
                (
                    SELECT 
                        SUM(vj.darab)
                    FROM 
                        VasaroltJegyek vj
                    JOIN 
                        Jarat j2 ON vj.melyik_jaid = j2.jaid
                    WHERE 
                        j2.tipus = j.tipus
                ) AS osszes_eladottjegy
                FROM 
                    Jarat j
                JOIN 
                    Jegy je ON j.jaid = je.melyik_jaid
                GROUP BY 
                    j.tipus;";
        
        $stmt = $this->connect()->prepare($sql); 
        if (!$stmt->execute()) {
            $stmt = null;
            header("location: ../profile.php?error=stmtfailed");
            exit();
        } 

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>
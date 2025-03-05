<?php

class Admin extends Dbh {

    protected function setTicket(
        $indulasi_allomas,
        $indulasi_varos,
        $cel_allomas,
        $cel_varos,
        $jarat_datum,
        $jarat_idopont,
        $jarat_tipus,
        $ar,
        $elerhetoseg
    ) {
        try {
            // Adatbázis kapcsolat kezdése
            $db = $this->connect();
            $db->beginTransaction();
    
            // 1. Beszúrás az indulási állomásba
            $stmt = $db->prepare('INSERT INTO Allomas (nev, varos) VALUES (?, ?) ON DUPLICATE KEY UPDATE aid = LAST_INSERT_ID(aid);');
            $stmt->execute(array($indulasi_allomas, $indulasi_varos));
            $indulo_aid = $db->lastInsertId();
    
            // 2. Beszúrás a célállomásba
            $stmt = $db->prepare('INSERT INTO Allomas (nev, varos) VALUES (?, ?) ON DUPLICATE KEY UPDATE aid = LAST_INSERT_ID(aid);');                   
            $stmt->execute(array($cel_allomas, $cel_varos));
            $cel_aid = $db->lastInsertId();
    
            // 3. Beszúrás a Járat táblába
            $stmt = $db->prepare('INSERT INTO Jarat (tipus, indulo_aid, cel_aid, datum, idopont) VALUES (?, ?, ?, ?, ?);');
            $stmt->execute(array($jarat_tipus, $indulo_aid, $cel_aid, $jarat_datum, $jarat_idopont));
            $jarat_id = $db->lastInsertId();
    
            // 4. Beszúrás a Jegy táblába
            $stmt = $db->prepare('INSERT INTO Jegy (melyik_jaid, ar, elerhetodb) VALUES (?, ?, ?);');
            $stmt->execute(array($jarat_id, $ar, $elerhetoseg));
    
            // Tranzakció véglegesítése
            $db->commit();
        } catch (PDOException $e) {
            // Hibakezelés és visszagörgetés
            $db->rollBack();
            header("location: ../admin.php?error=stmtfailed&message=" . urlencode($e->getMessage()));
            exit();
        }
    }

    protected function checkTicket(
        $indulasi_allomas, 
        $indulasi_varos, 
        $cel_allomas, 
        $cel_varos, 
        $jarat_datum, 
        $jarat_idopont, 
        $jarat_tipus, 
        $ar,
        $elerhetoseg
    ) {
        $stmt = $this->connect()->prepare('SELECT Jarat.jaid, Jegy.jeid, Jegy.elerhetodb 
            FROM Jarat
            JOIN Allomas AS InduloAllomas ON Jarat.indulo_aid = InduloAllomas.aid
            JOIN Allomas AS CelAllomas ON Jarat.cel_aid = CelAllomas.aid
            JOIN Jegy ON Jarat.jaid = Jegy.melyik_jaid
            WHERE 
                InduloAllomas.nev = ? AND 
                InduloAllomas.varos = ? AND
                CelAllomas.nev = ? AND 
                CelAllomas.varos = ? AND
                Jarat.datum = ? AND
                Jarat.idopont = ? AND
                Jarat.tipus = ? AND
                Jegy.ar = ?
        ');
    
        if (!$stmt->execute(array(
            $indulasi_allomas, 
            $indulasi_varos, 
            $cel_allomas, 
            $cel_varos, 
            $jarat_datum, 
            $jarat_idopont, 
            $jarat_tipus,
            $ar 
            ))) {
            $stmt = null;
            header("location: ../admin.php?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row['elerhetodb'] == -1) {
                // Ha a jegy törölt, újraaktiváljuk
                $this->activateTicket($row['jeid'], $elerhetoseg);
                $stmt = null;
                header("location: ../admin.php?error=none");
                exit();
            }
            return false; // Már létezik aktív jegy
        }
    
        return true; // Nincs ilyen járat és ár, jegy hozzáadható
    }

    protected function activateTicket($jeid, $elerhetoseg) {
        $stmt = $this->connect()->prepare('UPDATE Jegy SET elerhetodb = ? WHERE jeid = ?');
        if (!$stmt->execute(array($elerhetoseg, $jeid))) {
            $stmt = null;
            header("location: ../admin.php?error=stmtfailed");
            exit();
        }
    }

    protected function prepareTicket(
        $jegy_id,
        $indulasi_allomas,
        $indulasi_varos,
        $cel_allomas,
        $cel_varos,
        $jarat_datum,
        $jarat_idopont,
        $jarat_tipus,
        $ar,
        $elerhetoseg
    ) {

        try {
            // Adatbázis kapcsolat kezdése
            $db = $this->connect();
            $db->beginTransaction();
    
            // 1. Indulási állomás frissítése vagy beszúrása
            $stmt = $db->prepare('INSERT INTO Allomas (nev, varos) VALUES (?, ?) ON DUPLICATE KEY UPDATE aid=LAST_INSERT_ID(aid);');
            $stmt->execute(array($indulasi_allomas, $indulasi_varos));
            $indulo_aid = $db->lastInsertId();
    
            // 2. Célállomás frissítése vagy beszúrása
            $stmt = $db->prepare('INSERT INTO Allomas (nev, varos) VALUES (?, ?) ON DUPLICATE KEY UPDATE aid=LAST_INSERT_ID(aid);');
            $stmt->execute(array($cel_allomas, $cel_varos));
            $cel_aid = $db->lastInsertId();
    
            // 3. Járat frissítése
            $stmt = $db->prepare('UPDATE Jarat 
                SET tipus = ?, indulo_aid = ?, cel_aid = ?, datum = ?, idopont = ?
                WHERE jaid = (SELECT melyik_jaid FROM Jegy WHERE jeid = ?);
            ');
            $stmt->execute(array($jarat_tipus, $indulo_aid, $cel_aid, $jarat_datum, $jarat_idopont, $jegy_id));
    
            // 4. Jegy frissítése
            $stmt = $db->prepare('UPDATE Jegy 
                SET ar = ?, elerhetodb = ?
                WHERE jeid = ?;
            ');
            $stmt->execute(array($ar, $elerhetoseg, $jegy_id));
    
            // Tranzakció véglegesítése
            $db->commit();
        } catch (PDOException $e) {
            // Hibakezelés és visszagörgetés
            $db->rollBack();
            header("location: ../admin.php?error=stmtfailed&message=" . $e->getMessage());
            exit();
        }
    }
}

?>
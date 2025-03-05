<?php

class OrderTicket extends Dbh {
    
    public function getAllTickets() {
        $stmt = null;
        //azert kell ha nem vagyunk bejelentkezve akkor ne kerdezzen le nem letezo valtozot
        if (isset($_SESSION['email'])) {
            if ($_SESSION['busz'] == "busz") {
                $sql = "SELECT 
                    Jegy.jeid AS jegy_id,
                    Jegy.ar AS ar,
                    Jegy.elerhetodb AS elerhetoseg,
                    Jarat.jaid AS jarat_id,
                    Jarat.tipus AS jarat_tipus,
                    Jarat.datum AS jarat_datum,
                    Jarat.idopont AS jarat_idopont,
                    InduloAllomas.nev AS indulasi_allomas,
                    InduloAllomas.varos AS indulasi_varos,
                    CelAllomas.nev AS cel_allomas,
                    CelAllomas.varos AS cel_varos
                    FROM Jegy
                    JOIN Jarat ON Jegy.melyik_jaid = Jarat.jaid
                    JOIN Allomas AS InduloAllomas ON Jarat.indulo_aid = InduloAllomas.aid
                    JOIN Allomas AS CelAllomas ON Jarat.cel_aid = CelAllomas.aid
                    WHERE Jarat.tipus = ?";
                $stmt = $this->connect()->prepare($sql);
                if (!$stmt->execute(array($_SESSION['busz']))) {
                    $stmt = null;
                    header("location: orderticket.php?error=stmtfailed");
                    exit();
                } 
            } else if ($_SESSION['vonat'] == "vonat") {
                $sql = "SELECT 
                    Jegy.jeid AS jegy_id,
                    Jegy.ar AS ar,
                    Jegy.elerhetodb AS elerhetoseg,
                    Jarat.jaid AS jarat_id,
                    Jarat.tipus AS jarat_tipus,
                    Jarat.datum AS jarat_datum,
                    Jarat.idopont AS jarat_idopont,
                    InduloAllomas.nev AS indulasi_allomas,
                    InduloAllomas.varos AS indulasi_varos,
                    CelAllomas.nev AS cel_allomas,
                    CelAllomas.varos AS cel_varos
                    FROM Jegy
                    JOIN Jarat ON Jegy.melyik_jaid = Jarat.jaid
                    JOIN Allomas AS InduloAllomas ON Jarat.indulo_aid = InduloAllomas.aid
                    JOIN Allomas AS CelAllomas ON Jarat.cel_aid = CelAllomas.aid
                    WHERE Jarat.tipus = ?";
                $stmt = $this->connect()->prepare($sql);
                if (!$stmt->execute(array($_SESSION['vonat']))) {
                    $stmt = null;
                    header("location: orderticket.php?error=stmtfailed");
                    exit();
                } 
            } else if ($_SESSION['repulo'] == "repülő") {
                $sql = "SELECT 
                    Jegy.jeid AS jegy_id,
                    Jegy.ar AS ar,
                    Jegy.elerhetodb AS elerhetoseg,
                    Jarat.jaid AS jarat_id,
                    Jarat.tipus AS jarat_tipus,
                    Jarat.datum AS jarat_datum,
                    Jarat.idopont AS jarat_idopont,
                    InduloAllomas.nev AS indulasi_allomas,
                    InduloAllomas.varos AS indulasi_varos,
                    CelAllomas.nev AS cel_allomas,
                    CelAllomas.varos AS cel_varos
                    FROM Jegy
                    JOIN Jarat ON Jegy.melyik_jaid = Jarat.jaid
                    JOIN Allomas AS InduloAllomas ON Jarat.indulo_aid = InduloAllomas.aid
                    JOIN Allomas AS CelAllomas ON Jarat.cel_aid = CelAllomas.aid
                    WHERE Jarat.tipus = ?";
                $stmt = $this->connect()->prepare($sql);
                if (!$stmt->execute(array($_SESSION['repulo']))) {
                    $stmt = null;
                    header("location: orderticket.php?error=stmtfailed");
                    exit();
                } 
            } else {

                $sql = "SELECT 
                        Jegy.jeid AS jegy_id,
                        Jegy.ar AS ar,
                        Jegy.elerhetodb AS elerhetoseg,
                        Jarat.jaid AS jarat_id,
                        Jarat.tipus AS jarat_tipus,
                        Jarat.datum AS jarat_datum,
                        Jarat.idopont AS jarat_idopont,
                        InduloAllomas.nev AS indulasi_allomas,
                        InduloAllomas.varos AS indulasi_varos,
                        CelAllomas.nev AS cel_allomas,
                        CelAllomas.varos AS cel_varos
                        FROM Jegy
                        JOIN Jarat ON Jegy.melyik_jaid = Jarat.jaid
                        JOIN Allomas AS InduloAllomas ON Jarat.indulo_aid = InduloAllomas.aid
                        JOIN Allomas AS CelAllomas ON Jarat.cel_aid = CelAllomas.aid";
                $stmt = $this->connect()->prepare($sql);

                if (!$stmt->execute()) {
                    $stmt = null;
                    header("location: orderticket.php?error=stmtfailed");
                    exit();
                } 
            }
        } else {
            $sql = "SELECT 
            Jegy.jeid AS jegy_id,
            Jegy.ar AS ar,
            Jegy.elerhetodb AS elerhetoseg,
            Jarat.jaid AS jarat_id,
            Jarat.tipus AS jarat_tipus,
            Jarat.datum AS jarat_datum,
            Jarat.idopont AS jarat_idopont,
            InduloAllomas.nev AS indulasi_allomas,
            InduloAllomas.varos AS indulasi_varos,
            CelAllomas.nev AS cel_allomas,
            CelAllomas.varos AS cel_varos
            FROM Jegy
            JOIN Jarat ON Jegy.melyik_jaid = Jarat.jaid
            JOIN Allomas AS InduloAllomas ON Jarat.indulo_aid = InduloAllomas.aid
            JOIN Allomas AS CelAllomas ON Jarat.cel_aid = CelAllomas.aid";
            $stmt = $this->connect()->prepare($sql);

            if (!$stmt->execute()) {
                $stmt = null;
                header("location: orderticket.php?error=stmtfailed");
                exit();
            } 
        }

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function Search() {
        //metaphone()
        if (empty($_SESSION['end'])) {

            $sql = "SELECT 
            Jegy.jeid AS jegy_id,
            Jegy.ar AS ar,
            Jegy.elerhetodb AS elerhetoseg,
            Jarat.jaid AS jarat_id,
            Jarat.tipus AS jarat_tipus,
            Jarat.datum AS jarat_datum,
            Jarat.idopont AS jarat_idopont,
            InduloAllomas.nev AS indulasi_allomas,
            InduloAllomas.varos AS indulasi_varos,
            CelAllomas.nev AS cel_allomas,
            CelAllomas.varos AS cel_varos
            FROM 
                Jarat
            JOIN 
                Allomas AS InduloAllomas ON Jarat.indulo_aid = InduloAllomas.aid
            JOIN 
                Allomas AS CelAllomas ON Jarat.cel_aid = CelAllomas.aid
            JOIN 
                Jegy ON Jegy.melyik_jaid = Jarat.jaid
            WHERE 
                (LOWER(InduloAllomas.nev) LIKE LOWER(CONCAT('%', ?, '%')) OR LOWER(InduloAllomas.varos) LIKE LOWER(CONCAT('%', ?, '%')))";

            $stmt = $this->connect()->prepare($sql);
            if (!$stmt->execute(array($_SESSION['start'], $_SESSION['start']))) {
                $stmt = null;
                header("location: orderticket.php?error=stmtfailed");
                exit();
            }
            
        } elseif (empty($_SESSION['start'])) {

            $sql = "SELECT 
            Jegy.jeid AS jegy_id,
            Jegy.ar AS ar,
            Jegy.elerhetodb AS elerhetoseg,
            Jarat.jaid AS jarat_id,
            Jarat.tipus AS jarat_tipus,
            Jarat.datum AS jarat_datum,
            Jarat.idopont AS jarat_idopont,
            InduloAllomas.nev AS indulasi_allomas,
            InduloAllomas.varos AS indulasi_varos,
            CelAllomas.nev AS cel_allomas,
            CelAllomas.varos AS cel_varos
            FROM 
                Jarat
            JOIN 
                Allomas AS InduloAllomas ON Jarat.indulo_aid = InduloAllomas.aid
            JOIN 
                Allomas AS CelAllomas ON Jarat.cel_aid = CelAllomas.aid
            JOIN 
                Jegy ON Jegy.melyik_jaid = Jarat.jaid
            WHERE 
                (LOWER(CelAllomas.nev) LIKE LOWER(CONCAT('%', ?, '%')) OR LOWER(CelAllomas.varos) LIKE LOWER(CONCAT('%', ?, '%')))";

            $stmt = $this->connect()->prepare($sql);
            if (!$stmt->execute(array($_SESSION['end'], $_SESSION['end']))) {
                $stmt = null;
                header("location: orderticket.php?error=stmtfailed");
                exit();
            }
            
        } else {

            $sql = "SELECT 
            Jegy.jeid AS jegy_id,
            Jegy.ar AS ar,
            Jegy.elerhetodb AS elerhetoseg,
            Jarat.jaid AS jarat_id,
            Jarat.tipus AS jarat_tipus,
            Jarat.datum AS jarat_datum,
            Jarat.idopont AS jarat_idopont,
            InduloAllomas.nev AS indulasi_allomas,
            InduloAllomas.varos AS indulasi_varos,
            CelAllomas.nev AS cel_allomas,
            CelAllomas.varos AS cel_varos
            FROM 
                Jarat
            JOIN 
                Allomas AS InduloAllomas ON Jarat.indulo_aid = InduloAllomas.aid
            JOIN 
                Allomas AS CelAllomas ON Jarat.cel_aid = CelAllomas.aid
            JOIN 
                Jegy ON Jegy.melyik_jaid = Jarat.jaid
            WHERE 
                (LOWER(InduloAllomas.nev) LIKE LOWER(CONCAT('%', ?, '%')) OR LOWER(InduloAllomas.varos) LIKE LOWER(CONCAT('%', ?, '%')))
            AND 
                (LOWER(CelAllomas.nev) LIKE LOWER(CONCAT('%', ?, '%')) OR LOWER(CelAllomas.varos) LIKE LOWER(CONCAT('%', ?, '%')))";

            $stmt = $this->connect()->prepare($sql);
            if (!$stmt->execute(array($_SESSION['start'], $_SESSION['start'], $_SESSION['end'], $_SESSION['end']))) {
                $stmt = null;
                header("location: orderticket.php?error=stmtfailed");
                exit();
            }
            
        }

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addToCart($email, $id, $mennyi) {
        //db levonas
        $darab = "SELECT elerhetodb FROM jegy WHERE melyik_jaid = ?";
        $stmt = $this->connect()->prepare($darab);
        $stmt->execute([$id]);
        $most = $stmt->fetchColumn();

        //elfogyott
        if ($most == 0) {
            $stmt = null;
            header("location: orderticket.php?error=ticketsoldout");
            exit();
        }

        $ertek = $most - $mennyi;
        if ($ertek < 0) $ertek = 0;

        $uj = "UPDATE jegy SET elerhetodb = ? WHERE melyik_jaid = ?";
        $stmt = $this->connect()->prepare($uj);
        if (!$stmt->execute(array($ertek, $id))) {
            $stmt = null;
            header("location: orderticket.php?error=stmtfailed");
            exit();
        }
        $stmt = null;

        //vasaroltjegyekhez hozzaadas ha meg nem adott hozza es ha mar hozzaadott
        $test = "SELECT vid FROM vasaroltjegyek WHERE melyik_jaid = ? AND tulajdonos_email = ?";
        $stmt = $this->connect()->prepare($test);
        $stmt->execute([$id, $email]);
        $check = $stmt->fetchColumn();

        if (!$check) {
            // Hívja a jegy hozzáadását
            $sql = "INSERT INTO vasaroltjegyek (tulajdonos_email, melyik_jaid, darab) VALUES (?, ?, ?)";
            $stmt = $this->connect()->prepare($sql);

            if (!$stmt->execute(array($email, $id, $mennyi))) {
                $stmt = null;
                header("location: orderticket.php?error=stmtfailed");
                exit();
            } 
            $stmt = null;
        } else {
            $sql = "SELECT darab FROM vasaroltjegyek WHERE melyik_jaid = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$id]);
            $current_darab = $stmt->fetchColumn();

            $new_darab = $current_darab + $mennyi;
            $sql = "UPDATE vasaroltjegyek SET darab = ? WHERE melyik_jaid = ? AND tulajdonos_email = ?";
            $stmt = $this->connect()->prepare($sql);
            if (!$stmt->execute(array($new_darab, $id, $email))) {
                $stmt = null;
                header("location: orderticket.php?error=stmtfailed");
                exit();
            }
            $stmt = null;
        }
    }
}
?>

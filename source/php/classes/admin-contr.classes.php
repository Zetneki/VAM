<?php

class AdminContr extends Admin {

    private $jegy_id;
    private $indulasi_allomas;
    private $indulasi_varos;
    private $cel_allomas;
    private $cel_varos;
    private $jarat_datum;
    private $jarat_idopont;
    private $jarat_tipus;
    private $ar;
    private $elerhetoseg;

    public function __construct(
        $jegy_id,
        $indulasi_allomas,
        $indulasi_varos,
        $cel_allomas,
        $cel_varos,
        $jarat_datum,
        $jarat_idopont,
        $jarat_tipus,
        $ar,
        $elerhetoseg) {
            $this->jegy_id = $jegy_id;
            $this->indulasi_allomas = $indulasi_allomas;
            $this->indulasi_varos = $indulasi_varos;
            $this->cel_allomas = $cel_allomas;
            $this->cel_varos = $cel_varos;
            $this->jarat_datum = $jarat_datum;
            $this->jarat_idopont = $jarat_idopont;
            $this->jarat_tipus = $jarat_tipus;
            $this->ar = $ar;
            $this->elerhetoseg = $elerhetoseg;
    }

    public function createTicket() {
        if ($this->emptyInput() == false) {
            echo "Üresen maradt!";
            header("location: ../admin.php?error=emptyinput");
            exit();
        }
        
        if ($this->invalidType() == false) {
            echo "Rossz típus!";
            header("location: ../admin.php?error=invalidtype");
            exit();
        }

        if ($this->checkTicket($this->indulasi_allomas, $this->indulasi_varos, $this->cel_allomas, $this->cel_varos, $this->jarat_datum, $this->jarat_idopont, $this->jarat_tipus, $this->ar, $this->elerhetoseg)) {
            $this->setTicket($this->indulasi_allomas, $this->indulasi_varos, $this->cel_allomas, $this->cel_varos, $this->jarat_datum, $this->jarat_idopont, $this->jarat_tipus, $this->ar, $this->elerhetoseg);
        } elseif (!$this->checkTicket($this->indulasi_allomas, $this->indulasi_varos, $this->cel_allomas, $this->cel_varos, $this->jarat_datum, $this->jarat_idopont, $this->jarat_tipus, $this->ar, $this->elerhetoseg)) {
            echo "A jegy már létezik!";
            header("location: ../admin.php?error=ticketexists");
            exit();  
        }       
    }

    public function updateTicket() {
        if ($this->emptyInput() == false) {
            echo "Üresen maradt!";
            header("location: ../orderticket.php?error=emptyinput");
            exit();
        }
        
        if ($this->invalidType() == false) {
            echo "Rossz típus!";
            header("location: ../orderticket.php?error=invalidtype");
            exit();
        }

        $this->prepareTicket($this->jegy_id, $this->indulasi_allomas, $this->indulasi_varos, $this->cel_allomas, $this->cel_varos, $this->jarat_datum, $this->jarat_idopont, $this->jarat_tipus, $this->ar, $this->elerhetoseg);
    }

    public function softDeleteTicket($jeid) {
        $stmt = $this->connect()->prepare('UPDATE Jegy SET elerhetodb = -1 WHERE jeid = ?');
    
        if (!$stmt->execute(array($jeid))) {
            $stmt = null;
            header("location: ../admin.php?error=stmtfailed");
            exit();
        }
    
        return true; // Sikeres frissítés
    }

    private function emptyInput() {
        if (empty($this->indulasi_allomas || empty($this->indulasi_varos) || empty($this->cel_allomas) || empty($this->cel_varos) || empty($this->jarat_datum) || empty($this->jarat_idopont) || empty($this->jarat_tipus) || empty($this->ar) || empty($this->elerhetoseg))) return false;
        return true;
    }

    private function invalidType() {
        $validTypes = ["vonat", "busz", "repülő"];
        if (!in_array($this->jarat_tipus, $validTypes)) {
            return false; // Érvénytelen típus
        }
        return true; // Érvényes típus
    }

}

?>
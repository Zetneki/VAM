<?php

if (isset($_POST["submit"])) {

    //grabbing the data

    $jegy_id = NULL;
    $indulasi_allomas = $_POST['indulasi_allomas'];
    $indulasi_varos = $_POST['indulasi_varos'];
    $cel_allomas = $_POST['cel_allomas'];
    $cel_varos = $_POST['cel_varos'];
    $jarat_datum = $_POST['jarat_datum'];
    $jarat_idopont = $_POST['jarat_idopont'];
    $jarat_tipus = $_POST['jarat_tipus'];
    $ar = $_POST['ar'];
    $elerhetoseg = $_POST['elerhetoseg'];

    //instantiate AdminContr class
    include '../classes/dbh.classes.php';
    include '../classes/admin.classes.php';
    include '../classes/admin-contr.classes.php';

    $admin = new AdminContr($jegy_id, $indulasi_allomas, $indulasi_varos, $cel_allomas, $cel_varos, $jarat_datum, $jarat_idopont, $jarat_tipus, $ar, $elerhetoseg);

    //run error handlers, user registration
    $admin->createTicket();
    
    //going back to front page
    header("location: ../admin.php?error=none");
}

if (isset($_POST["edit"])) {

    //grabbing the data

    $jegy_id = $_POST['jegy_id'];
    $indulasi_allomas = $_POST['indulasi_allomas'];
    $indulasi_varos = $_POST['indulasi_varos'];
    $cel_allomas = $_POST['cel_allomas'];
    $cel_varos = $_POST['cel_varos'];
    $jarat_datum = $_POST['jarat_datum'];
    $jarat_idopont = $_POST['jarat_idopont'];
    $jarat_tipus = $_POST['jarat_tipus'];
    $ar = $_POST['ar'];
    $elerhetoseg = $_POST['elerhetoseg'];

    //instantiate AdminContr class
    include '../classes/dbh.classes.php';
    include '../classes/admin.classes.php';
    include '../classes/admin-contr.classes.php';
    $admin = new AdminContr($jegy_id, $indulasi_allomas, $indulasi_varos, $cel_allomas, $cel_varos, $jarat_datum, $jarat_idopont, $jarat_tipus, $ar, $elerhetoseg);

    //run error handlers, user registration
    $admin->updateTicket();
    
    //going back to front page
    header("location: ../orderticket.php?error=none");
}

if (isset($_POST["delete"])) {

    //grabbing the data

    $jegy_id = $_POST['jegy_id'];
    $indulasi_allomas = $_POST['indulasi_allomas'];
    $indulasi_varos = $_POST['indulasi_varos'];
    $cel_allomas = $_POST['cel_allomas'];
    $cel_varos = $_POST['cel_varos'];
    $jarat_datum = $_POST['jarat_datum'];
    $jarat_idopont = $_POST['jarat_idopont'];
    $jarat_tipus = $_POST['jarat_tipus'];
    $ar = $_POST['ar'];
    $elerhetoseg = $_POST['elerhetoseg'];

    //instantiate AdminContr class
    include '../classes/dbh.classes.php';
    include '../classes/admin.classes.php';
    include '../classes/admin-contr.classes.php';
    $admin = new AdminContr($jegy_id, $indulasi_allomas, $indulasi_varos, $cel_allomas, $cel_varos, $jarat_datum, $jarat_idopont, $jarat_tipus, $ar, $elerhetoseg);

    //run error handlers, user registration
    $admin->softDeleteTicket($jegy_id);
    
    //going back to front page
    header("location: ../orderticket.php?error=none");
}

?>
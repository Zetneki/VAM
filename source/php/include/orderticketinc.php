<?php
session_start();
include '../classes/dbh.classes.php';
include '../classes/orderticket.classes.php';

// Lekérjük az összes jegyet és elmentjük a session-be
$ticketOrder = new OrderTicket();

// Átirányítás vissza az orderticket.php oldalra
header("location: ../orderticket.php?error=none");

if (isset($_POST["search"])) {
    
    $_SESSION['start'] = $_POST['start'];
    $_SESSION['end'] = $_POST['end'];

    header("location: ../orderticket.php?error=none");
}

if (isset($_POST["submit"])) {

    $email = $_SESSION['email'];
    $id = $_POST['jaratid'];
    $mennyi = $_POST['quantity'];

    $ticketOrder->addToCart($email, $id, $mennyi);

    header("location: ../orderticket.php?error=none");
}

if (isset($_POST["busz"])) {

    $_SESSION['busz'] = "busz";
    $_SESSION['vonat'] = "";
    $_SESSION['repulo'] = "";

    header("location: ../orderticket.php?error=none");
}

if (isset($_POST["vonat"])) {

    $_SESSION['busz'] = "";
    $_SESSION['vonat'] = "vonat";
    $_SESSION['repulo'] = "";

    header("location: ../orderticket.php?error=none");
}

if (isset($_POST["repulo"])) {

    $_SESSION['busz'] = "";
    $_SESSION['vonat'] = "";
    $_SESSION['repulo'] = "repülő";

    header("location: ../orderticket.php?error=none");
}

if (isset($_POST["minden"])) {

    $_SESSION['busz'] = "";
    $_SESSION['vonat'] = "";
    $_SESSION['repulo'] = "";

    header("location: ../orderticket.php?error=none");
}
?>

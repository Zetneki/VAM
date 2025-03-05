<?php
session_start();

include '../classes/dbh.classes.php';
include '../classes/profile.classes.php';
include '../classes/profile-contr.classes.php';


// Átirányítás csak akkor történjen, amikor már beállítottuk a session-t
header("location: ../profile.php?error=none");

if (isset($_POST["editprof"])) {
    
    $newEmail = $_POST["newemail"];
    $newFullname = trim($_POST["newlname"]) . " " . trim($_POST["newfname"]);
    $currentEmail = $_SESSION["email"];

    $prof = new ProfileContr($newEmail, $newFullname, $currentEmail);
    $prof->changeProfile();

    header("location: ../profile.php?error=none");
}
?>
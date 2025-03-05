<?php
session_start();

if (isset($_POST["editpwd"])) {
    $currentPwd = $_POST["currentpwd"];
    $newPwd1 = $_POST["newpwd1"];
    $newPwd2 = $_POST["newpwd2"];
    $currentEmail = $_SESSION["email"];

    include '../classes/dbh.classes.php';
    include '../classes/pwdchange.classes.php';
    include '../classes/pwdchange-contr.classes.php';

    $pwd = new NewPwdContr($currentPwd, $newPwd1, $newPwd2, $currentEmail);

    $pwd->changePassword();

    header("location: ../profile.php?error=none");
}
?>
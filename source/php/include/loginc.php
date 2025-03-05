<?php

if (isset($_POST["submit"])) {

    //grabbing the data

    $email = $_POST["email"];
    $pwd = $_POST["pwd"];

    //instantiate LogContr class
    include '../classes/dbh.classes.php';
    include '../classes/login.classes.php';
    include '../classes/login-contr.classes.php';
    $login = new LoginContr($email, $pwd);

    //run error handlers, user login
    $login->loginUser();
    
    //going back to front page
    header("location: ../homepg.php?error=none");
}

?>


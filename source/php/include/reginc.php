<?php

if (isset($_POST["submit"])) {

    //grabbing the data

    $email = $_POST["email"];
    $fullname = trim($_POST["lname"]) . " " . trim($_POST["fname"]);
    $pwd = $_POST["pwd"];
    $pwdRepeat = $_POST["pwdrepeat"];

    //instantiate RegContr class
    include '../classes/dbh.classes.php';
    include '../classes/reg.classes.php';
    include '../classes/reg-contr.classes.php';
    $reg = new RegistrationContr($email, $fullname, $pwd, $pwdRepeat);

    //run error handlers, user registration
    $reg->createUser();
    
    //going back to front page
    header("location: ../homepg.php?error=none");
}


?>
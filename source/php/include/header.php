<?php session_start(); ?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VÁM</title>
    <link rel="stylesheet" href="../bootstrap-5.3.3-dist/css/bootstrap.css">
    <link rel="stylesheet" href="../css/homepg.css">
    <link rel="icon" type="image/x-icon" href="../img/bus.png">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <nav class="navbar navbar-expand-lg p-3 mb-2">
        <div class="container-fluid">
            <a class="navbar-brand text-white" href="homepg.php">VÁM</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                        <a class="nav-link active text-secondary-emphasis" aria-current="page" href="orderticket.php">Belföldi utazás</a>
                        </li>
                    
                <?php 
                    if (isset($_SESSION["email"])) 
                    { 
                        if ($_SESSION["szerep"] == 2)
                        {
                ?>
                        <li class="nav-item">
                        <a class="nav-link active text-secondary-emphasis" aria-current="page" href="admin.php">Admin</a>
                        </li>
                    </ul>
                <?php 
                    } else {
                ?>
                    </ul>        
                <?php 
                    }
                ?>
                    <a href="profile.php"><i class='bx bxs-user-circle' ></i></a>
                <?php
                    }
                    else
                    { 
                ?>            
                    </ul>

                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">
                        Bejelentkezés
                    </button>
                <?php
                    }
                ?>
            </div>
        </div>
    </nav>
</head>

<body>

    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content p-2 mb-2 bg-secondary modal-custom-size row g-0">
                <div class="row g-0">
                    <div class="left col-lg-6 col-sm-12">
                        <img src="../img/bus.png" alt="img" class="image-cover">
                        <p class="title">VÁM</p>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Bejelentkezés</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="POST" action="include/loginc.php">
                            <div class="form-group m-3 mt-4">
                                <label for="InputEmail">Email cím</label>
                                <input type="email" class="form-control" id="InputEmail" name="email" aria-describedby="emailHelp" placeholder="Add meg az email címed">
                            </div>
                            <div class="form-group m-3 mb-4">
                                <label for="InputPassword">Jelszó</label>
                                <input type="password" class="form-control" id="InputPassword" name="pwd" placeholder="Add meg a jelszavad">
                            </div>
                            <div class="modal-footer">
                                <a href="registration.php">Még nincs fiókja?</a>
                                <input type="submit" class="btn btn-primary" id="sm" name="submit" value="Bejelentkezés"></input>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VÁM | Regisztráció</title>
    <link rel="icon" type="image/x-icon" href="../img/bus.png">
    <link rel="stylesheet" href="../bootstrap-5.3.3-dist/css/bootstrap.css">
    <link rel="stylesheet" href="../css/registration.css">
    <link rel="stylesheet" href="../css/homepg.css">
    
</head>
<body>

    <section class="vh-100 bg-image">
        <div class="mask d-flex align-items-center h-100">
        <div class="background-blur"></div>
            <div class="container h-100" id="container">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                        <div class="card d-flex flex-row">
                            <div class="card-body p-5">
                                <div class="upper">
                                    <h2 class="text-uppercase text-center">vám</h2>
                                    <img src="../img/bus.png" alt="" class="logo">
                                </div>
                                
                                <form method="POST" action="include/reginc.php" id="form">
                                    
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="inputLname">Vezetéknév</label>
                                        <input type="text" id="inputLname" class="form-control form-control-lg custom-input" name="lname">
                                    </div>

                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="inputFname">Keresztnév</label>
                                        <input type="text" id="inputFname" class="form-control form-control-lg custom-input" name="fname">
                                    </div>

                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="inputEmail">E-mail cím</label>
                                        <input type="email" id="inputEmail" class="form-control form-control-lg custom-input" name="email">
                                    </div>

                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="password">Jelszó</label>
                                        <input type="password" id="password" class="form-control form-control-lg custom-input" name="pwd">
                                    </div>

                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="passwordRep">Jelszó újra</label>
                                        <input type="password" id="passwordRep" class="form-control form-control-lg custom-input" name="pwdrepeat">
                                    </div>

                                    <div class="d-flex justify-content-center">
                                        <input type="submit" class="btn btn-success btn-block btn-lg gradient-custom-4" name="submit" value="Regisztráció">
                                    </div>

                                    <p class="text-center mt-5 mb-0">Van már fiókja?
                                        <a href="homepg.php" class="fw-bold"><u>Jelentkezzen be itt!</u></a>
                                    </p>

                                </form>

                            </div>
                            <div id="error" class="d-flex flex-row pe-3 align-items-center"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="../js/invalid.js"></script>
    <script src="../bootstrap-5.3.3-dist/js/bootstrap.bundle.js"></script>

</body>
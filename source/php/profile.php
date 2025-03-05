<?php 
    include('include/header.php'); 
    include('classes/dbh.classes.php');
    include('classes/profile.classes.php');
    include('classes/profile-contr.classes.php');

    if (empty($_SESSION['szerep'])) {
        header("Location: homepg.php");
        exit(); 
    }

    $ticket = new Profile();
    if (($_SESSION["szerep"] == 1)) {
        $bought = $ticket->getAllBoughtTickets();
    } 
    if (($_SESSION["szerep"] == 2)) {
        $profit = $ticket->getProfitByUser();
        $salesData = $ticket->getProfitByCity();
        $result = $ticket->getProfitByType();
    } 
    //$_SESSION['bought'] = $bought;
?>

<link rel="stylesheet" href="../css/profile.css">
  
<div class="container my-5">
<h2 class="title">Felhasználói Profil</h2>

    <!-- Profil Információ -->
    <section id="profile-info" class="card mt-4 cont">
        <div class="card-body">
            <h3 class="card-title mb-4">Profil Információ</h3>
            <div class="ms-5">
                <?php
                echo '<p class="ms-3"><strong>Felhasználónév:</strong> <span id="username">' . $_SESSION["nev"] . '</span></p>';
                echo '<p class="ms-3"><strong>Email:</strong> <span id="email">' . $_SESSION["email"] . '</span></p>';
                ?>
                <div class="row">
                    <div class="col-lg-2 col-md-12">
                        <button class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#editProfileModal">Profil Szerkesztése</button>
                    </div>
                    <form action="include/logoutinc.php" method="post" class="col-lg-10 col-md-12 mt-2">
                        <input type="submit" class="btn btn-primary" name="logout" value="Kijelentkezés">
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section id="account-settings" class="card mt-4 cont">
        <div class="card-body">
            <h3 class="card-title">Felhasználói beállítások</h3>
            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Jelszó módosítása
                    <button class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#changePasswordModal">Szerkesztés</button>
                </li>
            </ul>
        </div>
    </section>

    <?php if ($_SESSION["szerep"] == 1) { ?>
        <!-- Legutóbbi Tevékenység vagy Mentett Tételek -->
        <section id="recent-activity" class="card mt-4 cont">
            <div class="card-body">
                <h3 class="card-title">Vásárolt jegyek</h3>
                <h5 class="card-title">Össz ár: 
                    <?php $ossz = 0; 
                    foreach ($bought as $ticket) { 
                        $ossz += $ticket['jegyar'] * $ticket['vasarolt_darab'];
                    }
                    echo number_format($ossz, 0) . " Ft"
                    ?>
                </h5>
                <ul class="list-group">
                    <?php foreach ($bought as $ticket) { ?>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-6 cell"><?php echo "Indulás: {$ticket['indulo_allomas']} ({$ticket['indulo_varos']})"?></div>
                            <div class="col-6 cellr"><?php echo "Érkezés: {$ticket['cel_allomas']} ({$ticket['cel_varos']}) "?></div>

                            <div class="col-4 cell mt-2 mb-2"><?php echo "Dátum: {$ticket['indulasi_datum']}"?></div>
                            <div class="col-4 cell mt-2 mb-2"><?php echo "Időpont: {$ticket['indulasi_ido']}"?></div> 
                            <div class="col-4 cellr mt-2 mb-2"><?php echo "Típus: {$ticket['jarat_tipus']}"?></div> 

                            <div class="col-6 cell"><?php echo "Ár: " . number_format($ticket['jegyar']) . " Ft"?></div>
                            <div class="col-6 cellr"><?php echo "Jegyek száma: {$ticket['vasarolt_darab']}"?></div>
                        </div>  
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </section>
    <?php } ?>

    
    <?php if ($_SESSION["szerep"] == 2) { ?>
        <h1 class="table-head-title">Vásárlási statisztikák
        <h2 class="table-title">Felhasználó alapján</h2>
        <div class="tbl">
            <table>
                <thead>
                    <tr>
                        <th>Felhasználó</th>
                        <th>Összes Vásárlás</th>
                        <th>Összes Jegy Darab</th>
                        <th>Összes Költség (Ft)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($profit as $user) { ?>
                        <tr id="user-<?php echo $user['felhasznalo']; ?>" class="table-row">
                            <td><?php echo $user['felhasznalo'] ?></td>
                            <td><?php echo $user['osszes_vasarolas'] ?></td>
                            <td><?php echo $user['osszes_jegydarab'] ?></td>
                            <td><?php echo $user['osszes_koltseg'] ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <h2 class="table-title">Város alapján</h2>
        <div class="tbl">
            <table>
                <thead>
                    <tr>
                        <th>Induló Város</th>
                        <th>Összes Vásárolt Jegy</th>
                        <th>Összes Bevétel (Ft)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($salesData as $row) { ?>
                        <tr>
                            <td><?php echo $row['indulo_varos']; ?></td>
                            <td><?php echo $row['osszes_vasarolt_jegy']; ?></td>
                            <td><?php echo $row['osszes_bevetel']; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <h2 class="table-title">Típus alapján</h2>
        <div class="tbl">
            <table>
                <thead>
                    <tr>
                        <th>Jármű Típus</th>
                        <th>Összes Elérhető Jegy</th>
                        <th>Összes Eladott Jegy</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- PHP kód a táblázat kitöltéséhez -->
                    <?php foreach ($result as $row) { ?>
                        <tr>
                            <td> <?php echo $row['jarmutipus'] ?> </td>
                            <td> <?php echo $row['osszes_elerhetojegy'] ?> </td>
                            <td> <?php echo $row['osszes_eladottjegy'] ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        
    <?php } ?>

</div>

<!-- Modálisok az Információk Szerkesztéséhez -->

<!-- Profil Szerkesztése Modális -->
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProfileLabel">Profil Szerkesztése</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="include/profileinc.php">
                    <div class="mb-3">
                        <label for="editLname" class="form-label">Vezetéknév</label>
                        <input type="text" id="edtLname" class="form-control" name="newlname">
                    </div>

                    <div class="mb-3">
                        <label for="editFname" class="form-label">Keresztnév</label>
                        <input type="text" id="editFname" class="form-control" name="newfname">
                    </div>
                    <div class="mb-3">
                        <label for="editEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="editEmail" name="newemail">
                    </div>
                    <input type="submit" class="btn btn-primary" name="editprof" value="Mentés"></input>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Change Password Modal -->
<div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changePasswordLabel">Jelszó megváltoztatása</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="include/pwdchangeinc.php">
                
                    <div class="mb-3">
                        <label for="currentPassword" class="form-label">Jelenlegi jelszó</label>
                        <input type="password" class="form-control" id="currentPassword" name="currentpwd">
                    </div>
                    <div class="mb-3">
                        <label for="newPassword" class="form-label">Új jelszó</label>
                        <input type="password" class="form-control" id="newPassword" name="newpwd1">
                    </div>
                    <div class="mb-3">
                        <label for="confirmPassword" class="form-label">Új jelszó megismétlése</label>
                        <input type="password" class="form-control" id="confirmPassword" name="newpwd2">
                    </div>
                    <input type="submit" class="btn btn-primary" name="editpwd" value="Mentés"></input>
                </form>
            </div>
        </div>
    </div>
</div>
    
<?php 
    include('include/footer.php'); 
?>
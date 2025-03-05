<?php 
    include 'include/header.php'; 
    include 'classes/dbh.classes.php';
    include 'classes/orderticket.classes.php';

// Lekérjük az összes jegyet és elmentjük a session-be
    $ticketOrder = new OrderTicket();
    
    if (isset($_SESSION['start'], $_SESSION['end']) && !empty($_SESSION['start']) || !empty($_SESSION['end'])) {
        $tickets = $ticketOrder->Search();
        $_SESSION['start'] = null;
        $_SESSION['end'] = null;
    } else {
        $tickets = $ticketOrder->getAllTickets();
    }

?>

<link rel="stylesheet" href="../css/orderticket.css">

<div class="cont">
    <div class="container mt-5">
        <h3 class="card-title mb-2">Keresés</h3>

        <div class="filter">
            <form action="include/orderticketinc.php" method="post" class="d-flex container  row g-0" role="search">
                <?php if(isset($_SESSION['email'])) { ?>
                    <div class="left col-lg-10 col-sm-12">
                        <input class="form-control me-3 ms-5" type="search" name="start" placeholder="Induló állomás" aria-label="Search">
                        <input class="form-control me-3" type="search" name="end" placeholder="Végállomás" aria-label="Search">
                        <input class="search btn me-5" type="submit" name="search" value="Keresés"></input>
                    </div>
                    
                    <div class="col-lg-2 col-sm-12">
                        <a class="nav-link dropdown-toggle mt-1 dpdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Szűrés
                        </a>
                        <ul class="dropdown-menu">
                            <li><input type="submit" class="dropdown-item" name="busz" value="Busz"></li>
                            <li><input type="submit" class="dropdown-item" name="vonat" value="Vonat"></li>
                            <li><input type="submit" class="dropdown-item" name="repulo" value="Repülő"></li>
                            <li><input type="submit" class="dropdown-item" name="minden" value="Minden"></li>
                        </ul>
                    </div>
                <?php } else {?>
                    <h2 class="notlogged">Keresés funkcióhoz jelentkezz be!</h2>
                <?php } ?>
            </form>
        </div>
    </div>

    <div class="container my-5">
        <div class="card-body">
            <h3 class="card-title mb-2">Jegyek</h3>

                <ul class="list-group">
                    <?php foreach ($tickets as $ticket) { 
                        $modalId = "changeData_" . $ticket['jegy_id'];
                        $deleteModalId = "delete_" . $ticket['jegy_id'];
                    ?>
                    <?php if ($ticket['elerhetoseg'] != -1) { ?>
                    <li class="list-group-item <?php if(isset($_SESSION['email'])) { ?>
                        d-flex justify-content-between align-items-center 
                        <?php } ?>">
                        <div class="row">
                            <div class="col-6 cell"><?php echo "Indulás: {$ticket['indulasi_allomas']} ({$ticket['indulasi_varos']})"?></div>
                            <div class="col-6 cellr"><?php echo "Érkezés: {$ticket['cel_allomas']} ({$ticket['cel_varos']}) "?></div>

                            <div class="col-4 cell mt-2 mb-2"><?php echo "Dátum: {$ticket['jarat_datum']}"?></div>
                            <div class="col-4 cell mt-2 mb-2"><?php echo "Időpont: {$ticket['jarat_idopont']}"?></div> 
                            <div class="col-4 cellr mt-2 mb-2"><?php echo "Típus: {$ticket['jarat_tipus']}"?></div> 

                            <div class="col-6 cell"><?php echo "Ár: " . number_format($ticket['ar']) . " Ft"?></div>
                            <div class="col-6 cellr"><?php echo "Jegyek száma: {$ticket['elerhetoseg']}"?></div>
                        </div>
                        <?php if (isset($_SESSION['email'])) { ?>
                        <?php if ($_SESSION['szerep'] == 2) { ?>
                        <div>
                            <div class="mb-2">
                                <button type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#<?php echo $modalId; ?>">Szerkesztés</button>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary del" data-bs-toggle="modal" data-bs-target="#<?php echo $deleteModalId; ?>">Törlés</button>
                            </div>
                        </div>

                        <!-- Szerkesztés -->
                        <div class="modal fade" id="<?php echo $modalId; ?>" tabindex="-1" aria-labelledby="<?php echo $modalId; ?>Label" aria-hidden="true">
                            <div class="modal-dialog modal-xl modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="<?php echo $modalId; ?>Label">Jegy szerkesztése</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form class="cont" action="include/admininc.php" method="post">
                                            <input type="hidden" name="jegy_id" value="<?php echo $ticket['jegy_id']; ?>">
                                            <!-- Varosnev adatok -->
                                            <div class="row mb-4">
                                                <div class="col-6">
                                                    <label for="starting_city">Indulási város</label>
                                                    <input type="text" id="starting_city" class="form-control" name="indulasi_varos" value="<?php echo $ticket['indulasi_varos']?>">
                                                </div>
                                                <div class="col-6">
                                                    <label for="end_city">Cél város</label>
                                                    <input type="text" id="end_city" class="form-control" name="cel_varos" value="<?php echo $ticket['cel_varos']?>">
                                                </div>
                                            </div>
                                            <!-- Allomasnev adatok -->
                                            <div class="row mb-4">
                                                <div class="col-6">
                                                    <label for="starting_station">Indulási állomás</label>
                                                    <input type="text" id="starting_station" class="form-control" name="indulasi_allomas" value="<?php echo $ticket['indulasi_allomas']?>">
                                                </div>
                                                <div class="col-6">
                                                    <label for="end_station">Cél állomás</label>
                                                    <input type="text" id="end_station" class="form-control" name="cel_allomas" value="<?php echo $ticket['cel_allomas']?>">
                                                </div>
                                            </div>
                                            <!-- Datum, idopont, tipus -->
                                            <div class="row mb-4">
                                                <div class="col-4">
                                                    <label for="date">Indulás dátuma</label>
                                                    <input type="text" id="date" class="form-control" name="jarat_datum" value="<?php echo $ticket['jarat_datum']?>" placeholder="Formátum: éééé-hh-nn">
                                                </div>
                                                <div class="col-4">
                                                    <label for="time">Indulás ideje</label>
                                                    <input type="text" id="time" class="form-control" name="jarat_idopont" value="<?php echo $ticket['jarat_idopont']?>" placeholder="Formátum: óó:pp:mm">
                                                </div>
                                                <div class="col-4">
                                                    <label label for="type">Járat típusa</label>
                                                    <input type="text" id="type" class="form-control" name="jarat_tipus" value="<?php echo $ticket['jarat_tipus']?>">
                                                </div>
                                            </div>
                                            <!-- Ar, elerheto jegyek szama -->
                                            <div class="row mb-4">
                                                <div class="col-6">
                                                    <label label for="price">Jegyár (Ft)</label>
                                                    <input type="number" id="price" class="form-control" name="ar" value="<?php echo $ticket['ar']?>">
                                                </div>
                                                <div class="col-6">
                                                    <label label for="amount">Jegyszám</label>
                                                    <input type="number" ip="amount" class="form-control" name="elerhetoseg" value="<?php echo $ticket['elerhetoseg']?>">
                                                </div>
                                            </div>

                                            <div class="sbm">
                                                <input type="submit" class="btn btn-primary" name="edit" value="Jegy Szerkesztése">
                                            </div>
                                        
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Törlés -->
                        <div class="modal fade" id="<?php echo $deleteModalId; ?>" tabindex="-1" aria-labelledby="<?php echo $deleteModalId; ?>Label" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="<?php echo $deleteModalId; ?>Label">Jegy törlése</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div>
                                            <form action="include/admininc.php" method="post">
                                                <input type="hidden" name="jegy_id" value="<?php echo $ticket['jegy_id']; ?>">
                                                <h5>Biztosan törölni szeretné?</h5>
                                                <div class="sbm">
                                                    <input type="submit" class="btn btn-primary" name="delete" value="Jegy törlése">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php } if ($_SESSION['szerep'] == 1) { ?>    
                        <form action="include/orderticketinc.php" method="post">

                                <input type="hidden" name="jaratid" value="<?php echo $ticket['jarat_id'] ?>">

                                <div class="quantity mb-1">
                                    <label for="quantity" class="">Mennyiség:</label>
                                    <input type="number" id="quantity" name="quantity" value="1" min="1" max="<?php echo min($ticket['elerhetoseg'], 99); ?>" class="form-control value" 
                                    onkeypress="return false;" 
                                    onkeydown="return event.key === 'ArrowUp' ||
                                    event.key === 'ArrowDown';">
                                </div>
                                
                                <input type="submit" class="btn btn-primary" name="submit" value="Kosárba teszem">
                        </form>
                        <?php } ?>
                        <?php } ?>
                        
                    </li>
                    <?php } ?>
                    <?php } ?>
                </ul>

        </div>
    </div>
</div>

<script src="../js/edit.js"></script>

<?php 
    include('include/footer.php'); 
?>
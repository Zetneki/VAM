<?php 
    include('include/header.php'); 
    if ($_SESSION['szerep'] != 2) {
        header("Location: homepg.php");
        exit(); 
    }
?>

<link rel="stylesheet" href="../css/admin.css">
<div class="cont container my-5">
    
    <h2 class="title">Hozzáadás</h2>
    <form class="card mt-4 cont" action="include/admininc.php" method="post">
        <div class="card-body">
            <h3 class="card-title mb-4">Jegy</h3>
            <!-- Varosnev adatok -->
            <div class="row mb-4">
                <div class="col-6">
                    <label for="starting_city">Indulási város</label>
                    <input type="text" id="starting_city" class="form-control" name="indulasi_varos">
                </div>
                <div class="col-6">
                    <label for="end_city">Cél város</label>
                    <input type="text" id="end_city"  class="form-control" name="cel_varos">
                </div>
            </div>
            <!-- Allomasnev adatok -->
            <div class="row mb-4">
                <div class="col-6">
                    <label label for="starting_station">Indulási állomás</label>
                    <input type="text" id="starting_station" class="form-control" name="indulasi_allomas">
                </div>
                <div class="col-6">
                    <label for="end_station">Cél állomás</label>
                    <input type="text" id="end_station" class="form-control" name="cel_allomas">
                </div>
            </div>
            <!-- Datum, idopont, tipus -->
            <div class="row mb-4">
                <div class="col-4">
                    <label for="date">Indulás dátuma</label>
                    <input type="text" id="date" class="form-control" name="jarat_datum" value="éééé-hh-nn">
                </div>
                <div class="col-4">
                    <label for="time">Indulás ideje</label>
                    <input type="text" id="time" class="form-control" name="jarat_idopont"  value="óó:pp:mm">
                </div>
                <div class="col-4">
                    <label label for="type">Járat típusa</label>
                    <input type="text" id="type" class="form-control" name="jarat_tipus">
                </div>
            </div>
            <!-- Ar, elerheto jegyek szama -->
            <div class="row mb-4">
                <div class="col-6">
                    <label label for="price">Jegyár (Ft)</label>
                    <input type="number" id="price" class="form-control" name="ar">
                </div>
                <div class="col-6">
                    <label label for="amount">Jegyszám</label>
                    <input type="number" id="amount" class="form-control" name="elerhetoseg">
                </div>
            </div>

            <div class="sbm">
                <input type="submit" class="btn btn-primary" name="submit" value="Jegy hozzáadása">
            </div>
        </div>
    </form>
    
</div>

<?php 
    include('include/footer.php'); 
?>


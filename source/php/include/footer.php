    <link rel="stylesheet" href="../css/error.css">

    <?php 
    if (isset($_GET['error'])) {
        $error = $_GET['error'];
        if ($error !== "none") {
    ?>
    
    <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <img src="../img/bus.png" class="rounded me-2" alt="...">
            <div class="me-auto errt">Hiba</div>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body err">
            <?php 
                if ($error === "usernotfound") echo "A felhasználó nem létezik"; 
                if ($error === "wrongpassword") echo "Rosszul adta meg a jelszavát"; 
                if ($error === "stmtfailed") echo "Hiba történt";
                if ($error === "emptyinput") echo "Valamelyik adat üresen lett hagyva";
                if ($error === "incorrectpwd") echo "Rosszul adta meg a jelszavát";
                if ($error === "invalidpwd") echo "Hibás új jelszó";
                if ($error === "passwordmatch") echo "Nem egyezik meg az új jelszó és ismétlése";
                if ($error === "email") echo "Hibás új email";
                if ($error === "name") echo "Hibás új név";
                if ($error === "ticketsoldout") echo "Elfogytak a jegyek";
                if ($error === "invalidtype") echo "Hibás típus";
                if ($error === "ticketexists") echo "A jegy már létezik";
            ?>
        </div>
    </div>

    <?php 
        }
    } 
    ?>
    
    <footer class="py-4 mt-5">
        <div class="container text-center text-md-start">
            <div class="row">
                <!-- About Us Section -->
                <div class="col-md-3 mb-4">
                    <h5 class="fw-bold text-uppercase">Rólunk</h5>
                    <p class="small">Busz, vasút, és repülőjegyek online vásárlása egy helyen. Könnyű kezelhetőség, gyors vásárlás.</p>
                </div>

                <!-- Links Section -->
                <div class="col-md-3 mb-4">
                    <h5 class="fw-bold text-uppercase">Oldalaink</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white text-decoration-none">Belföldi utazás</a></li>
                        <li><a href="#" class="text-white text-decoration-none">Jegyvásárlás</a></li>
                        <li><a href="#" class="text-white text-decoration-none">Kapcsolat</a></li>
                    </ul>
                </div>

                <!-- Social Media Section -->
                <div class="col-md-3 mb-4">
                    <h5 class="fw-bold text-uppercase">Kövessen minket</h5>
                    <a href="#" class="text-white me-3"><img src="../img/square-facebook-brands-solid (2).svg" alt="facebook" class="w-25"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="text-white me-3"><img src="../img/square-x-twitter-brands-solid (2).svg" alt="" class="w-25"><i class="bi bi-twitter"></i></a>
                </div>

                <!-- Contact Information -->
                <div class="col-md-3 mb-4">
                    <h5 class="fw-bold text-uppercase">Elérhetőség</h5>
                    <p class="small">Email: info@kozlekedes.hu</p>
                    <p class="small">Telefon: +36 1 234 5678</p>
                </div>
            </div>
            <div class="text-center mt-4">
                <p class="small">&copy; 2024 Közlekedési Jegyrendszer. Minden jog fenntartva.</p>
            </div>
        </div>
    </footer>

    <script src="../bootstrap-5.3.3-dist/js/bootstrap.bundle.js"></script>
    <script src="../js/toast.js"></script>
</body>
</html>
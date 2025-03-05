<?php

    if (isset($_POST["logout"])) {
        session_start();
        session_unset(); 
        session_destroy();

        header("location: ../homepg.php?error=none");
    }
?>
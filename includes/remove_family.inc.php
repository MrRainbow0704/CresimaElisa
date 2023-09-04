<?php

if (isset($_GET["nomeFamiglia"])) {
    $nomeFamiglia = $_GET["nomeFamiglia"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';
    
    if (emptyInput($nomeFamiglia) !== False) {
        header("location: ../admin.php?error=emptyinput");
        exit();
    }

    removeFamily($conn, $nomeFamiglia);
}
else{
    header("location: ../admin.php");
    exit();
}
<?php

if (isset($_POST["submit"])) {
    $nomeFamiglia = $_POST["nomeFamiglia"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';
    
    if (emptyInput($nomeFamiglia) !== False) {
        header("location: ../admin.php?error=emptyinput");
        exit();
    }

    addFamily($conn, $nomeFamiglia);
}
else{
    header("location: ../admin.php");
    exit();
}
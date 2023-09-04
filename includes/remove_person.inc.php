<?php

if (isset($_GET["nomeFamiglia"])) {
    $famiglia = $_GET["nomeFamiglia"];
    $nome = $_GET["nome"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';
    
    if (emptyInput($famiglia, $nome) !== False) {
        header("location: ../admin.php?error=emptyinput");
        exit();
    }

    removePerson($conn, $nome, $famiglia);
}
else{
    header("location: ../admin.php");
    exit();
}
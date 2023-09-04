<?php

if (isset($_POST["submit"])) {
    $nome1 = ucfirst(strtolower($_POST["nome1"]));
    $nome2 = ucfirst(strtolower($_POST["nome2"]));
    $cognome = ucfirst(strtolower($_POST["cognome"]));
    $famiglia = $_POST["famiglia"];
    
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';
    
    if (emptyInput($nome1, $cognome) !== False) {
        header("location: ../admin.php?error=emptyinput");
        exit();
    }

    if ($nome2 !== "" && isset($nome2)) {
        $nome = $nome1.' '.$nome2.' '.$cognome;
    } else {
        $nome = $nome1.' '.$cognome;
    }
    $vals = array("partecipa"=>NULL, "menu"=>NULL);
    update($conn, $nome, $famiglia, $vals, TRUE);
}
else{
    header("location: ../admin.php");
    exit();
}
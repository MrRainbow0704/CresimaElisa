<?php

if (isset($_POST["submit"])) {
    $nome1 = ucfirst(strtolower($_POST["nome1"]));
    $nome2 = ucfirst(strtolower($_POST["nome2"]));
    $cognome = ucfirst(strtolower($_POST["cognome"]));

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if (emptyInput($nome1, $cognome) !== False) {
        header("location: ../login?error=emptyinput");
        exit();
    }

    if ($nome2 !== "" && isset($nome2)) {
        $nome = $nome1.' '.$nome2.' '.$cognome;
    } else {
        $nome = $nome1.' '.$cognome;
    }
    
    loginUser($conn, $nome);
}
else{
    header("location: ../login");
    exit();
}
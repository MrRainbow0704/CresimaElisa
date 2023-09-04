<?php

if (isset($_POST["submit"])) {
    $nome = $_POST["persona"];
    $famiglia = $_POST["famiglia"];
    $partecipa = $_POST["partecipa"];
    $menu = $_POST["menu"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if ($partecipa === "NULL") {
        $partecipa = NULL;
    }

    if ($menu === "NULL") {
        $menu = NULL;
    }
    
    $vals = array("partecipa"=>$partecipa, "menu"=>$menu);
    update($conn, $nome, $famiglia, $vals);
}
else{
    header("location: ../login");
    exit();
}
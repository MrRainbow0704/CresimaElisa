<?php
    session_status() === PHP_SESSION_ACTIVE ?: session_start();

    include_once 'includes/dbh.inc.php';
    include_once 'includes/functions.inc.php';
    
    if (isset($_SESSION["nome"])) {
        $nucleoFamiliare = getFamily($conn, $_SESSION["nome"]);
        if ($nucleoFamiliare !== NULL) {
            $_SESSION["lista_famiglia"] = $nucleoFamiliare["lista"];
        }
    }
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="img/favicon.jpg">
    <link href="https://meyerweb.com/eric/tools/css/reset/reset.css" rel="stylesheet"/>
    <link href="css/styles.css" rel="stylesheet" />
    <title>Cresima Elisa</title>
</head>
<body>
    <header>
        <h1>Cresima Elisa</h1>
        <h2>Lorem ipsum dolor sit, amet consectetur adipisicing elit.</h2>
    </header>
    
    <nav class="sidenav" id="SideNav">
        <ul>
            <li><nobr><img src="img/home.png" alt="home" width="30px" height="30px" style="position:relative; top:5px; left:5px"><a href="index">  HOME</a></nobr></li>
            <li><nobr><img src="img/conferma.png" alt="conferma" width="30px" height="30px" style="position:relative; top:5px; left:5px"><a href="conferma">  CONFERMA PARTECIPAZIONE</a></nobr></li>
            <li><nobr><img src="img/contatti.png" alt="contatti" width="30px" height="30px" style="position:relative; top:5px; left:5px"><a href="contatti">  CONTATTI</a></nobr></li>
            <?php 
            if (isset($_SESSION["nome"])) {
                echo '<li><nobr><img src="img/logout.png" alt="logout" width="30px" height="30px" style="position:relative; top:5px; left:5px"><a href="includes/logout.inc.php">  ESCI</a></nobr></li>';
            }
            ?>
        </ul>
    </nav>
    <nav class="topnav" id="TopNav">
        <ul>
            <li><nobr><img src="img/home.png" alt="home" width="30px" height="30px" style="position:relative; top:5px; left:5px"><a href="index">  HOME</a></nobr></li>
            <li><nobr><img src="img/conferma.png" alt="conferma" width="30px" height="30px" style="position:relative; top:5px; left:5px"><a href="conferma">  CONFERMA PARTECIPAZIONE</a></nobr></li>
            <li><nobr><img src="img/contatti.png" alt="contatti" width="30px" height="30px" style="position:relative; top:5px; left:5px"><a href="contatti">  CONTATTI</a></nobr></li>
            <?php 
            if (isset($_SESSION["nome"])) {
                echo '<li><nobr><img src="img/logout.png" alt="logout" width="30px" height="30px" style="position:relative; top:5px; left:5px"><a href="includes/logout.inc.php">  ESCI</a></nobr></li>';
            }
            ?>
        </ul>
    </nav>
    <div id="wrapper">
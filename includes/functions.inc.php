<?php
session_status() === PHP_SESSION_ACTIVE ?: session_start();

function emptyInput(...$args) {
    $result;
    foreach ($args as $i) { 
        if (empty($i)) {
            $result = true;
        }
        else {
            $result = false;
            break;
        }
    }
    return $result;
}


function getLista($conn) {
    $sql = "SELECT * FROM listaInvitati";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../conferma?error=databasefail");
        exit();
    }
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);
    $invitati = array();
    while ($row = mysqli_fetch_assoc($resultData)) {
        $invitati[] = $row;
    }
    return $invitati;
}

function getFamily($conn, $nome) {
    $invitati = getLista($conn);
    $found = false;
    foreach ($invitati as $nomeNucleoFamiliare => $nucleoFamiliare) {
        if (array_key_exists($nome, json_decode($nucleoFamiliare["elementiFamiglia"], TRUE))) {
            $found = true;
            return array("nome"=>$nucleoFamiliare["nomeFamiglia"], "lista"=>json_decode($nucleoFamiliare["elementiFamiglia"], TRUE));
        }
    }
    if ($found === false) {
        return NULL;
    }
}


function addFamily($conn, $nomeFamiglia) {
    $sql = "INSERT INTO listaInvitati (nomeFamiglia, elementiFamiglia) VALUES (?, '{}');";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../admin.php?error=databasefail");
        exit();
    }
    
    mysqli_stmt_bind_param($stmt, "s", $nomeFamiglia);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../admin.php?error=none");
}

function update($conn, $nome, $famiglia, $vals, $admin=FALSE) {
    $sql = "UPDATE listainvitati SET elementiFamiglia = ? WHERE nomeFamiglia = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        if ($admin === TRUE) {
            header("location: ../admin.php?error=databasefail");
        } else {
            header("location: ../conferma?error=databasefail");
        }
        exit();
    }

    $invitati = getLista($conn);

    foreach ($invitati as $nomeNucleoFamiliare => $nucleoFamiliare) {
        if ($nucleoFamiliare["nomeFamiglia"] === $famiglia) {
            $data = json_decode($nucleoFamiliare["elementiFamiglia"], TRUE);
            break;
        }
    }
    $data[$nome] = $vals;
    $data = json_encode($data);

    mysqli_stmt_bind_param($stmt, "ss", $data, $famiglia);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);
    if ($admin === TRUE) {
        header("location: ../admin.php?error=none");
    } else {
        header("location: ../conferma?error=none");
    }
}

function removeFamily($conn, $nomeFamiglia) {
    $sql = "DELETE FROM listainvitati WHERE nomeFamiglia = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../admin.php?error=databasefail");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $nomeFamiglia);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../admin.php?error=none");
}


function removePerson($conn, $nome, $famiglia) {
    $sql = "UPDATE listainvitati SET elementiFamiglia = ? WHERE nomeFamiglia = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../admin.php?error=databasefail");
        exit();
    }

    $invitati = getLista($conn);

    foreach ($invitati as $nomeNucleoFamiliare => $nucleoFamiliare) {
        if ($nucleoFamiliare["nomeFamiglia"] == $famiglia) {
            $data = json_decode($nucleoFamiliare["elementiFamiglia"], TRUE);
            break;
        }
    }
    unset($data[$nome]);
    $data = json_encode($data);

    mysqli_stmt_bind_param($stmt, "ss", $data, $famiglia);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);
    header("location: ../admin.php?error=none");
}

function loginUser($conn, $name) {
    $nucleoFamiliare = getFamily($conn, $name);
    if ($nucleoFamiliare !== NULL) {
        $_SESSION["nome"] = $name;
        $_SESSION["nome_famiglia"] = $nucleoFamiliare["nome"];
        $_SESSION["lista_famiglia"] = $nucleoFamiliare["lista"];
        header("location: ../conferma");
        exit();
    } else {
        header("location: ../login?error=notonlist");
        exit();
    }
}
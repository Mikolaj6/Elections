<?php

include '../data.php';

session_start();

$failed = false;

$StrArr = array("id", "name", "lastName", "password");

if(isNotSet_($StrArr)){
    $failed = true;
} else {
    $newLogin = cleanNumber($_POST["id"]);
    $newName = clean($_POST["name"]);
    $newLastName = clean($_POST["lastName"]);
    $newPassword = clean($_POST["password"]);
    if($newLogin == '' || $newPassword == '') {
        $failed = true;
    }
}

if(!$failed){
    $dbconn = pg_connect($conn_str);

    $wynik = pg_query($dbconn,
        "SELECT Id FROM Voter");

    $available = true;

    if(!$wynik){
        $failed = true;
    } else {
        if($newLogin == '007'){
            $available = false;
        }
        while ($row = pg_fetch_row($wynik)) {
            if($row[0] == $newLogin){
                $available = false;
            }
        }
    }

    if(!$available){
        echo "Nazwa użytkownika nie jest dostępna<br>";
    } else {

        $wynik = pg_query($dbconn,
            "INSERT INTO Voter VALUES ('" .
            pg_escape_string($newLogin) .
            "','" . pg_escape_string($newName) .
            "','" . pg_escape_string($newLastName) .
            "','" . pg_escape_string($newPassword) . "')");

        if ($wynik) {
            echo "Pomyślnie dodano użytkownika<br>";
        } else {
            $failed = true;
        }
    }
}

if($failed) {
    echo "Nie powiodło się dodawanie użytkownika<br>";
    echo pg_last_error($dbconn) . "<br>";
}


echo "<a href='newVoter.php'> Wróć </a>";

?>
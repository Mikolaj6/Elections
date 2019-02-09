<?php

include '../data.php';

session_start();

$failed = false;

$StrArr = array("electionsName", "availablePositions", "newCandidatesDeadline", "startingDate", "endingDate");

if(isNotSet_($StrArr)){
    $failed = true;
} else {
    $newName = clean($_POST["electionsName"]);
    $newPositions = cleanNumber($_POST["availablePositions"]);
    $newDeadline = $_POST["newCandidatesDeadline"];
    //$timestamp = strtotime($newDeadline);
    //echo $newDeadline . "|";
    //$date = date('d-m-Y', $timestamp);
    //$time = date('H:i:s', $timestamp);
    //echo $date . "|" . $time;
    $newStarting = $_POST["startingDate"];
    $newEnding = $_POST["endingDate"];
    if($newName == '' || $newPositions == '') {
        $failed = true;
    }
}


if(!$failed) {
    $dbconn = pg_connect($conn_str);

    $wynik = pg_query($dbconn, "SELECT name FROM Elections");
    $available = true;

    if(!$wynik) {
        $failed = true;
    } else {
        while ($row = pg_fetch_row($wynik)) {
            if($row[0] == $newName){
                $available = false;
            }
        }
    }


    if(!$available) {
        echo "Wybory z tą nazwą już istnieją<br>";
    } else {
        $wynik = pg_query($dbconn, "INSERT INTO Elections VALUES (DEFAULT, '".
            pg_escape_string($newName) .
            "','" . $newPositions .
            "','" . $newStarting .
            "','" . $newEnding .
            "','" . $newDeadline . "', FALSE)");

        if ($wynik) {
            echo "Pomyślnie dodano wybory<br>";
        } else {
            $failed = true;
        }
    }
}

if($failed){
    echo "Nie powiodło się dodawanie wyborów<br>";
    echo pg_last_error($dbconn) . "<br>";
}

echo "<a href='newElections.php'> Wróć </a>";

?>


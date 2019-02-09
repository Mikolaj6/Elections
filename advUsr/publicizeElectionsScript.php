<?php

include '../data.php';

session_start();

if (isset($_SESSION['rows'])) {
    $dbconn = pg_connect($conn_str);

    if(!$dbconn) {
        echo "Failed to connect to DB" . "</br>";
    }

    for ($i = 0; $i <= $_SESSION['rows']; $i++) {
        if (isset($_POST[$i])) {
            $toUpdate = $_POST[$i];

            $wynik = pg_query($dbconn, "UPDATE Elections SET resultsPublished = TRUE WHERE id = " . pg_escape_string($toUpdate) . ";");

            if($wynik) {
                echo "Ogłoszono wybory nr " . $toUpdate . "</br>";
            } else {
                echo "Nie udało się ogłosić wyborów nr " . $toUpdate . "</br>";
            }
        }
    }
} else {
    echo "Nie otrzymano danych do opublikowania </br>";
}

unset ($_SESSION["rows"]);
echo "<a href='publicizeElections.php'> Wróć </a>";

?>
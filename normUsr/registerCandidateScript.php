<?php

include '../data.php';

session_start();

if (isset($_SESSION['rowsCandidates']) && isset($_SESSION['wyboryIDD'])) {
    $dbconn = pg_connect($conn_str);

    if(!$dbconn) {
        echo "Failed to connect to DB" . "</br>";
    }

    for ($i = 0; $i <= $_SESSION['rowsCandidates']; $i++) {
        if (isset($_POST[$i])) {
            $toAdd = $_POST[$i];

            $wynik = pg_query($dbconn,"INSERT INTO Candidatures VALUES(DEFAULT, " . $_SESSION['wyboryIDD'] . ", ". $toAdd . ", " . '0);');
            $nameQ =  pg_query($dbconn,"SELECT name, lastName FROM Voter WHERE Id = ". $toAdd. ";");
            $name = pg_fetch_row($nameQ);

            if($nameQ && $wynik) {
                echo "Zarejestrowałeś kandydata imię: " . $name[0] . " nazwisko: " . $name[1] . " </br>";
            } else {
                echo "Nie udało się dodać kandydatury </br>";
            }
        }
    }
} else {
    echo "Nie otrzymano danych aby zarejestrować kandydata</br>";
}
unset ($_SESSION['rowsCandidates']);
unset ($_SESSION['wyboryIDD']);
echo "<a href='chooseElectionsForNewCandidates.php'> Wróć do wyboru wyborów</a> </br>";
echo "<a href='user.php'> Wróć do panelu użytkownika </a> </br>";
echo "<a href='../index.php'> Wyloguj </a> </br>";

?>
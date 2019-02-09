<?php

include '../data.php';

session_start();


echo "<html>";
echo "<head>";
echo "<title>Wybory</title>";
echo "</head>";
echo "<body>";

if (isset($_SESSION['isNormal']) && $_SESSION['isNormal'] == true) {
    $dbconn = pg_connect($conn_str);
    $wynik = pg_query($dbconn,
        "SELECT name FROM Voter WHERE Id = " . $_SESSION['ID'] . ";");


    if(!$wynik) {
        echo "<H3>No name found</H3>" . "</br>";

    } else {
        echo "<H3>Użytkownik " . pg_fetch_row($wynik)[0] . "</H3></br>";
        echo "<a href='chooseElectionsForNewCandidates.php'> Zgłoś kandydata!!! </a> </br>";
        echo "<a href='chooseElectionsForVoting.php'> Głosuj w wyborach!!! </a> </br>";
        echo "<a href='chooseElectionsToShow.php'> Oglądaj opublikowane!!! </a> </br>";
    }

    echo "<a href='../index.php'> Wyloguj </a>";
} else {
    echo "<H3>Nie jesteś zalogowany</H3>  </br>";
    echo "<a href='../index.php'> Wróć do panelu logowania </a>";
}


echo "</body>";
echo "</html>";

?>
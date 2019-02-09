<?php

include '../data.php';

session_start();

if (isset($_SESSION['isNormal']) && $_SESSION['isNormal'] == true) {
    echo "<H3>Które wybory</H3>";

    $dbconn = pg_connect($conn_str);
    $wynik = pg_query($dbconn, "SELECT id, name, positions, newCandidatesDeadline FROM Elections WHERE (SELECT NOW()) < newCandidatesDeadline LIMIT 10");

    if($wynik){
        echo "<form action='chooseCandidate.php' method=POST>";
        while($row = pg_fetch_row($wynik)){
            $str = "Nazwa: " . $row[1] . " Wolne pozycje: " . $row[2] . " Termin rejestracji: ". $row[3] . "</br>";
            echo "<input type='radio' name='wybory' value=$row[0]> $str <br>";
        }
        echo "<input type='submit' value='Wybrane'>";
        echo "</form>";
    } else {
        echo "Niepowodzenie, nie udało się zdobyć danych <br>";
    }
    echo "<a href='user.php'> Wróć </a> </br>";
    echo "<a href='../index.php'> Wyloguj </a>";

} else {
    echo "<H3>Nie jesteś zalogowany</H3>  </br>";
    echo "<a href='../index.php'> Wróć do panelu logowania </a>";
}

?>
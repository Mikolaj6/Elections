<?php
include '../data.php';

session_start();

echo "<html>";
echo "<head>";
echo "<title>Wybory</title>";
echo "</head>";
echo "<body>";


if (isset($_SESSION['isNormal']) && $_SESSION['isNormal'] == false) {
    echo "<H3>Opublikuj wybory</H3>";

    $dbconn = pg_connect($conn_str);

    $wynik = pg_query($dbconn, "SELECT id, name, startingDate, endingDate FROM Elections WHERE resultsPublished is FALSE AND (SELECT NOW()) > endingDate LIMIT 10");

    if($wynik){
        echo "<FORM action='publicizeElectionsScript.php' method=POST>";
        $id_ = 0;
        $_SESSION['rows'] = pg_num_rows($wynik);
        while ($row = pg_fetch_row($wynik)) {
            $id_ += 1;
            $id_str = "" . $id_;
            $row_str = $row[0];
            echo "<input type='checkbox' name=$id_str  value=$row_str>" . "Id: " . $row[0] . " Nazwa: " . $row[1] . " Początkek: " . $row[2] . " Koniec: " .  $row[3] . "</br>";
        }

        echo "</br>";
        echo "<Input TYPE=SUBMIT name='enter' value='Zatwierdź'>" . "</br>";
        echo "</FORM>";
    } else {
        echo "<H3>Problem z zapytaniem</H3>";
    }

    echo "<a href='advancedUser.php'>Wróć</a>";
} else {
    echo "<H3> NIe jesteś zalogowany </H3>";
    echo "<a href='../index.php'> Wróć </a>";
}

echo "</body>";
echo "</html>";
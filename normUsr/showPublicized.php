<?php

include '../data.php';

session_start();

if (isset($_SESSION['isNormal']) && $_SESSION['isNormal'] == true) {


    if(isset($_POST['publicize'])){
        $electionsId = $_POST['publicize'];

        $dbconn = pg_connect($conn_str);
        $wynik1 = pg_query($dbconn, "SELECT name, positions, endingDate FROM ELections WHERE id = " . $electionsId . ";");
        $wynik2 = pg_query($dbconn, "SELECT * FROM bestCandidatures(" . $electionsId . ");");

        if($wynik1 && $wynik2){
            $elections = pg_fetch_row($wynik1);
            echo "<H4>Wyniki wyborów " . $elections[0] . ", miejsca: " . $elections[1] . ", zakończyły się: " . $elections[2] ." </H4>";

            while($res = pg_fetch_row($wynik2)){
                echo "Kandydat: " . $res[0] . " " . $res[1] . ", ilość głosów: " . $res[2] . "</br>";
            }

        } else {
            echo "Niepowodzenie, nie udało się zdobyć danych<br>";
        }

    }

    echo "<a href='user.php'> Wróć </a> </br>";
    echo "<a href='../index.php'> Wyloguj </a>";
} else {
    echo "<H3>Nie jesteś zalogowany</H3>  </br>";
    echo "<a href='../index.php'> Wróć do panelu logowania </a>";
}

?>
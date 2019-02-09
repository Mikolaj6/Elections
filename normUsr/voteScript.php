<?php

include '../data.php';

session_start();

if (isset($_SESSION['isNormal']) && $_SESSION['isNormal'] == true) {

    $dbconn = pg_connect($conn_str);

    if($_POST['electionsSpots'] >= sizeof($_POST['checkList']) + $_POST['already']) {

        if (!empty($_POST['checkList'])) {

            foreach ($_POST['checkList'] as $check) {
                $query1 = "INSERT INTO Vote VALUES(" . $_SESSION['ID'] . ", " . $check . ");";
                $wynik1 = pg_query($dbconn, $query1);
                $query2 = "SELECT Voter.name, Voter.lastName FROM Candidatures JOIN "
                    . "Voter ON Voter.Id = Candidatures.voterId "
                    . "WHERE Candidatures.id = " . $check . " AND Candidatures.electionsId = " . $_POST['electionsId'] . ";";
                $wynik2 = pg_query($dbconn, $query2);

                if ($wynik1 && $wynik2) {
                    $res = pg_fetch_row($wynik2);
                    echo "Zagłosowałeś na Imie: " . $res[0] . " Nazwisko: " . $res[1] . " </br>";
                } else {
                    echo "Nie udało sie dodać użytkownika o ID: " . $check . " </br>";
                }
            }
        } else {
            echo "<H3>Nie było użytkowników do dodania</H3>  </br>";
        }
    } else {
        echo "<H3>Chciałeś zagłosować na zbyt wielu kandydatów</H3>  </br>";
    }

    echo "<a href='user.php'> Wróć do panelu użytkownika</a> </br>";
    echo "<a href='../index.php'> Wyloguj</a> </br>";
} else {
    echo "<H3>Nie jesteś zalogowany</H3>  </br>";
    echo "<a href='../index.php'> Wróć do panelu logowania</a> </br>";
}

?>
<?php

include '../data.php';

session_start();

if (isset($_SESSION['isNormal']) && $_SESSION['isNormal'] == true) {

    if (isset($_POST['wybory'])) {
        $id = $_POST['wybory'];
        $_SESSION['wyboryIDD'] = $id;

        $dbconn = pg_connect($conn_str);

        $str1 = "SELECT Voter.Id";
        $str2 = ", Voter.name, Voter.lastName";
        $str3 = " FROM Candidatures JOIN Voter ON Voter.Id "
            . "= Candidatures.voterId WHERE Candidatures.electionsId = " . $id;

        $query1 = $str1 . $str2 . $str3 . ";";
        $query2 = "SELECT Voter.Id, Voter.name, Voter.lastName FROM Voter WHERE " .
            "Voter.Id NOT IN (" . $str1 . $str3 . ");";

        $wynik1 = pg_query($dbconn, $query1);
        $wynik2 = pg_query($dbconn, $query2);

        if ($wynik1) {
            echo "<H2>Zgłoszeni na razie</H2> </br>";
            while($res = pg_fetch_row($wynik1)) {
                echo "Imię: $res[1] Nazwisko: $res[2] </br>";
            }
            echo "<H2>Do zgłoszenia</H2> </br>";

            echo "<FORM action='registerCandidateScript.php' method=POST>";
            $_SESSION['rowsCandidates'] = pg_num_rows($wynik2);
            $id_ = 0;
            while($res = pg_fetch_row($wynik2)) {
                $id_ += 1;
                echo "<input type='checkbox' name=$id_ value=$res[0]>" . " Imię: " . $res[1] . " Nazwisko: " . $res[2] . "</br>";
            }

            echo "<Input TYPE=SUBMIT name='enter' value='Zatwierdź'>" . "</br>";
            echo "</FORM>";

        } else {
            echo "<H3>Problem z zapytaniem</H3> </br>";
        }

    } else {
        echo "<H3>Nie wybrałeś wyborów!!! </H3>  </br>";
    }

    echo "<a href='chooseElectionsForNewCandidates.php'> Wróć do wyboru wyborów</a> </br>";
    echo "<a href='user.php'> Wróć do panelu użytkownika</a> </br>";
} else {
    echo "<H3>Nie jesteś zalogowany</H3>  </br>";
    echo "<a href='../index.php'> Wróć do panelu logowania </a>";
}


?>
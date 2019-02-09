<?php


include '../data.php';

session_start();

if (isset($_SESSION['isNormal']) && $_SESSION['isNormal'] == true) {

    if (isset($_POST['wybory'])) {
        $id = $_POST['wybory'];
        $dbconn = pg_connect($conn_str);

        $str1 = "SELECT Voter.Id";
        $str2 = ", Voter.name, Voter.lastName";
        $str3 = " FROM Candidatures JOIN Voter ON Voter.Id = "
            . "Candidatures.voterId JOIN Vote ON Vote.candidatureId"
            . "  = Candidatures.id WHERE Candidatures.electionsId = "
            . $id . " AND Vote.voterId = " . $_SESSION['ID'];

        $query1 = $str1 . $str2 . $str3 . ";";
        $query2 = "SELECT Candidatures.id, Voter.name, Voter.lastName FROM Voter "
        . "JOIN Candidatures ON Candidatures.voterId = Voter.Id "
        ."WHERE Candidatures.electionsId = " . $id . " AND " .
            "Voter.Id NOT IN (" . $str1 . $str3 . ");";

        $wynik1 = pg_query($dbconn, $query1);
        $wynik2 = pg_query($dbconn, $query2);
        $wynik3 = pg_query($dbconn, "SELECT positions FROM Elections WHERE id = " . $id .";");


        if($wynik1 && $wynik2 && $wynik3) {
            echo "<H2>Zagłosowałeś na razie na</H2> </br>";
            while($res = pg_fetch_row($wynik1)) {
                echo "Name: $res[1] LastName: $res[2] </br>";
            }
            echo "<H2>Pozostali kandydaci</H2> </br>";

            echo "<FORM action='voteScript.php' method=POST>";
            while($res = pg_fetch_row($wynik2)) {
                echo "<input type='checkbox' name='checkList[]' value=$res[0]>" . " Imię: " . $res[1] . " Nazwisko: " . $res[2] . "</br>";
            }
            echo "<input type='hidden' value=$id name='electionsId' />";                #UNUSED
            $res2 = pg_fetch_row($wynik3);
            echo "<input type='hidden' value=$res2[0] name='electionsSpots' />";
            $alr = pg_num_rows($wynik1);
            echo "<input type='hidden' value=$alr name='already' />";

            echo "<Input TYPE=SUBMIT name='enter' value='Zatwierdź'>" . "</br>";
            echo "</FORM>";

        } else {
            echo "<H3>Problem z zapytaniem</H3> </br>";
        }

    } else {
        echo "<H3>Nie wybrałeś wyborów!!! </H3>  </br>";
    }
    echo "<a href='chooseElectionsForVoting.php'> Wróć do wyboru wyborów</a> </br>";
    echo "<a href='user.php'> Wróć do panelu użytkownika</a> </br>";

} else {
    echo "<H3>Nie jesteś zalogowany</H3>  </br>";
    echo "<a href='../index.php'> Wróć do panelu logowania</a> </br>";
}
?>
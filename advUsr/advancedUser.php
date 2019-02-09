<?php
session_start();

echo "<html>";
echo "<head>";
echo "<title>Wybory</title>";
echo "</head>";
echo "<body>";

if (isset($_SESSION['isNormal']) && $_SESSION['isNormal'] == false) {
    echo "<H3>Komisja</H3>";

    echo "<a href='newElections.php'> Nowe Wybory!!! </a> </br>";
    echo "<a href='newVoter.php'> Nowy Wyborca!!! </a> </br>";
    echo "<a href='publicizeElections.php'> Publikcaja Wyborów!!! </a> </br>";
    echo "<a href='../index.php'> Wyloguj </a>";

} else {
    echo "<H3> You are not logged in </H3>";
    echo "<a href='../index.php'> Wróć </a>";
}

echo "</body>";
echo "</html>";

?>
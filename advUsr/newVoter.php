<?php
session_start();

echo "<html>";
echo "<head>";
echo "<title>Wybory</title>";
echo "</head>";
echo "<body>";


if (isset($_SESSION['isNormal']) && $_SESSION['isNormal'] == false) {
    echo "<H3> Zarejestruj nowego wyborcę </H3>";

    echo "<FORM action='newVoterScript.php' method=POST>";
    echo "<P> Identyfikator <Input TYPE=Text Name='id'>";
    echo "<P> Imie <Input TYPE=Text Name='name'>";
    echo "<P> Nazwisko <Input TYPE=Text Name='lastName'>";
    echo "<P> Hasło <Input TYPE=Text Name='password'><BR><BR>";
    echo "<Input TYPE=SUBMIT name='enter' value='Zatwierdź'>";
    echo "</FORM>";

    echo "<a href='advancedUser.php'>Wróć</a>";
} else {
    echo "<H3> Nie jesteś zalogowany</H3>";
    echo "<a href='../index.php'> Wróć </a>";
}

echo "</body>";
echo "</html>";

?>
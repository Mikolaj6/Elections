<?php

session_start();

echo "<html>";
echo "<head>";
echo "<title>Wybory</title>";
echo "</head>";
echo "<body>";

if (isset($_SESSION['isNormal']) && $_SESSION['isNormal'] == false) {

    echo "<H3>Zaresjestruj nowe wybory</H3>";

    echo "<FORM action='newElectionsScript.php' method=POST>";
    echo "<P> Nazwa <Input TYPE=Text Name='electionsName'>";
    echo "<P> Liczba posad <Input TYPE=Text Name='availablePositions'>";
    echo "<P> Termin zgłaszania kandydatów <Input TYPE=datetime-local Name='newCandidatesDeadline'>";
    echo "<P> Termin rozpoczęcia głosowania <Input TYPE=datetime-local Name='startingDate'>";
    echo "<P> Termin zakończenia głosowania <Input TYPE=datetime-local Name='endingDate'><BR><BR>";
    echo "<Input TYPE=SUBMIT name='enter' value='Zatwierdź'>";
    echo "</FORM>";

    echo "<a href='advancedUser.php'>Wróć</a>";
} else {
    echo "<H3> Nie jesteś zalogowany </H3>";
    echo "<a href='../index.php'> Wróć </a>";
}

echo "</body>";
echo "</html>";



?>
<html>
<head>
    <title>Wybory</title>
</head>
<body>

<?php
session_start();
session_unset();
?>


<H3>Logowanie</H3>

<FORM action="login.php" method=POST>
    <P> ID <Input TYPE=Text Name="login">

    <P> Haslo <Input TYPE=Password Name="password"><BR><BR>
        <Input TYPE=SUBMIT name="enter" value="Zatwierdź">
</FORM>

</body>
</html>
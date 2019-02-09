<?php

include 'data.php';

session_start();

$failed = true;

if(!isset($_POST["login"]) || !isset($_POST["password"])){
    header('Location: failedLogin.php');
} else {
    $_SESSION['ID'] = clean($_POST["login"]);
    $pass = clean($_POST["password"]);

    if ($_SESSION['ID'] == strval('007') && $pass == strval('JamesBond')) {
        $failed = false;
        $_SESSION['isNormal'] = false;
        header('Location: advUsr/advancedUser.php');
    }
}

$dbconn = pg_connect($conn_str);

if(!$dbconn) {
    exit("Brak połączenia");
}

$result = pg_query($dbconn, "select Id, password from Voter");


while ($row = pg_fetch_row($result)) {
    if(strval($row[0]) == $_SESSION['ID'] && strval($row[1]) == $pass && $failed){
        $failed = false;
        $_SESSION['isNormal'] = true;
        header('Location: normUsr/user.php');
        break;
    }
}

if($failed) {
    header('Location: failedLogin.php');
}


?>
<?php
function clean($string) {
    $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
    return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}

function cleanNumber($string) {
    $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
    return preg_replace('/[^0-9\-]/', '', $string); // Removes special chars.
}

function isNotSet_($stringArr) {
    foreach ($stringArr as $val){
        if(isset($_POST[$val])){
            return false;
        }
    }
    return true;
}

$conn_str = "host=localhost dbname=zbyszek2 user=mikol password=y";
?>
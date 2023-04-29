<?php
//this is a test
session_start();

//ahmed DB
/*
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'prayerprojectdb');*/

//define('SITE_URL', 'http://localhost/fundadatabase/fundaDatabasePhp/');
define('SITE_URL', 'http://localhost/');

include_once("DBConnection.php");
$db = new DBConnection;
$db->openConnection();
include_once('F:\YearTwo\YearTwo-SecondSemester\SWE1\XAMPP\htdocs\pt\PrayerAppRepo\View\codes\authentication_code.php');


function base_url($slug){
    echo SITE_URL.$slug;
}

function redirect($message, $page){

    $redirectTo = SITE_URL.$page;
    $_SESSION['message'] = "$message";
    // check if the user is already logged in
    if(isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true){
        header("Location: my-profile.php");
    } else {
        header("Location: $redirectTo");
    }

    exit(0);
}


function validateInput($dbconn, $input){
    return mysqli_real_escape_string($dbconn, $input);
}
?>
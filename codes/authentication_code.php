<?php
//include('config/app.php');
include_once('../Controller/RegisterContoller.php');
include_once('../Controller/LoginController.php');
include_once('F:\YearTwo\YearTwo-SecondSemester\SWE1\XAMPP\htdocs\pt\PrayerAppRepo\View\config\DBConnection.php');


$db= new DBConnection;
$auth = new LoginController;
$db->openConnection();

if(isset($_POST['logout_btn'])){
    $checkedLoggedOut = $auth->logout();
    if($checkedLoggedOut){
        redirect("Logged out", "/pt/PrayerAppRepo/View/login.php");
    }
}

if(isset($_POST['login_btn'])){
    $email = validateInput($db->openConnectionMYSQLIreturn(), $_POST['email']);
    $password = validateInput($db->openConnectionMYSQLIreturn(), $_POST['password']);

    
    $checkLogin = $auth->userLogin($email, $password);
    if($checkLogin){
        if($_SESSION['auth_role'] == '1'){
            redirect("Logged in Successfully","/pt/PrayerAppRepo/View/adminPage.php");
        }
        else{
            redirect("Logged in Successfully","/pt/PrayerAppRepo/View/login.php");
        }
        
    }
    else{
        redirect("Invalid Email or Password", "/pt/PrayerAppRepo/View/login.php");
    }
}




//register page code
if(isset($_POST['register_btn'])){

    $fname = validateInput($db->openConnectionMYSQLIreturn(), $_POST['fname']);
    $lname = validateInput($db->openConnectionMYSQLIreturn(), $_POST['lname']);
    $email = validateInput($db->openConnectionMYSQLIreturn(), $_POST['email']);
    $password = validateInput($db->openConnectionMYSQLIreturn(), $_POST['password']);
    $confirm_password = validateInput($db->openConnectionMYSQLIreturn(), $_POST['confirm_password']);
    
    $register = new RegisterController;
    $result_password = $register->confirmPassword($password, $confirm_password);
    if($result_password){

       $result_user = $register->isUserExisits($email);

       if($result_user){
        redirect("You are already registered.", "/pt/PrayerAppRepo/View/login.php");
       }
       else{
  
        $register_query = $register->registration($fname, $lname, $email,
         $password);
        if($register_query){
            redirect("Registered Successfully.", "/pt/PrayerAppRepo/View/login.php");
        }
        else{
            redirect("Something went wrong.", "/pt/PrayerAppRepo/View/register.php");
        }

       }

    }
    else{
        redirect("*The passwords don't match", "/pt/PrayerAppRepo/View/register.php");
    }

}



?>
<?php
require_once '../../Model/Adopter.php';

session_start();
// error_reporting(0);  // This line will hide all the given errors in php



$everythingOK = FALSE;
$everythingOKCounter = 0;
$emailError = "";
$passwordError = "";

$email = "";
$password = "";
$_SESSION['emailError'] = "";
$_SESSION['passwordError'] = "";
$_SESSION['mail'] = "";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    // Mail Validation
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['mail'];
        if (empty($email)) {
            $emailError = "Email is required";
            $_POST['mail'] = "";
            $email = "";
            $everythingOK = FALSE;
            $everythingOKCounter += 1;

            echo "Mail error 1";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailError = "Invalid email format";
            $email = "";
            $everythingOK = FALSE;
            $everythingOKCounter += 1;
            echo "Mail error 2";
        } else {
            $everythingOK = TRUE;
        }
    }
}


if ($everythingOK && $everythingOKCounter == 0) {
    // Check that id and password are correct
    // if correct, redirect to the home page
    // $data = file_get_contents("../Data/data.json");
    $adopter_confirmation = search_specific_data("password", "adopter", "adopter_mail", $email);
    if (isset($adopter_confirmation)) {
        $_SESSION['mail'] = $email;
        header('Location:../../Views/Supervisor/Forget_Password/CreateNewPassword/CreateNewPassword.php');
    }
    //header('Location:Login.php');
} else {
    $_SESSION['emailError'] = $emailError;
    $_SESSION['passwordError']  = $passwordError;
    header('Location: ../../Views/Supervisor/Forget_Password/ForgetPassword/ForgetPassword.php');
}
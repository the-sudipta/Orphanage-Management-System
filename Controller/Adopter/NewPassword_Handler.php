<?php
require_once '../../Model/Adopter.php';
session_start();



$update_location = $_SESSION['mail'];

// error_reporting(0);  // This line will hide all the given errors in php
$mailFlag = $_SESSION['mail'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newPassword = $_POST['newPass'];
    // echo $wordCount;
    if (empty($newPassword) || strlen($newPassword) < 8) {
        // check if password size in 8 or more and  check if it is empty
        $newPasswordError = "Write at least 8 Character";
        $_POST['newPass'] = "";
        $newPassword = "";
    } else if (!preg_match('/[@#$%]/', $newPassword)) {
        // check if password contains at least one special character
        $newPasswordError = "Password must contain at least one special character (@, #, $, %)";
        $_POST['newPass'] = "";
        $newPassword = "";
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $reTypePassword = $_POST['ConfirmNewPass'];
    // echo $wordCount;
    if (empty($reTypePassword) || strlen($reTypePassword) < 8) {
        // check if password size in 8 or more and  check if it is empty
        $reTypePasswordError = "Write at least 8 Character";
        $_POST['ConfirmNewPass'] = "";
        $reTypePassword = "";
    } else if (!($_POST['newPass'] === $_POST['ConfirmNewPass'])) {
        // check if password contains at least one special character
        $reTypePasswordError = "New Password and Retype New Password must be same";
        $_POST['ConfirmNewPass'] = "";
        $reTypePassword = "";
    } else {



        //  Save the new password
        $adopter_data = show_single_data("adopter_mail", $update_location);
        $adopter_data["password"] = $newPassword;
        $update_confirmation = update_data("adopter_mail", $update_location, $adopter_data);
        if ($update_confirmation) {
            echo "Password Updated Successfully";
            header("Location: ../../Views/Adopter/Login/Login.php");
        } else {
            header("Location: ../../Views/Adopter/Forget_Password/ForgetPassword/ForgetPassword.php");
        }
    }
}

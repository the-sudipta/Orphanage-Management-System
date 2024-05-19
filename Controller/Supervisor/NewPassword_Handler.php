<?php
require_once '../../Model/Supervisor.php';
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
        $supervisor_data = show_single_supervisor_data("supervisor_mail", $update_location);
        $supervisor_data["password"] = $newPassword;
        $update_confirmation = update_supervisor_data("supervisor_mail", $update_location, $supervisor_data);
        if ($update_confirmation) {
            echo "Password Updated Successfully";
            header("Location: ../../Views/Supervisor/Login/Login.php");
        } else {
            header("Location: ../../Views/Supervisor/Forget_Password/ForgetPassword/ForgetPassword.php");
        }
    }
}
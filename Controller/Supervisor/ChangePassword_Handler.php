<?php
require_once '../../Model/Supervisor.php';
session_start();

$currPasswordError = "";
$newPasswordError = "";
$reTypePasswordError = "";

$currPassword = "";
$newPassword = "";
$reTypePassword = "";
$_SESSION["currPasswordError"] = "";
$_SESSION["newPasswordError"] = "";
$_SESSION["reTypePasswordError"] = "";
$update_location = $_SESSION['mail'];


$everythingOkCounter = 0;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $currPassword = $_POST['currentPass'];
        // echo $wordCount;
        if (empty($currPassword)) {
            $currPasswordError = "Current Password is required";
            $_POST['currentPass'] = "";
            $currPassword = "";
            // echo $nameError;
            $everythingOkCounter += 1;
        } else {
            $currPasswordError = "";
        }
    }


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $newPassword = $_POST['newPass'];
        // echo $wordCount;
        if (empty($newPassword) || strlen($newPassword) < 8) {
            // check if password size in 8 or more and  check if it is empty
            $newPasswordError = "Write at least 8 Character";
            $_POST['newPass'] = "";
            $newPassword = "";
            $everythingOkCounter += 1;
        } else if (!preg_match('/[@#$%]/', $newPassword)) {
            // check if password contains at least one special character
            $newPasswordError = "Password must contain at least one special character (@, #, $, %)";
            $_POST['newPass'] = "";
            $newPassword = "";
            $everythingOkCounter += 1;
        } else if ($_POST['currentPass'] === $_POST['newPass']) {
            // check if password old pass and new pass got matched
            $newPasswordError = "Current Password and New Password can't be same";
            $_POST['newPass'] = "";
            $newPassword = "";
            $everythingOkCounter += 1;
        } else {
            $newPasswordError = "";
        }
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $reTypePassword = $_POST['reTypeNewPass'];
        // echo $wordCount;
        if (empty($reTypePassword) || strlen($reTypePassword) < 8) {
            // check if password size in 8 or more and  check if it is empty
            $reTypePasswordError = "Write at least 8 Character";
            $_POST['reTypeNewPass'] = "";
            $reTypePassword = "";
            $everythingOkCounter += 1;
        } else if (!($_POST['newPass'] === $_POST['reTypeNewPass'])) {
            // check if password contains at least one special character
            $reTypePasswordError = "New Password and Retype New Password must be same";
            $_POST['reTypeNewPass'] = "";
            $reTypePassword = "";
            $everythingOkCounter += 1;
        } else {
            $reTypePasswordError = "";
        }
    }

    if ($everythingOkCounter == 0) {
        // Send the data to the database

        $supervisor_data = show_single_supervisor_data("supervisor_mail", $update_location);
        $supervisor_data["password"] = $newPassword;
        $update_confirmation = update_supervisor_data("supervisor_mail", $update_location, $supervisor_data);

        if ($update_confirmation) {
            echo "Password Updated Successfully";
            header("Location: ../../Views/Supervisor/Login/Login.php");
        } else {
            header("Location: ../../Views/Supervisor/Forget_Password/ForgetPassword/ForgetPassword.php");
        }


        // echo "Data Stored";
        // header('Location:../../Views/Adopter/Login.php');
    } else {
        // show errors 
        $_SESSION["currPasswordError"] = $currPasswordError;
        $_SESSION["newPasswordError"] = $newPasswordError;
        $_SESSION["reTypePasswordError"] = $reTypePasswordError;
        header('Location:../../Views/Supervisor/ChangePassword.php');
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $_SESSION["currPasswordError"] = "*";
    $_SESSION["newPasswordError"] = "*";
    $_SESSION["reTypePasswordError"] = "*";
}
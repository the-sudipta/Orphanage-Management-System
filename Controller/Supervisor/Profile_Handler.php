<?php
session_start();

// Variable Declaration

require_once '../../Model/Supervisor.php';

if (!isset($_SESSION["loginUser_Name"])) {
    header('Location:../Views/Supervisor/Login/Login.php');
}


// Variables Declaration
$name = "";
$nameError = "";

$email = "";
$emailError = "";

$password = "";
$passwordError = "";

$gender = "";
$genderError = "";

$phone = "";
$phoneError = "";

$address = "";
$addressError = "";

$profession = "";
$professionError = "";

$JSON_Message = "";
$JSON_Error = "";

$everythingOK = FALSE;
$everythingOKCounter = 0;


$_SESSION['S_nameError'] = "";
$_SESSION['S_emailError'] = "";
$_SESSION['S_passwordError'] = "";
$_SESSION['S_genderError']  = "";
$_SESSION['S_phoneError'] = "";
$_SESSION['S_addressError'] = "";
$_SESSION['S_professionError'] = "";

$delete_flag_mail = $_SESSION["P_mail"];
$email = $_SESSION["P_mail"];
$updatedImage = "";





//* Validation for Image


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fileError = "";
    $imageName = "";

    $fileError = "";
    $imageName = "";


    // if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
    // file has been selected and there are no errors

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $target_dir = "../../images/Supervisor_Images/";
        $target_file = $target_dir . basename($_FILES["profilePic"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    }

    // Check if image file is a actual image or fake image
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_FILES["profilePic"]) && !empty($_FILES["profilePic"]["tmp_name"])) {
            $check = getimagesize($_FILES["profilePic"]["tmp_name"]);
            if ($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else if ($_FILES["profilePic"]["size"] > 4000000) { // 4MB in Bytes
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            } else if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                echo "Sorry, only JPG, JPEG, PNG files are allowed.";
                $uploadOk = 0;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }

            // If everything is ok, try to upload file
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
                // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["profilePic"]["tmp_name"], $target_file)) {
                    $imageName = htmlspecialchars(basename($_FILES["profilePic"]["name"])); //* This is the file name
                    $updatedImage = $imageName;
                    $target_file = "" . basename($_FILES["profilePic"]["name"]);
                    $fileError =  "The file " . htmlspecialchars(basename($_FILES["profilePic"]["name"])) . " has been uploaded.";
                } else {
                    $fileError = "Sorry, there was an error uploading your file.";
                }
            }
        }
    }
    // }


}






if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //* Validation for Name
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'];
        $wordCount = str_word_count($name);
        // echo $wordCount;
        if (empty($name)) {
            $nameError = "Name is required";
            $_POST['name'] = "";
            $name = "";
            $everythingOK = FALSE;
            $everythingOKCounter += 1;
            // echo "Name Error 1";
        } elseif ($wordCount < 2) {
            $nameError = "Write at least 2 words";
            $_POST['name'] = "";
            $name = "";
            $everythingOK = FALSE;
            $everythingOKCounter += 1;
            // echo " Error 2";
        } elseif (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
            $nameError = "Only letters and white space and dash allowed";
            $_POST['name'] = "";
            $name = "";
            $everythingOK = FALSE;
            $everythingOKCounter += 1;
            // echo " Error 3";
        } else {
            $everythingOK = TRUE;
        }
    }







    //*  Validation for Phone

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $phone = $_POST['phone'];
        if (empty($phone)) {
            $phoneError = "Phone is required";
            $_POST['phone'] = "";
            $phone = "";
            $everythingOK = FALSE;
            $everythingOKCounter += 1;

            // echo "Phone error 1";
        } else {
            $everythingOK = TRUE;
        }
    }



    //* If everything is ok, then put the data in the database otherwise put errors in session
    // If everything is OK then store the data and go to the Login Page
    if ($everythingOK && $everythingOKCounter == 0) {

        // #region #################################################################
        $P_salary = $_SESSION["P_salary"];

        if ($imageName == "") {
            // Then no image is going to be updated. So, keep the old image
            $updatedImage = $_SESSION["P_image"];
        } else {
            $updatedImage = $imageName;
        }




        $new_data = array(
            'supervisor_mail'          =>      $email,
            'password'     =>     $_SESSION['P_password'],
            'supervisor_name'               =>     $_POST['name'],
            'supervisor_phone'     =>     $_POST['phone'],
            'supervisor_salary'    =>     $P_salary,
            'supervisor_image'     =>     $updatedImage
        );

        $copiedData = $new_data;
        $isSuccessful = update_supervisor_data("supervisor_id ", $_SESSION["P_id"], $new_data);
        if ($isSuccessful) {
            header("Location: ../../Views/Supervisor/Login/Login.php");
        } else {
            header("Location: ../../Views/Supervisor/Profile.php");
        }

        // #endregion ################################################################






    } else {

        $_SESSION['S_nameError'] = $nameError;
        $_SESSION['S_emailError'] = $emailError;
        // $_SESSION['S_passwordError'] = $passwordError;
        // $_SESSION['S_genderError'] = $genderError;
        $_SESSION['S_phoneError'] = $phoneError;
        // $_SESSION['S_addressError'] = $addressError;
        // $_SESSION['S_professionError'] = $professionError;
        echo "Everything is Not ok, There are errors and we are sending to the front page <br>";
        header("Location: ../../Views/Supervisor/Profile.php");
    }
}

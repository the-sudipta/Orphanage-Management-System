<?php
require_once '../../Model/Adopter.php';
session_start();

// Variable Declaration

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

    //*  Validation for Email

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'];
        if (empty($email)) {
            $emailError = "Email is required";
            $_POST['email'] = "";
            $email = "";
            $everythingOK = FALSE;
            $everythingOKCounter += 1;

            // echo "Mail error 1";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailError = "Invalid email format";
            $email = "";
            $everythingOK = FALSE;
            $everythingOKCounter += 1;
            // echo "Mail error 2";
        } else {
            $everythingOK = TRUE;
        }
    }

    //* Password Validation
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $password = $_POST['password'];
        if (empty($password) || strlen($password) < 8) {
            // check if password size in 8 or more and  check if it is empty
            $passwordError = "Write at least 8 Character";
            $_POST['password'] = "";
            $password = "";
            $everythingOK = FALSE;
            $everythingOKCounter += 1;
            // echo "Pass error 1";
        } else if (!preg_match('/[@#$%]/', $password)) {
            // check if password contains at least one special character
            $passwordError = "Password must contain at least one special character (@, #, $, %).";
            $_POST['password'] = "";
            $password = "";
            $everythingOK = FALSE;
            $everythingOKCounter += 1;
            // echo "Pass error 2";
        } else {
            $everythingOK = TRUE;
        }
    }

    //* Validation for Gender
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $gender = $_POST['gender'];
        if (empty($gender)) {
            $genderError = "Gender is required";
            $_POST['gender'] = "";
            $gender = "";
            $everythingOK = FALSE;
            $everythingOKCounter += 1;
            // echo "Gender Error 1";
        } else {
            $gender = $_POST['gender'];
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
        }
        // elseif (is_numeric($phone)) {
        //     $phoneError = "Please input numbers only";
        //     $phone = "";
        //     $everythingOK = FALSE;
        //     $everythingOKCounter += 1;
        //     echo "Phone error 2";
        // }
        else {
            $everythingOK = TRUE;
        }
    }

    //*  Validation for Address

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $address = $_POST['address'];
        if (empty($address)) {
            $addressError = "Phone is required";
            $_POST['address'] = "";
            $address = "";
            $everythingOK = FALSE;
            $everythingOKCounter += 1;

            // echo "Address error 1";
        } else {
            $everythingOK = TRUE;
        }
    }

    //*  Validation for Profession

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $profession = $_POST['profession'];
        if (empty($profession)) {
            $professionError = "Profession is required";
            $_POST['profession'] = "";
            $profession = "";
            $everythingOK = FALSE;
            $everythingOKCounter += 1;

            // echo "Profession error 1";
        } else {
            $everythingOK = TRUE;
        }
    }


    // ! If everything is ok, then put the data in the Table otherwise put errors in session
    // If everything is OK then store the data and go to the Login Page
    if ($everythingOK && $everythingOKCounter == 0) {

        // if(file_exists($fileName))
        // {
        //     $tempAdoption_status = "Not Adopted";
        //     $tempImage = "N/A";
        //     $current_data = file_get_contents($fileName);
        //     $array_data = json_decode($current_data, true);
        //     $new_data = array(
        //         'name'               =>     $_POST['name'],
        //         'e-mail'          =>      $_POST['email'],
        //         'password'     =>     $_POST['password'],
        //         'adoption_status'    =>     $tempAdoption_status,
        //         'gender'     =>     $_POST['gender'],
        //         'phone'     =>     $_POST['phone'],
        //         'address'     =>     $_POST['address'],
        //         'profession'     =>     $_POST['profession'],
        //         'image'     =>     $tempImage
        //     );
        //     $array_data[] = $new_data;

        //     $final_data = json_encode($array_data);
        //     if(file_put_contents($fileName, $final_data))
        //     {
        //         // $message = "<label>File Appended Success fully</p>";
        //         echo "Data Stored";
        //         header('Location:../Views/Adopter/Login.php');
        //     }
        // }
        // else
        // {
        //     // header('Location:../Views/Adopter/SignUp.php');
        // }


        $tempAdoption_status = "Not Adopted";
        $tempImage = "N/A";
        $signup_data = array(

            'adopter_mail'          =>      $_POST['email'],
            'password'     =>     $_POST['password'],
            'adopter_name'               =>     $_POST['name'],
            'adopter_phone'     =>     $_POST['phone'],
            'adopter_image'     =>     $tempImage,
            'adopter_profession'     =>     $_POST['profession'],
            'adopter_gender'     =>     $_POST['gender'],
            'adopter_address'     =>     $_POST['address'],
            'adoption_status'    =>     $tempAdoption_status

        );

        //* Insert the data to Adopter table

        $is_signup_successful =  add_adopter($signup_data);
        if ($is_signup_successful) {
            echo "Data Stored";
            header('Location:../../Views/Adopter/Login/Login.php');
        } else {
            header('Location:../../Views/Adopter/SignUp/SignUp.php');
        }






        // 
    } else {

        $_SESSION['S_nameError'] = $nameError;
        $_SESSION['S_emailError'] = $emailError;
        $_SESSION['S_passwordError'] = $passwordError;
        $_SESSION['S_genderError'] = $genderError;
        $_SESSION['S_phoneError'] = $phoneError;
        $_SESSION['S_addressError'] = $addressError;
        $_SESSION['S_professionError'] = $professionError;
        echo "Everything is Not ok, There are errors and we are sending to the front page <br>";
        header('Location:../../Views/Adopter/SignUp/SignUp.php');
    }
}
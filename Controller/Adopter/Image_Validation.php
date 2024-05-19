<?php 


// * Validation for Image


if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $fileError = "";
    $imageName = "";

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $target_dir = "../images/Adopter_Images/";
        $target_file = $target_dir . basename($_FILES["profilePic"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    }
    
    // Check if image file is a actual image or fake image
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $check = getimagesize($_FILES["profilePic"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            // ! Everything is ok, so try to upload file
            $uploadOk = 1;
        }else if ($_FILES["profilePic"]["size"] > 4000000) { // 4MB in Bytes
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }else if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
            echo "Sorry, only JPG, JPEG, PNG files are allowed.";
            $uploadOk = 0;
        }else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // If everything is ok=1, try to upload file
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["profilePic"]["tmp_name"], $target_file)) {
                $fileName = htmlspecialchars(basename($_FILES["profilePic"]["name"]));
                $target_file = "" . basename($_FILES["profilePic"]["name"]);
                $fileError =  "The file ". htmlspecialchars( basename( $_FILES["profilePic"]["name"])). " has been uploaded.";
            } else {
                $fileError = "Sorry, there was an error uploading your file.";
            }
        }

    }


}



?>
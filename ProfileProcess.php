<?php

require "Connection.php";

session_start();

if (isset($_POST["user"]) && isset($_POST["email"]) && isset($_POST["password"])) {

    $user = $_POST["user"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    $fname = $_POST["fname"];
    $lname = $_POST["lname"];

    if (empty($fname)) {
        echo "Please Enter Your First Name";
    } else if (empty($lname)) {
        echo "Please Enter Your Last Name";
    } else if (empty($password)) {
        echo "Please Enter Your Password";
    } else if (strlen($password) <= 8) {
        echo "Password must be more than 8 characters";
    } else if (!preg_match("#[0-9]#", $password)) {
        echo "Password Must Contains Numbers";
    } else {

        Database::iud("UPDATE `" . $user . "` SET `fname` = '" . $fname . "',`lname` = '" . $lname . "',`password` = '" . $password . "' WHERE `email` = '" . $email . "'");

        $_SESSION["user"]["fname"] = $fname;
        $_SESSION["user"]["lname"] = $lname;
        $_SESSION["user"]["password"] = $password;

        if (isset($_FILES["img"])) {

            $allowed_image_extension = array("png", "jpg", "jpeg", "svg");

            $file_extension = pathinfo($_FILES["img"]["name"], PATHINFO_EXTENSION);

            if (in_array($file_extension, $allowed_image_extension)) {
                $FileName = "Resources//UserProfile//" . uniqid() . $_FILES["img"]["name"];
                move_uploaded_file($_FILES["img"]["tmp_name"], $FileName);

                $profilers = Database::search("SELECT * FROM `" . $user . "image` WHERE `" . $user . "_id` = '" . $_SESSION["user"]["id"] . "'");

                if ($profilers->num_rows == 1) {
                    Database::iud("UPDATE `" . $user . "image` SET `path` = '" . $FileName . "' WHERE `" . $user . "_id` = '" . $_SESSION["user"]["id"] . "'");
                } else {
                    Database::iud("INSERT INTO `" . $user . "image`(`path`,`" . $user . "_id`) VALUES('" . $FileName . "','" . $_SESSION["user"]["id"] . "')");
                }
            } else {
                echo "Please Select Valid Image. You Can Select Only PNG, JPG, JPEG or SVG Files";
            }
        }

        echo "Success";
    }
} else {
    echo "Invalid Request";
}

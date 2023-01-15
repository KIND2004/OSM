<?php

session_start();

require "Connection.php";

if (isset($_POST["user"]) && isset($_POST["username"]) && isset($_POST["password"])) {

    $username = $_POST["username"];
    $password = $_POST["password"];
    $user = $_POST["user"];

    if (empty($username)) {
        echo "Please Enter Your Username";
    } else if (empty($password)) {
        echo "Please Enter Your Password";
    } else {

        $ResultSet = Database::search("SELECT * FROM `" . $user . "` WHERE `username` = '" . $username . "' AND `password` = '" . $password . "'");

        if ($ResultSet->num_rows == 1) {
            $UserDetails = $ResultSet->fetch_assoc();

            if ($user == "Techer") {

                if ($UserDetails["verification_status_id"] == 2) {
                    echo "UnVerified";
                } else {
                    echo "Success";
                }
            } else if ($user == "AcademicOfficer") {

                if ($UserDetails["verification_status_id"] == 2) {
                    echo "UnVerified";
                } else {
                    echo "Success";
                }
            } else if ($user == "Student") {

                if ($UserDetails["verification_status_id"] == 2) {
                    echo "UnVerified";
                } else {
                    echo "Success";
                }
            } else {
                echo "Success";
            }

            $UserDetails["user_type"] = $user;

            $_SESSION["user"] = $UserDetails;
        } else {
            echo "Invalid Details";
        }
    }
} else {
    echo "Invalid Request";
}

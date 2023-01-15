<?php

require "Connection.php";

session_start();

if (isset($_SESSION["user"])) {

    if (isset($_POST["id"])) {

        $id = $_POST["id"];

        $marks = $_POST["marks"];

        $ResultSet = Database::search("SELECT * FROM `assignment_marks` WHERE `id` = '" . $id . "'");

        if ($ResultSet->num_rows == 1) {

            if (empty($marks)) {
                echo "Please Enter Marks";
            } else if ($marks > 100) {
                echo "Invalid Marks";
            } else {

                Database::iud("UPDATE `assignment_marks` SET `marks` = '" . $marks . "' WHERE `id` = '" . $id . "'");

                echo "Success";
            }
        } else {
            echo "Invalid Request";
        }
    } else {
        echo "Invalid Request";
    }
} else {
    echo "Invalid Request";
}

<?php

require "Connection.php";

session_start();

if (isset($_SESSION["user"])) {

    if (isset($_POST["id"]) && isset($_POST["updateGrade"])) {

        $id = $_POST["id"];
        $updateGrade = $_POST["updateGrade"];

        if ($updateGrade == "0") {
            echo "Please Select a Grade";
        } else {
            Database::iud("UPDATE `student` SET `grade_id` = '" . $updateGrade . "' WHERE `id` = '" . $id . "'");
            echo "Success";
        }
    } else {
        echo "Invalid Request";
    }
} else {

    echo "Invalid Request";
}

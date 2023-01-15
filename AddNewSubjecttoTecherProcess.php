<?php

require "Connection.php";

session_start();

if (isset($_SESSION["user"])) {

    if (isset($_POST["subject"]) && isset($_POST["grade"]) && isset($_POST["id"])) {

        $subject = $_POST["subject"];
        $grade = $_POST["grade"];
        $id = $_POST["id"];

        if ($subject == "0") {
            echo "Please Select a Subject";
        } else if ($grade == "0") {
            echo "Please Select a Grade";
        } else {

            $ResultSet = Database::search("SELECT * FROM `teacher_has_subject` WHERE `subject_id` = '" . $subject . "' AND `grade_id` = '" . $grade . "'");

            if ($ResultSet->num_rows == 1) {
                echo "This Subject Alrady Assigned to this Grade";
            } else {

                Database::iud("INSERT INTO `teacher_has_subject`(`teacher_id`,`subject_id`,`grade_id`) VALUES('" . $id . "','" . $subject . "','" . $grade . "')");
                echo "Success";
            }
        }
    } else {
        echo "Invalid Request";
    }
} else {
    echo "Invalid Request";
}

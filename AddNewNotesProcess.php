<?php

require "Connection.php";

session_start();

if (isset($_SESSION["user"])) {

    if (isset($_POST["subject"]) && isset($_POST["grade"]) && isset($_POST["id"]) && isset($_FILES["note"])) {

        $subject = $_POST["subject"];
        $grade = $_POST["grade"];
        $id = $_POST["id"];

        if ($subject == "0") {
            echo "Please Select a Subject";
        } else if ($grade == "0") {
            echo "Please Select a Grade";
        } else if (empty($_FILES["note"])) {
            echo "Please Select a File";
        } else {

            $allowed_image_extension = array("pdf");

            $file_extension = pathinfo($_FILES["note"]["name"], PATHINFO_EXTENSION);

            if (in_array($file_extension, $allowed_image_extension)) {
                $FileName = "Resources//Notes//" . uniqid() . $_FILES["note"]["name"];
                move_uploaded_file($_FILES["note"]["tmp_name"], $FileName);

                $ResultSet = Database::search("SELECT `teacher_has_subject`.`id` FROM `teacher_has_subject` WHERE `subject_id` = '" . $subject . "' AND `grade_id` = '" . $grade . "' AND `teacher_id` = '" . $id . "'");

                if ($ResultSet->num_rows == 1) {

                    $TeacherHasSubjectId = $ResultSet->fetch_assoc();

                    $d = new DateTime();
                    $tz = new DateTimeZone("Asia/Colombo");
                    $d->setTimezone($tz);
                    $date = $d->format("Y-m-d H:i:s");

                    Database::iud("INSERT INTO `notes`(`date`,`teacher_has_subject_id`,`path`) VALUES('" . $date . "','" . $TeacherHasSubjectId["id"] . "','" . $FileName . "')");
                    echo "Success";
                } else {
                    echo "Invalid Request";
                }
            } else {
                echo "You Can Select Only PDF Files";
            }
        }
    } else {
        echo "Invalid Request";
    }
} else {
    echo "Invalid Request";
}

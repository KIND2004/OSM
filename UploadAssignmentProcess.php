<?php

require "Connection.php";

session_start();

if (isset($_SESSION["user"]) && isset($_POST["id"])) {

    $id = $_POST["id"];

    if (isset($_FILES["result"])) {
        $allowed_image_extension = array("pdf");

        $file_extension = pathinfo($_FILES["result"]["name"], PATHINFO_EXTENSION);

        if (in_array($file_extension, $allowed_image_extension)) {
            $FileName = "Resources//Results//" . uniqid() . $_FILES["result"]["name"];
            move_uploaded_file($_FILES["result"]["tmp_name"], $FileName);

            $ResultSet = Database::search("SELECT * FROM `assignments` WHERE `id` = '" . $id . "'");

            if ($ResultSet->num_rows == 1) {

                $d = new DateTime();
                $tz = new DateTimeZone("Asia/Colombo");
                $d->setTimezone($tz);
                $date = $d->format("Y-m-d H:i:s");

                Database::iud("INSERT INTO `assignment_marks`(`date`,`assignments_id`,`student_id`,`path`) VALUES('" . $date . "','" . $id . "','" . $_SESSION["user"]["id"] . "','" . $FileName . "')");
                echo "Success";
            } else {
                echo "Invalid Request";
            }
        } else {
            echo "You Can Select Only PDF Files";
        }
    } else {
        echo "Please Select a File";
    }
} else {
    echo "Invalid Request";
}

<?php

require "Connection.php";

session_start();

if (isset($_SESSION["user"])) {

    if (isset($_GET["id"])) {

        $id = $_GET["id"];

        $ResultSet = Database::search("SELECT * FROM `assignment_marks` WHERE `id` = '" . $id . "'");

        if ($ResultSet->num_rows == 1) {

            $d = new DateTime();
            $tz = new DateTimeZone("Asia/Colombo");
            $d->setTimezone($tz);
            $date = $d->format("Y-m-d H:i:s");

            Database::iud("INSERT INTO `released_marks`(`assignment_marks_id`,`date`) VALUES('" . $id . "','" . $date . "')");

            echo "Success";
        } else {
            echo "Invalid Request";
        }
    } else {
        echo "Invalid Request";
    }
} else {
    echo "Invalid Request";
}

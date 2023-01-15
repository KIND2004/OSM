<?php

require "Connection.php";

$username = $_POST["username"];
$code = $_POST["code"];
$user = $_POST["user"];

if (empty($username)) {
    echo "Please Enter Username";
} else if (empty($code)) {
    echo "Please Enter Verification Code";
} else {

    $ResultSet = Database::search("SELECT * FROM `" . $user . "` WHERE `username` = '" . $username . "' AND `verification_code` = '" . $code . "'");

    if ($ResultSet->num_rows == "1") {

        Database::iud("UPDATE `" . $user . "` SET `verification_status_id` = '1' WHERE `verification_code` = '" . $code . "'");

        echo "Success";
    } else {
        echo "Invalid Code";
    }
}

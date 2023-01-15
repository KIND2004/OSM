<?php

require "Connection.php";

session_start();

if (isset($_SESSION["user"])) {

    if (isset($_GET["user"]) && isset($_GET["id"])) {

        $user = $_GET["user"];
        $userid = $_GET["id"];

        $ResultSet = Database::search("SELECT `status_id` FROM `" . $user . "` WHERE `id` = '" . $userid . "'");

        $userStatus = $ResultSet->fetch_assoc();

        if ($userStatus["status_id"] == 1) {

            Database::iud("UPDATE `" . $user . "` SET `status_id` = '2' WHERE `id` = '" . $userid . "'");
        } else {

            Database::iud("UPDATE `" . $user . "` SET `status_id` = '1' WHERE `id` = '" . $userid . "'");
        }

        echo "Success";

    } else {

        echo "Invalid Request";
    }
} else {

    echo "Invalid Request";
}

<?php

require "Connection.php";

session_start();

if (isset($_SESSION["user"]) && isset($_GET["id"])) {

    $id = $_GET["id"];

    $ResultSet = Database::search("SELECT * FROM `notes` WHERE `id` = '" . $id . "'");

    if ($ResultSet->num_rows == 1) {

        Database::iud("DELETE FROM `notes` WHERE `id` = '" . $id . "'");

        echo "Success";
    } else {
        echo "Invalid Request";
    }
} else {
    echo "Invalid Request";
}

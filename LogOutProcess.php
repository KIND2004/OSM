<?php

session_start();

if (isset($_GET["user"])) {

    if (isset($_SESSION["user"])) {
        session_destroy();

        echo "Success";
    } else {
        echo "Invalid Request";
    }
} else {
    echo "Invalid Request";
}

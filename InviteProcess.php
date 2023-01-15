<?php

require "Connection.php";

require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;

$email = $_POST["email"];
$username = $_POST["username"];
$password = $_POST["password"];
$user = $_POST["user"];

$code = uniqid();

if (empty($email)) {
    echo "Please Enter Email";
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Invalid email address";
} else if (strlen($email) > 40) {
    echo "email must be leass than 40 characters";
} else if (empty($username)) {
    echo "Please Enter Username";
} else if (empty($password)) {
    echo "Please enter your password";
} else if (strlen($password) <= 8) {
    echo "Password must be more than 8 characters";
} else if (!preg_match("#[0-9]#", $password)) {
    echo "Password must contains numbers";
} else {

    $ResultSet = Database::search("SELECT * FROM `" . $user . "` WHERE `username` = '" . $username . "'");

    if ($ResultSet->num_rows == 1) {
        echo "This Username Already Exists";
    } else {

        if ($user == "Student") {
            $grade = $_POST["grade"];

            if ($grade == "0") {
                echo "Please Select a Grade";
            } else {
                Database::iud("INSERT INTO `" . $user . "`(`email`,`username`,`password`,grade_id,`verification_code`,`verification_status_id`,`status_id`) VALUES('" . $email . "','" . $username . "','" . $password . "','" . $grade . "','" . $code . "','2','1')");
            }
        } else {

            Database::iud("INSERT INTO `" . $user . "`(`email`,`username`,`password`,`verification_code`,`verification_status_id`,`status_id`) VALUES('" . $email . "','" . $username . "','" . $password . "','" . $code . "','2','1')");
        }

        $mail = new PHPMailer;
        $mail->IsSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'abdullahzufar414@gmail.com';
        $mail->Password = 'awowynomgttfmugm';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom('abdullahzufar414@gmail.com', 'Java Institute');
        $mail->addReplyTo('abdullahzufar414@gmail.com', 'Java Institute');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'Invitation';
        $bodyContent = '<h1 style="color: red;">' . $user . ' Invitation</h1>
                        <span style="font-weight: bold;">Your Username : ' . $username . '</span>
                        <br />
                        <span style="font-weight: bold;">Your Password : ' . $password . '</span>
                        <br />
                        <span style="font-weight: bold;">Your Verification Code : ' . $code . '</span>
                        <br />
                        <a href="http://localhost/WebProgrammingExam/LogIn.php?user=' . $user . '">Click Here to LogIn</a>';
        $mail->Body    = $bodyContent;

        if (!$mail->send()) {
            echo "Verification Code sending fail";
        } else {
            echo 'Success';
        }
    }
}

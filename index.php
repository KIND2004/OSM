<?php

session_start();

if (isset($_SESSION["user"])) {

    $userType = $_SESSION["user"]["user_type"];

    if ($userType == "Admin") {
?>
        <script>
            window.location = "AdminHome.php";
        </script>
    <?php
    } else if ($userType == "Teacher") {
    ?>
        <script>
            window.location = "TeacherHome.php";
        </script>
    <?php
    } else if ($userType == "AcademicOfficer") {
    ?>
        <script>
            window.location = "AcademicOfficerHome.php";
        </script>
    <?php
    } else if ($userType == "Student") {
    ?>
        <script>
            window.location = "StudentHome.php";
        </script>
    <?php
    }
} else {

    ?>

    <!DOCTYPE html>

    <html>

    <head>
        <title>Java Institute</title>
        <?php require "Link.php"; ?>
    </head>

    <body>

        <div class="container-fluid">
            <div class="row">

                <!-- Logo -->
                <?php require "Logo.php"; ?>
                <!-- Logo -->

                <!-- Login -->
                <div class="col-12">
                    <div class="row justify-content-center mt-5">
                        <div class="col-2 text-center">
                            <a class="text-decoration-none text-black" href="LogIn.php?user=Admin">
                                <i class="bi bi-person-plus-fill fs-1"></i>
                                <br />
                                <span>Admin</span>
                            </a>
                        </div>
                        <div class="col-2 text-center">
                            <a class="text-decoration-none text-black" href="LogIn.php?user=Teacher">
                                <i class="bi bi-person-video3 fs-1"></i>
                                <br />
                                <span>Teacher</span>
                            </a>
                        </div>
                        <div class="col-2 text-center">
                            <a class="text-decoration-none text-black" href="LogIn.php?user=Student">
                                <i class="bi bi-mortarboard-fill fs-1"></i>
                                <br />
                                <span>Student</span>
                            </a>
                        </div>
                        <div class="col-2 text-center">
                            <a class="text-decoration-none text-black" href="LogIn.php?user=AcademicOfficer">
                                <i class="bi bi-person-fill fs-1"></i>
                                <br />
                                <span>Academic Officer</span>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Login -->

                <!-- Footer -->
                <?php require "Footer.php"; ?>
                <!-- Footer -->

            </div>
        </div>

        <?php require "Script.php"; ?>
    </body>

    </html>

<?php
}
?>
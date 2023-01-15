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

    <?php

    $user = $_GET["user"];

    ?>

    <!DOCTYPE html>

    <html>

    <head>
        <title><?php echo $user ?> Login</title>
        <?php require "Link.php"; ?>
    </head>

    <body>

        <div class="container-fluid">
            <div class="row">

                <div class="col-12">
                    <div class="row my-5">
                        <div class="col-12 text-center text-capitalize">
                            <span class="fw-bolder fs-1 fst-italic"><?php echo $user ?> Login</span>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="row mt-5">

                        <!-- Logo -->
                        <div class="col-lg-6 LoginLogo">

                        </div>
                        <!-- Logo -->

                        <!-- Content -->
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-12">
                                    <div class="row justify-content-center g-3">
                                        <div class="col-8">
                                            <label class="form-label">Username</label>
                                            <input type="email" class="form-control" id="username" />
                                        </div>
                                        <div class="col-8">
                                            <label class="form-label">Password</label>
                                            <input type="password" class="form-control" id="password" />
                                        </div>
                                        <div class="col-8 d-grid">
                                            <button class="btn btn-primary" onclick="Login('<?php echo $user ?>');">Log In</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Content -->

                    </div>
                </div>

                <!-- Verfication Model -->
                <div class="modal fade" tabindex="-1" id="code">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title"><?php echo $user; ?> Verification</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                <div class="row g-3">
                                    <div class="col-12">
                                        <label class="form-label">Verification Code</label>
                                        <input class="form-control" type="text" id="verification_code" />
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" onclick="Verify('<?php echo $user; ?>');">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Verfication Model -->

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
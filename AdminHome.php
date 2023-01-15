<?php

session_start();

if (isset($_SESSION["user"])) {

?>

    <!DOCTYPE html>

    <html>

    <head>
        <title>Admin Home</title>
        <?php require "Link.php"; ?>
    </head>

    <body>

        <div class="container-fluid">
            <div class="row">

                <div class="col-12">
                    <div class="row bg-light">

                        <?php require "AdminHeader.php"; ?>

                    </div>
                </div>

                <div class="col-12">
                    <div class="row py-3">

                        <div class="col-12 text-center">
                            <span class="fs-1 fw-bold text-capitalize">Welcome</span>
                        </div>

                        <div class="col-12 text-center">
                            <span class="fs-1 fw-bold text-capitalize"><?php echo $_SESSION["user"]["username"]; ?></span>
                        </div>

                    </div>
                </div>

                <div class="col-12">
                    <div class="row">

                        <div class="col-12">
                            <div class="row justify-content-center p-3 g-3">

                                <div class="col-12 col-md-6 col-lg-5 d-grid">
                                    <a href="ManageUsers.php?user=Teacher" class="btn btn-danger py-3 fw-bolder">Manage Teachers</a>
                                </div>

                                <div class="col-12 col-md-6 col-lg-5 d-grid">
                                    <a href="ManageUsers.php?user=AcademicOfficer" class="btn btn-danger py-3 fw-bolder">Manage Academic Officers</a>
                                </div>

                                <div class="col-12 col-md-6 col-lg-5 d-grid">
                                    <a  href="ManageUsers.php?user=Student" class="btn btn-danger py-3 fw-bolder">Manage Students</a>
                                </div>

                                <div class="col-12 col-md-6 col-lg-5 d-grid">
                                    <a href="Invite.php?user=Teacher" class="btn btn-primary py-3 fw-bolder">Invite Teachers</a>
                                </div>

                                <div class="col-12 col-md-6 col-lg-5 d-grid">
                                    <a href="Invite.php?user=AcademicOfficer" class="btn btn-primary py-3 fw-bolder">Invite Academic Officers</a>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>

        <?php require "Script.php"; ?>
    </body>

    </html>

<?php

} else {

?>

    <script>
        window.location = "index.php";
    </script>

<?php

}

?>
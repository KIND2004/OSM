<?php

session_start();

if (isset($_SESSION["user"])) {

?>

    <!DOCTYPE html>

    <html>

    <head>
        <title>Teacher Home</title>
        <?php require "Link.php"; ?>
    </head>

    <body>

        <div class="container-fluid">
            <div class="row">

                <div class="col-12">
                    <div class="row bg-light">

                        <?php require "TeacherHeader.php"; ?>

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
                                    <a href="AddNotes.php" class="btn btn-primary py-3 fw-bolder">Add Notes</a>
                                </div>

                                <div class="col-12 col-md-6 col-lg-5 d-grid">
                                    <a href="AddAssignments.php" class="btn btn-success py-3 fw-bolder">Assignments</a>
                                </div>

                                <div class="col-12 col-md-6 col-lg-5 d-grid">
                                    <a href="AssignmentMarks.php?id=<?php echo $_SESSION["user"]["id"]; ?>" class="btn btn-danger py-3 fw-bolder">Assignment Marks</a>
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
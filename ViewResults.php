<?php

require "Connection.php";

session_start();

if (isset($_SESSION["user"]) && isset($_GET["id"])) {

    $id = $_GET["id"];

?>

    <!DOCTYPE html>

    <html>

    <head>
        <title>VIEW RESULTS</title>
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
                            <span class="fs-1 fw-bold text-capitalize">VIEW RESULTS</span>
                        </div>

                    </div>
                </div>

                <div class="col-12">
                    <div class="row justify-content-center">

                        <div class="col-12 col-md-8 col-lg-6">
                            <table class="table">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col">USERNAME</th>
                                        <th scope="col">DATE</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php

                                    $ResultSet = Database::search("SELECT `assignment_marks`.`path`, `assignment_marks`.`date`, `student`.`username` 
                                    FROM `assignment_marks` 
                                    INNER JOIN `student` ON `assignment_marks`.`student_id` = `student`.`id`
                                    WHERE `assignments_id` = '" . $id . "'");

                                    for ($i = 0; $i < $ResultSet->num_rows; $i++) {

                                        $marksDetails = $ResultSet->fetch_assoc();

                                    ?>
                                        <tr>
                                            <td><?php echo $marksDetails["username"]; ?></td>
                                            <td><?php echo $marksDetails["date"]; ?></td>
                                            <td><a href="<?php echo $marksDetails["path"]; ?>" class="text-decoration-none text-success fw-bold">View Results</a></td>
                                        </tr>
                                    <?php

                                    }

                                    ?>

                                </tbody>
                            </table>
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
    echo "Invalid Request";
}

?>
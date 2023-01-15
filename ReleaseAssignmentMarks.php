<?php

require "Connection.php";

session_start();

if (isset($_SESSION["user"])) {

?>

    <!DOCTYPE html>

    <html>

    <head>
        <title>ASSIGNMENT MARKS</title>
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
                            <span class="fs-1 fw-bold text-capitalize">ASSIGNMENT MARKS</span>
                        </div>

                    </div>
                </div>

                <div class="col-12">
                    <div class="row justify-content-center">

                        <div class="col-12 col-md-8 col-lg-6">
                            <table class="table">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col">ASSIGNMENT ID</th>
                                        <th scope="col">STUDENT ID</th>
                                        <th scope="col">USERNAME</th>
                                        <th scope="col">MARKS</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php

                                    $ResultSet = Database::search("SELECT `assignment_marks`.`id`, `assignment_marks`.`marks`, `assignment_marks`.`assignments_id`, `student`.`id` AS `student_id`, `student`.`username` 
                                    FROM `assignment_marks` 
                                    INNER JOIN `student` ON `assignment_marks`.`student_id` = `student`.`id` ORDER BY `assignments_id` ASC");

                                    for ($i = 0; $i < $ResultSet->num_rows; $i++) {

                                        $marksDetails = $ResultSet->fetch_assoc();

                                    ?>
                                        <tr>

                                            <?php

                                            if ($marksDetails["marks"] != null) {
                                            ?>
                                                <td><?php echo $marksDetails["assignments_id"]; ?></td>
                                                <td><?php echo $marksDetails["student_id"]; ?></td>
                                                <td><?php echo $marksDetails["username"]; ?></td>
                                                <td><?php echo $marksDetails["marks"]; ?></td>
                                                <?php
                                                $ResultSet2 = Database::search("SELECT * FROM `released_marks` WHERE `assignment_marks_id` = '" . $marksDetails["id"] . "'");
                                                if ($ResultSet2->num_rows == 1) {
                                                ?>
                                                    <td class="text-danger">Released</td>
                                                <?php
                                                } else {
                                                ?>
                                                    <td class="text-success" style="cursor: pointer;" onclick="ReleaseMarks('<?php echo $marksDetails['id']; ?>');">Release</td>
                                                <?php
                                                }

                                                ?>

                                            <?php
                                            }
                                            ?>

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
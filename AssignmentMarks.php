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
                                            <td><?php echo $marksDetails["assignments_id"]; ?></td>
                                            <td><?php echo $marksDetails["student_id"]; ?></td>
                                            <td><?php echo $marksDetails["username"]; ?></td>

                                            <?php

                                            if ($marksDetails["marks"] != null) {
                                            ?>
                                                <td><?php echo $marksDetails["marks"]; ?></td>
                                            <?php
                                            } else {
                                            ?>
                                                <td class="text-success" style="cursor: pointer;" onclick="AddAssignmentMarksModal('<?php echo $marksDetails['id']; ?>');">ADD</td>
                                            <?php
                                            }

                                            ?>


                                        </tr>

                                        <div class="modal fade" id="AddAssignmentMarksModal<?php echo $marksDetails['id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel">Add Assignment Marks</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="col-12">
                                                            <div class="row g-2">
                                                                <div class="col-12">
                                                                    <label class="form-label">Marks</label>
                                                                    <input type="number" class="form-control" id="marks<?php echo $marksDetails['id']; ?>" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-primary" onclick="AddMarks('<?php echo $marksDetails['id']; ?>');">Add</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

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
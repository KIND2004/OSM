<?php

require "Connection.php";

session_start();

if (isset($_SESSION["user"]) && isset($_GET["user"]) && isset($_GET["id"])) {

    $user = $_GET["user"];
    $userid = $_GET["id"];

    $ResultSet = Database::search("SELECT * FROM `" . $user . "` WHERE `id` = '" . $userid . "'");

    if ($ResultSet->num_rows == 1) {

        $userDetails = $ResultSet->fetch_assoc();

?>

        <!DOCTYPE html>

        <html>

        <head>
            <title><?php echo $userDetails["username"]; ?></title>
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
                        <div class="row py-2">

                            <div class="col-12 text-center">
                                <span class="fw-bolder fs-1 text-black-50"><?php echo $userDetails["username"]; ?></span>
                            </div>

                        </div>
                    </div>

                    <div class="col-12">
                        <div class="row">

                            <div class="col-12">
                                <div class="row justify-content-center">

                                    <div class="col-10 col-md-6 col-lg-4">
                                        <div class="row">

                                            <div class="col-12">
                                                <div class="row gy-3 px-2 py-3">

                                                    <div class="col-12">
                                                        <div class="row justify-content-center gy-2">

                                                            <?php

                                                            $ResultSet2 = Database::search("SELECT * FROM `" . $user . "image` WHERE `" . $user . "_id` = '" . $userid . "'");

                                                            if ($ResultSet2->num_rows == 1) {

                                                                $userImg = $ResultSet2->fetch_assoc();

                                                            ?>
                                                                <div class="col-12 text-center">
                                                                    <img class="rounded-circle border border-1 border-dark" height="150px" width="150px" src="<?php echo $userImg['path']; ?>" />
                                                                </div>
                                                            <?php

                                                            } else {

                                                            ?>
                                                                <div class="col-12 text-center">
                                                                    <img class="rounded-circle border border-1 border-dark" height="150px" width="150px" src="Resources/user.svg" />
                                                                </div>
                                                            <?php

                                                            }

                                                            ?>

                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="row">

                                                            <div class="col-6">
                                                                <label class="form-label fw-bold">First Name</label>
                                                                <input type="text" class="form-control" value="<?php echo $userDetails["fname"]; ?>" disabled />
                                                            </div>

                                                            <div class="col-6">
                                                                <label class="form-label fw-bold">Last Name</label>
                                                                <input type="text" class="form-control" value="<?php echo $userDetails["lname"]; ?>" disabled />
                                                            </div>

                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <label class="form-label fw-bold">Email</label>
                                                        <input type="email" class="form-control" value="<?php echo $userDetails["email"]; ?>" disabled />
                                                    </div>

                                                    <div class="col-12">
                                                        <label class="form-label fw-bold">Username</label>
                                                        <input type="text" class="form-control" value="<?php echo $userDetails["username"]; ?>" disabled />
                                                    </div>

                                                    <div class="col-12">
                                                        <label class="form-label fw-bold">Password</label>
                                                        <input type="text" class="form-control" value="<?php echo $userDetails["password"]; ?>" disabled />
                                                    </div>

                                                    <?php

                                                    if ($user == "Student") {
                                                        $ResultSet5 = Database::search("SELECT * FROM `grade` WHERE `id` = '" . $userDetails["grade_id"] . "'");
                                                        $studentgrade = $ResultSet5->fetch_assoc();
                                                    ?>
                                                        <div class="col-12">
                                                            <label class="form-label fw-bold">Grade</label>
                                                            <div class="input-group">
                                                                <input type="text" value="<?php echo $studentgrade["name"]; ?>" class="form-control" aria-describedby="button-addon2">
                                                                <button class="btn btn-outline-danger" type="button" id="button-addon2" onclick="ChangeGradeModal();">Change Grade</button>
                                                            </div>
                                                        </div>

                                                        <div class="modal fade" id="ChangeGradeModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="staticBackdropLabel">Update Grade</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="col-12">
                                                                            <div class="row g-2">
                                                                                <div class="col-12">
                                                                                    <label class="form-label">Grade</label>
                                                                                    <select class="form-select" id="updateGrade">
                                                                                        <option value="0">Select</option>
                                                                                        <?php
                                                                                        $ResultSet6 = Database::search("SELECT * FROM `grade`");
                                                                                        for ($i = 0; $i < $ResultSet6->num_rows; $i++) {
                                                                                            $GradeDetails = $ResultSet6->fetch_assoc();
                                                                                        ?>
                                                                                            <option value="<?php echo $GradeDetails["id"]; ?>"><?php echo $GradeDetails["name"]; ?></option>
                                                                                        <?php
                                                                                        }
                                                                                        ?>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-primary" onclick="UpdateGrade('<?php echo $userid; ?>');">Add</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    <?php
                                                    }

                                                    ?>

                                                    <div class="col-12">
                                                        <label class="form-label fw-bold">Verification Status</label>
                                                        <?php

                                                        if ($userDetails["verification_status_id"] == 1) {

                                                        ?>
                                                            <input type="text" class="form-control" value="Verified" disabled />
                                                        <?php

                                                        } else {

                                                        ?>
                                                            <input type="text" class="form-control" value="Unverified" disabled />
                                                        <?php

                                                        }


                                                        ?>
                                                    </div>

                                                    <div class="col-12">
                                                        <label class="form-label fw-bold"><?php echo $user; ?> Status</label>
                                                        <?php

                                                        if ($userDetails["status_id"] == 1) {

                                                        ?>
                                                            <div class="input-group">
                                                                <input type="text" value="Active" class="form-control" aria-describedby="button-addon2">
                                                                <button class="btn btn-outline-danger" type="button" id="button-addon2" onclick="ChangeStatus('<?php echo $user; ?>','<?php echo $userid; ?>');">Change Status</button>
                                                            </div>
                                                        <?php

                                                        } else {

                                                        ?>
                                                            <div class="input-group">
                                                                <input type="text" value="Dective" class="form-control" aria-describedby="button-addon2">
                                                                <button class="btn btn-outline-success" type="button" id="button-addon2" onclick="ChangeStatus('<?php echo $user; ?>','<?php echo $userid; ?>');">Change Status</button>
                                                            </div>
                                                        <?php

                                                        }

                                                        ?>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-12">
                        <div class="row justify-content-center">

                            <div class="col-10 col-md-6 col-lg-4">
                                <hr class="border border-3 border-danger" />
                            </div>

                        </div>
                    </div>

                    <?php

                    if ($user == "Teacher") {
                    ?>

                        <div class="col-12">
                            <div class="row justify-content-center">

                                <div class="col-10 col-md-6 col-lg-4">
                                    <div class="row">

                                        <div class="col-12">
                                            <table class="table">
                                                <thead class="table-dark">
                                                    <tr>
                                                        <th scope="col">SUBJECT</th>
                                                        <th scope="col">GRADE</th>
                                                        <th scope="col"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php

                                                    $ResultSet = Database::search("SELECT `teacher_has_subject`.`id`, `subject`.`name` AS `subject`,`grade`.`name` AS `grade` FROM `teacher_has_subject` INNER JOIN `subject` ON `teacher_has_subject`.`subject_id` = `subject`.`id` INNER JOIN `grade` ON `teacher_has_subject`.`grade_id` = `grade`.`id` WHERE `teacher_id` = '" . $userid . "'");

                                                    for ($i = 0; $i < $ResultSet->num_rows; $i++) {

                                                        $teacherHasSubject = $ResultSet->fetch_assoc();

                                                    ?>
                                                        <tr>
                                                            <td><?php echo $teacherHasSubject["subject"]; ?></td>
                                                            <td><?php echo $teacherHasSubject["grade"]; ?></td>
                                                            <td><i class="bi bi-x-circle-fill text-danger" style="cursor: pointer;" onclick="RemoveTeacherHasSubject('<?php echo $teacherHasSubject['id']; ?>');"></i></td>
                                                        </tr>
                                                    <?php

                                                    }

                                                    ?>

                                                    <tr>
                                                        <td colspan="2" class="text-center"><button class="btn btn-link text-decoration-none" onclick="AddNewSubjecttoTecherModal();"><i class="bi bi-plus-circle"></i> Add New</button></td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>

                                <div class="modal fade" id="AddNewSubjecttoTecherModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Add New Subject to Teacher</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="col-12">
                                                    <div class="row g-2">
                                                        <div class="col-12">
                                                            <label class="form-label">Select Subject</label>
                                                            <select class="form-select" id="subject">
                                                                <option value="0">Select</option>
                                                                <?php
                                                                $ResultSet3 = Database::search("SELECT * FROM `subject`");
                                                                for ($i = 0; $i < $ResultSet3->num_rows; $i++) {
                                                                    $Subject = $ResultSet3->fetch_assoc();
                                                                ?>
                                                                    <option value="<?php echo $Subject["id"]; ?>"><?php echo $Subject["name"]; ?></option>
                                                                <?php
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="col-12">
                                                            <label class="form-label">Select Grade</label>
                                                            <select class="form-select" id="grade">
                                                                <option value="0">Select</option>
                                                                <?php
                                                                $ResultSet4 = Database::search("SELECT * FROM `grade`");
                                                                for ($i = 0; $i < $ResultSet4->num_rows; $i++) {
                                                                    $Grade = $ResultSet4->fetch_assoc();
                                                                ?>
                                                                    <option value="<?php echo $Grade["id"]; ?>"><?php echo $Grade["name"]; ?></option>
                                                                <?php
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary" onclick="AddNewSubjecttoTecher('<?php echo $userid; ?>');">Add</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    <?php
                    }
                    ?>

                    <?php

                    if ($user == "Student") {
                    ?>

                        <div class="col-12">
                            <div class="row justify-content-center">

                                <div class="col-10 col-md-6 col-lg-4">
                                    <div class="row">

                                        <div class="col-12">
                                            <table class="table">
                                                <thead class="table-dark">
                                                    <tr>
                                                        <th scope="col">ASSIGNMENT ID</th>
                                                        <th scope="col">SUBJECT</th>
                                                        <th scope="col">GRADE</th>
                                                        <th scope="col">MARKS</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php

                                                    $ResultSet = Database::search("SELECT `assignment_marks`.`marks`, `assignment_marks`.`assignments_id`, `subject`.`name` AS `subject`, `grade`.`name` AS `grade` 
                                                    FROM `assignment_marks` 
                                                    INNER JOIN `released_marks` 
                                                    ON `assignment_marks`.`id` = `released_marks`.`assignment_marks_id` 
                                                    INNER JOIN `assignments` 
                                                    ON `assignment_marks`.`assignments_id` = `assignments`.`id` 
                                                    INNER JOIN `teacher_has_subject` 
                                                    ON `assignments`.`teacher_has_subject_id` = `teacher_has_subject`.`id` 
                                                    INNER JOIN `subject` 
                                                    ON `teacher_has_subject`.`subject_id` = `subject`.`id` 
                                                    INNER JOIN `grade` 
                                                    ON `teacher_has_subject`.`grade_id` = `grade`.`id` 
                                                    WHERE `student_id` = '" . $userid . "' ORDER BY `assignments_id` ASC");

                                                    for ($i = 0; $i < $ResultSet->num_rows; $i++) {

                                                        $StudentMarks = $ResultSet->fetch_assoc();

                                                    ?>
                                                        <tr>
                                                            <td><?php echo $StudentMarks["assignments_id"]; ?></td>
                                                            <td><?php echo $StudentMarks["subject"]; ?></td>
                                                            <td><?php echo $StudentMarks["grade"]; ?></td>
                                                            <td><?php echo $StudentMarks["marks"]; ?></td>
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

                    <?php
                    }
                    ?>

                </div>
            </div>

            <?php require "Script.php"; ?>
        </body>

        </html>

    <?php

    } else {
        echo "Invalid User";
    }
} else {

    ?>

    <script>
        window.location = "index.php";
    </script>

<?php

}

?>
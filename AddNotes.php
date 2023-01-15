<?php

require "Connection.php";

session_start();

if (isset($_SESSION["user"])) {

?>

    <!DOCTYPE html>

    <html>

    <head>
        <title>Notes</title>
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
                            <span class="fs-1 fw-bold text-capitalize">LESSON NOTES</span>
                        </div>

                    </div>
                </div>

                <div class="col-12">
                    <div class="row justify-content-center">

                        <div class="col-12 col-md-8 col-lg-6">
                            <table class="table">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col">SUBJECT</th>
                                        <th scope="col">GRADE</th>
                                        <th scope="col">DATE</th>
                                        <th scope="col">NOTE</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php

                                    $ResultSet = Database::search("SELECT `notes`.`id`, `notes`.`teacher_has_subject_id`, `notes`.`date`, `notes`.`path`, `teacher_has_subject`.`teacher_id`, `grade`.`name` AS `grade`, `subject`.`name` AS `subject` FROM `notes` INNER JOIN `teacher_has_subject` ON `notes`.`teacher_has_subject_id` = `teacher_has_subject`.`id` INNER JOIN `subject` ON `teacher_has_subject`.`subject_id` = `subject`.`id` INNER JOIN `grade` ON `teacher_has_subject`.`grade_id` = `grade`.`id` WHERE `teacher_id` = '" . $_SESSION["user"]["id"] . "'");

                                    for ($i = 0; $i < $ResultSet->num_rows; $i++) {

                                        $notesDetails = $ResultSet->fetch_assoc();

                                    ?>
                                        <tr>
                                            <td><?php echo $notesDetails["subject"]; ?></td>
                                            <td><?php echo $notesDetails["grade"]; ?></td>
                                            <td><?php echo $notesDetails["date"]; ?></td>
                                            <td><a href="<?php echo $notesDetails["path"]; ?>" class="text-decoration-none text-success fw-bold">View Notes</a></td>
                                            <td><i class="bi bi-x-circle-fill text-danger" style="cursor: pointer;" onclick="RemoveNotes('<?php echo $notesDetails['id']; ?>');"></i></td>
                                        </tr>
                                    <?php

                                    }

                                    ?>

                                    <tr>
                                        <td colspan="5" class="text-center"><button class="btn btn-link text-decoration-none" onclick="AddNewNotesModal();"><i class="bi bi-plus-circle"></i> Add New</button></td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

                <div class="modal fade" id="AddNewNotesModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Add New Note</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="col-12">
                                    <div class="row g-2">
                                        <div class="col-12">
                                            <label class="form-label">Select Subject</label>
                                            <select class="form-select" id="subject" onchange="LoadGrade();">
                                                <option value="0">Select</option>
                                                <?php
                                                $ResultSet2 = Database::search("SELECT 
                                                `teacher_has_subject`.`id`, 
                                                `subject`.`id` AS `subject_id`,
                                                `subject`.`name` AS `subject`, 
                                                `grade`.`name` AS `grade`, 
                                                `grade`.`id` AS `grade_id`
                                                FROM `teacher_has_subject` 
                                                INNER JOIN `subject` 
                                                ON `teacher_has_subject`.`subject_id` = `subject`.`id`
                                                INNER JOIN `grade` 
                                                ON `teacher_has_subject`.`grade_id` = `grade`.`id` WHERE `teacher_id` = '" . $_SESSION["user"]["id"] . "'");
                                                for ($i = 0; $i < $ResultSet2->num_rows; $i++) {
                                                    $Subject = $ResultSet2->fetch_assoc();
                                                ?>
                                                    <option value="<?php echo $Subject["subject_id"]; ?>"><?php echo $Subject["subject"]; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Select Grade</label>
                                            <select class="form-select" id="grade">
                                                
                                            </select>
                                        </div>
                                        <div class="col-12 d-grid">
                                            <input type="file" id="note" accept="pdf" class="d-none" />
                                            <label for="note" class="btn btn-primary">Select a Note File</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" onclick="AddNewNotes('<?php echo $_SESSION['user']['id']; ?>');">Add</button>
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
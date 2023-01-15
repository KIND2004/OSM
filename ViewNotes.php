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

                        <?php require "StudentHeader.php"; ?>

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
                                        <th scope="col">DATE</th>
                                        <th scope="col">NOTE</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php

                                    $ResultSet = Database::search("SELECT `notes`.`path`, `notes`.`date`, `subject`.`name` AS `subject`, `grade`.`name` AS `grade` 
                                                FROM `notes` 
                                                INNER JOIN `teacher_has_subject` 
                                                ON `notes`.`teacher_has_subject_id` = `teacher_has_subject`.`id` 
                                                INNER JOIN `subject` 
                                                ON `teacher_has_subject`.`subject_id` = `subject`.`id`
                                                INNER JOIN `grade` 
                                                ON `teacher_has_subject`.`grade_id` = `grade`.`id` WHERE `grade`.`id` = '" . $_SESSION["user"]["grade_id"] . "'");

                                    for ($i = 0; $i < $ResultSet->num_rows; $i++) {

                                        $notesDetails = $ResultSet->fetch_assoc();

                                        $date = explode(" ", $notesDetails["date"]);

                                    ?>
                                        <tr>
                                            <td><?php echo $notesDetails["subject"]; ?></td>
                                            <td><?php echo $date[0]; ?></td>
                                            <td><a href="<?php echo $notesDetails["path"]; ?>" class="text-decoration-none text-success fw-bold">View Notes</a></td>
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

?>

    <script>
        window.location = "index.php";
    </script>

<?php

}

?>
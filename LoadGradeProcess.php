<?php

require "Connection.php";

session_start();

if (isset($_GET["subject"])) {

    $subject = $_GET["subject"];

?>

    <option value="0">Select</option>
    <?php
    $ResultSet = Database::search("SELECT 
                    `teacher_has_subject`.`id`, 
                    `subject`.`id` AS `subject_id`,
                    `subject`.`name` AS `subject`, 
                    `grade`.`name` AS `grade`, 
                    `grade`.`id` AS `grade_id`
                    FROM `teacher_has_subject` 
                    INNER JOIN `subject` 
                    ON `teacher_has_subject`.`subject_id` = `subject`.`id`
                    INNER JOIN `grade` 
                    ON `teacher_has_subject`.`grade_id` = `grade`.`id` WHERE `teacher_id` = '" . $_SESSION["user"]["id"] . "' AND `subject_id` = '" . $subject . "'");
    for ($i = 0; $i < $ResultSet->num_rows; $i++) {
        $Grade = $ResultSet->fetch_assoc();
    ?>
        <option value="<?php echo $Grade["grade_id"]; ?>"><?php echo $Grade["grade"]; ?></option>
    <?php
    }
    ?>

<?php

}

?>
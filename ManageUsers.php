<?php

require "Connection.php";

session_start();

if (isset($_SESSION["user"]) && isset($_GET["user"])) {

    $user =  $_GET["user"];

?>

    <!DOCTYPE html>

    <html>

    <head>
        <title>Manage <?php echo $user; ?></title>
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
                    <div class="row mt-2">

                        <div class="col-12 text-center">
                            <span class="fw-bolder fs-1 text-black-50">Manage <?php echo $user; ?>s</span>
                        </div>

                    </div>
                </div>

                <div class="col-12">
                    <div class="row">

                        <div class="col-12">
                            <table class="table">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">USERNAME</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Mobile</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php

                                    $ResultSet = Database::search("SELECT * FROM `" . $user . "`");

                                    for ($i = 0; $i < $ResultSet->num_rows; $i++) {

                                        $userDetails = $ResultSet->fetch_assoc();

                                    ?>
                                        <tr ondblclick="ViewUser('<?php echo $user; ?>','<?php echo $userDetails['id']; ?>');">
                                            <td><?php echo $userDetails["id"]; ?></td>
                                            <td><?php echo $userDetails["username"]; ?></td>
                                            <td><?php echo $userDetails["email"]; ?></td>
                                            <td><?php echo $userDetails["mobile"]; ?></td>
                                        </tr>
                                    <?php

                                    }

                                    ?>

                                </tbody>
                            </table>
                        </div>

                        <div class="col-12 text-center">
                            <span class="text-black-50 fw-bold">Double Click the Row to View <?php echo $user; ?> Details</span>
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
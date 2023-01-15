<?php

require "Connection.php";

session_start();

if (isset($_SESSION["user"])) {

    $user = $_GET["user"];

?>

    <!DOCTYPE html>

    <html>

    <head>

        <title>Invite <?php echo $user; ?></title>
        <?php require "Link.php"; ?>

    </head>

    <body>

        <div class="container-fluid">
            <div class="row">

                <div class="col-12">
                    <div class="row mt-5">

                        <div class="col-12 text-center">
                            <span class="fw-bolder fs-1 text-black-50">Invite <?php echo $user; ?></span>
                        </div>

                    </div>
                </div>

                <div class="col-12">
                    <div class="row justify-content-center mt-5">

                        <div class="col-10 col-md-6 col-lg-4">
                            <div class="row shadow rounded">

                                <div class="col-12">
                                    <div class="row gy-3 px-2 py-3">

                                        <div class="col-12">
                                            <label class="form-label fw-bold">Email</label>
                                            <input type="email" class="form-control" id="email" />
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label fw-bold">Username</label>
                                            <input type="text" class="form-control" id="username" />
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label fw-bold">Password</label>
                                            <input type="text" class="form-control" id="password" />
                                        </div>

                                        <?php

                                        if ($user == "Student") {
                                        ?>

                                            <div class="col-12">
                                                <label class="form-label fw-bold">Grade</label>
                                                <select class="form-select" id="grade">
                                                    <option value="0">Select</option>
                                                    <?php
                                                    $ResultSet = Database::search("SELECT * FROM `grade`");
                                                    for ($i = 0; $i < $ResultSet->num_rows; $i++) {
                                                        $Grade = $ResultSet->fetch_assoc();
                                                    ?>
                                                        <option value="<?php echo $Grade["id"]; ?>"><?php echo $Grade["name"]; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                        <?php
                                        }

                                        ?>

                                        <div class="col-12">
                                            <div class="row justify-content-center my-2">
                                                <div class="col-11 border border-1 border-secondary"></div>
                                            </div>
                                        </div>

                                        <div class="col-12 d-grid">
                                            <button class="btn btn-primary fw-bold" onclick="Invite('<?php echo $user; ?>');">Send Invitation</button>
                                        </div>

                                    </div>
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
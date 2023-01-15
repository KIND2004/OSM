<?php

require "Connection.php";

session_start();

if (isset($_GET["user"])) {

    $user = $_GET["user"];

    $ResultSet = Database::search("SELECT * FROM `" . $user . "` WHERE `username` = '" . $_SESSION["user"]["username"] . "'");
    $userDetails = $ResultSet->fetch_assoc();

?>

    <!DOCTYPE html>

    <html>

    <head>

        <title><?php echo $user; ?> Profile</title>
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
                            <span class="fw-bolder fs-1 text-black-50"><?php echo $user; ?> Profile</span>
                        </div>

                    </div>
                </div>

                <div class="col-12">
                    <div class="row justify-content-center">

                        <div class="col-10 col-md-6 col-lg-4">
                            <div class="row">

                                <div class="col-12">
                                    <div class="row gy-3 px-2 py-3">

                                        <div class="col-12">
                                            <div class="row justify-content-center gy-2">

                                                <?php

                                                $ResultSet2 = Database::search("SELECT * FROM `" . $user . "image` WHERE `" . $user . "_id` = '" . $userDetails["id"] . "'");

                                                if ($ResultSet2->num_rows == 1) {

                                                    $userImg = $ResultSet2->fetch_assoc();

                                                ?>
                                                    <div class="col-12 text-center">
                                                        <img class="rounded-circle border border-1 border-dark" height="150px" width="150px" src="<?php echo $userImg['path']; ?>" id="prev" />
                                                    </div>

                                                    <div class="col-12 text-center">
                                                        <input type="file" accept="img/*" id="imgpath" class="form-control d-none" />
                                                        <label for="imgpath" class="btn btn-danger" onclick="UploadImage();">Change Photo</label>
                                                    </div>
                                                <?php

                                                } else {

                                                ?>
                                                    <div class="col-12 text-center">
                                                        <img class="rounded-circle border border-1 border-dark" height="150px" width="150px" src="Resources/user.svg" id="prev" />
                                                    </div>

                                                    <div class="col-12 text-center">
                                                        <input type="file" accept="img/*" id="imgpath" class="form-control d-none" />
                                                        <label for="imgpath" class="btn btn-danger" onclick="UploadImage();">Upload Photo</label>
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
                                                    <input type="text" class="form-control" id="fname" value="<?php echo $userDetails["fname"]; ?>" />
                                                </div>

                                                <div class="col-6">
                                                    <label class="form-label fw-bold">Last Name</label>
                                                    <input type="text" class="form-control" id="lname" value="<?php echo $userDetails["lname"]; ?>" />
                                                </div>

                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label fw-bold">Email</label>
                                            <input type="email" class="form-control" id="email" value="<?php echo $userDetails["email"]; ?>" disabled />
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label fw-bold">Username</label>
                                            <input type="text" class="form-control" value="<?php echo $userDetails["username"]; ?>" disabled />
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label fw-bold">Password</label>
                                            <input type="text" class="form-control" id="password" value="<?php echo $userDetails["password"]; ?>" />
                                        </div>

                                        <div class="col-12 d-grid">
                                            <button class="btn btn-primary fw-bold" onclick="UpdateProfile('<?php echo $user; ?>');">Update Profile</button>
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

    echo "Invalid Request";
}

?>
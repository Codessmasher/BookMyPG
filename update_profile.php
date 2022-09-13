<?php
session_start();
require "includes/database_connect.php";

if (!isset($_SESSION["user_id"])) {
    header("location: index.php");
    die();
}
$user_id = $_GET['uid'];
$emailget = $_GET['eml'];
$phoneget = $_GET['phn'];
$unmget = $_GET['unm'];

$sql_1 = "SELECT * FROM users WHERE id = $user_id";
$result_1 = mysqli_query($conn, $sql_1);
if (!$result_1) {
    echo "Something went wrong!";
    return;
}
$user = mysqli_fetch_assoc($result_1);
if (!$user) {
    echo "Something went wrong!";
    return;
} else {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Dashboard | PG Life</title>

        <?php
        include "includes/head_links.php";
        ?>
        <link href="css/dashboard.css" rel="stylesheet" />
    </head>

    <body >
        <?php
        include "includes/header.php";
        ?>

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb py-2">
                <li class="breadcrumb-item">
                    <a href="index.php">Home</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Dashboard
                </li>
            </ol>
        </nav>
        <?php
        if (isset($_POST['edit'])) {
            $username = $_POST['unm'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $update = "UPDATE `users` SET full_name= '" . $username . "' , email='" . $email . "' ,phone= '" . $phone . "' WHERE id=$user_id";
            $updtQuery = mysqli_query($conn, $update);
            if ($updtQuery) {
                header("location:dashboard.php");
            }
        }


        ?>

        <!-- html code -->

        <div class="container col-md-6 mt-md-0 mt-5">
            <form class="signup col-6 m-auto " onsubmit="invalid()" action="update_profile.php?uid=<?php echo $user_id; ?>&eml=<?php echo $emailget ?>&phn=<?php echo $phoneget; ?>&unm=<?php echo $unmget ?>" method="POST">
                <input type="text" class="form-control mt-5" id="unm" name="unm" placeholder="Edit Your name" value="<?php echo $unmget ?>">
                <input type="email" class="form-control mt-5" id="email" name="email" placeholder="Edit Your email" value="<?php echo $emailget ?>">
                <input type="text" class="form-control mt-5" id="phone" name="phone" placeholder="Edit Your phoneno." value="<?php echo $phoneget ?>">
                <input type="submit" class="btn mt-4 btn-warning mb-5" id="edit" name="edit" value="EDIT">
            </form>
        </div>
        <div class="fixed-bottom">
            <?php
            include "includes/footer.php";
            ?>
        </div>
        <script type="text/javascript" src="js/dashboard.js"></script>
    </body>

    </html>
<?php

};

?>
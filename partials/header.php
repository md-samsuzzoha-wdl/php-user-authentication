<?php 
// session_status() === PHP_SESSION_ACTIVE ?: session_start();

// if(!isset($_SESSION['email'])){
//     header("Location: index.php");
// }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Auth</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="img/icon.svg" type="image/svg" sizes="16x16">
</head>

<body>
    <div class="whole-body">
        <header>
            <nav>
                <div class="nav-wrapper #311b92 deep-purple darken-4">
                    <div class="container">
                        <a href="/authentication" class="brand-logo"><img src="img/icon.svg" alt=""></a>
                        <ul id="nav-mobile" class="right hide-on-med-and-down">
                            <?php include('config/variables.php'); ?>
                            <?php
                            session_start();
                            if (isset($_SESSION['email'])) {
                            ?>
                                <li><a href="<?php echo $host; ?>/?action=dashboard">Dashbard</a></li>
                                <li><a href="<?php echo "users/signout.php"; ?>">Signout</a></li>
                            <?php
                            } else {
                            ?>
                                <li><a href="<?php echo $host; ?>/?action=signin">Signin</a></li>
                                <li><a href="<?php echo $host; ?>/?action=signup">Signup</a></li>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>

                </div>
            </nav>
        </header>
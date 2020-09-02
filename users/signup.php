<?php
include_once("../config/variables.php");
include_once('../config/Database.php');


if (isset($_POST['signup'])) {
    // echo $_POST['full_name'];
    $full_name = htmlspecialchars($_POST['full_name']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $password2 = htmlspecialchars($_POST['password2']);

    // echo $host ; 
    // echo "Password 2: " . $password2;


    // DECLARING EMPTY ARRAY OF ERRORS
    $message = array();


    // CHECK FOR ALL INPUT FIELDS ARE FILL
    if (empty($full_name) && empty($email) && empty($password) && empty($password2)) {
        $message[] = "Please fill all the fields";
        print_r($message);
        // echo "No input";
        header("Location: " . $host . "/index.php?action=signup&message=" . $message[0]);
        exit();


        // CHECK FOR PASSWORD LENGTH
    } else if (strlen($password) < 6) {
        $message[] = "Make sure your password has atleast 6 latter";
        header("Location: " . $host . "/index.php?action=signup&message=" . $message[0]);
        exit();
    } else if ($password !== $password2) {
        $message[] = "Password didn't match";
        header("Location: " . $host . "/index.php?action=signup&message=" . $message[0]);
        exit();


        // CHECK FOR A VALID EMAIL
        // https://www.php.net/manual/en/filter.filters.validate.php
        // Validates whether the value is a valid e-mail address.
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message[] = "This is not valid email address";
        header("Location: " . $host . "/index.php?action=signup&message=" . $message[0]);
        exit();

        // IF ALL THE IF ELSE STATEMENT HAS FAILED THEN IT SAVE USER
    } else {
        // IF EVERYTHING WENT RIGHT
        // CHECK FOR THE EMAIL THAT ALREADY REGISTED OR NOT
        $database = new Database();
        $dbh = $database->connect();
        $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

        $email_finding_sql = "SELECT * FROM users WHERE email=:email";
        $email_finding_stmt = $dbh->prepare($email_finding_sql);
        $email_finding_stmt->bindParam("email", $email);
        $email_finding_stmt->execute();
        $email_result = $email_finding_stmt->fetch();


        // IF THERE THE EMAIL IS REGISTED 
        // WE WILL NOT THE REGISER
        if (empty($email_result)) {
            // print_r($email_result);
            // die();
            $signup_sql = "INSERT INTO users(full_name, email, password) VALUES (:full_name, :email, :password)";
            $signup_stmt = $dbh->prepare($signup_sql);
            $signup_stmt->bindParam("full_name", $full_name);
            $signup_stmt->bindParam("email", $email);
            $signup_stmt->bindParam("password", md5($password));
            $signup_stmt->execute();
            $message[] = "User has registered successfully";
            header("Location: " . $host . "/index.php?action=signin&message=" . $message[0]);
            exit();

            // IF THERE THE EMAIL IS NOT REGISTED 
            // WE WILL DO THE REGISER 
        } else {
            $message[] = "An user is already registered with this email";
            header("Location: " . $host . "/index.php?action=signup&message=" . $message[0]);
            exit();
        }
    }

    // return $errors;

}

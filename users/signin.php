<?php
include_once("../config/variables.php");
include_once('../config/Database.php');


if (isset($_POST['signin'])) {
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);




    // DECLARING EMPTY ARRAY OF ERRORS
    $message = array();


    // CHECK FOR ALL INPUT FIELDS ARE FILL
    if (empty($email) && empty($password)) {
        $message[] = "Please fill all the fields";
        print_r($message);
        // echo "No input";
        header("Location: " . $host . "/index.php?action=signin&message=" . $message[0]);
        exit();
        // CHECK FOR PASSWORD LENGTH
    } else if (strlen($password) < 6) {
        $message[] = "Make sure your password has atleast 6 latter";
        header("Location: " . $host . "/index.php?action=signin&message=" . $message[0]);
        exit();
        // CHECK FOR A VALID EMAIL
        // https://www.php.net/manual/en/filter.filters.validate.php
        // Validates whether the value is a valid e-mail address.
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Something went wrong with email";
        $message[] = "This is not valid email address";
        header("Location: " . $host . "/index.php?action=signin&message=" . $message[0]);
        exit();

        // IF ALL THE IF ELSE STATEMENT HAS FAILED THEN IT SAVE USER
    } else {
        // IF EVERYTHING WENT RIGHT
        // CHECK FOR THE EMAIL THAT ALREADY REGISTED OR NOT
        $database = new Database();
        $dbh = $database->connect();
        $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $hash_password = md5($password);
        $email_password_finding_sql =  "SELECT id, full_name, email FROM users WHERE email=:email AND password=:password";    // SOME PROBLEM WITH SQL QUERY
        $email_password_finding_stmt = $dbh->prepare($email_password_finding_sql);
        $email_password_finding_stmt->bindParam("email", $email);
        // $hash_password = md5($password);
        $email_password_finding_stmt->bindParam("password", $hash_password);
        $email_password_finding_stmt->execute();
        $email_password_result = $email_password_finding_stmt->fetch();




        // IF USER INPUT WRONG EMAIL OR PASSWORD
        if (empty($email_password_result)) {
            // print_r("no user");
            // die();
            $message[] = "Incorrect password or email";
            header("Location: " . $host . "/index.php?action=signin&message=" . $message[0]);
            exit();
        } else {
            // IF USER INPUT RIGHT EMAIL AND PASSWORD
            // echo $email_password_result->full_name;
            // die();
            // session_start() creates a session or resumes the current one based on a session identifier passed via a GET or POST request, or passed via a cookie.
            session_start();
            $_SESSION['id'] = $email_password_result->id;
            $_SESSION['full_name'] = $email_password_result->full_name;
            $_SESSION['email'] = $email_password_result->email;

            $message[] = "You are logged in successfully";
            header("Location: " . $host . "/index.php?action=dashboard&message=" . $message[0]);
            exit();
        }
    }
    // return $errors;

}

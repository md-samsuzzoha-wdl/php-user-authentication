<?php
require_once("./config/variables.php");
require_once("./partials/header.php");

?>
<main>
    <br>
    <br>
    <br>
    <br>
    <div class="container">
        <?php
        // session_start();
        require_once('users/UserInterface.php');
        $action = isset($_GET['action']) ? $_GET['action'] : '';
        $userInterface = new UserInterface();
        switch ($action) {
            case 'signup':
                if (isset($_SESSION['email'])) {
                    header("Location: " . $host . "/?action=dashboard");
                }
                echo $userInterface->signup();
                break;
            case 'signin':
                if (isset($_SESSION['email'])) {
                    header("Location: " . $host . "/?action=dashboard");
                }
                echo $userInterface->signin();
                break;
            case 'dashboard':
                if (!isset($_SESSION['email'])) {
                    header("Location: " . $host . "/?action=signin");
                }
                echo $userInterface->dashboard();
                break;

            default:
                if (isset($_SESSION['email'])) {
                    header("Location: " . $host . "/?action=dashboard");
                } else {
                    echo $userInterface->signin();
                }
                break;
        }
        ?>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>


</main>
<?php require_once("./partials/footer.php"); ?>
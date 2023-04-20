<?php
    if(isset($_POST['logout'])) {
        session_destroy();
        // Redirect to the login page or any other page of your choice
        header("Location: index.php");
        exit();
    }
?>
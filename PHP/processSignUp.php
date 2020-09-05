<?php
    require('db.php');
    $user = new User();
    $user->setAll($_POST['Name'], 0,  $_POST["Email"], $_POST["Password"], $_POST["Bio"]);
    saveUserToDB($user);
?>
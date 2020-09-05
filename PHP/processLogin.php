<?php
    session_start();
    if(!isset($_SESSION['id'])){
        header("../HTML/Login.html") ;
    }
    
    require('db.php');
    
    $connection = establishConnection();
    $email = $_POST["Email"] ;
    $password = $_POST["Password"] ;
    $query = "select * from `user` where `email` = '$email' and `password` = '$password' limit 1";
    $result = mysqli_query($connection, $query);
    $counter = 0;
    $id = -1 ;
    $name = "" ;
    $bio = "" ;
    while($row = mysqli_fetch_assoc($result)) {
        $id = $row['id'];
        $name = $row['name'] ;
        $bio = $row["bio"] ;
        $counter++;
    }
    mysqli_close($connection);
    if($counter > 0) {
        $_SESSION['email'] = $email;
        $_SESSION['name'] = $name;
        $_SESSION['bio'] = $bio; 
        $_SESSION['id'] = $id;
        $_SESSION['isLogged'] = "true" ;
        header("Location: profile.php");
    } else {
        $message = "Please enter correct info";
        header("Location: ../HTML/Login.html");
    }
    
?>
<?php
    session_start();
    require('db.php');
    $post = new Post();
    $post->setAll($_POST['Title'], $_POST["Date"], $_POST["Body"], $_POST["UserID"]);
    echo $_POST["Body"] ;
    savePostToDataBase($post);
    
?>
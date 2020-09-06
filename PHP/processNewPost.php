<?php
    session_start();
    require('db.php');
    $post = new Post();
    $Tdate = getCurrentCairoTime();
    $post->setAll($_POST['Title'], $Tdate, $_POST["Body"], $_POST["UserID"]);
    echo $_POST["Body"] ;
    savePostToDataBase($post);
    
?>
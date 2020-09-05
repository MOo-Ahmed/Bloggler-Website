<?php
    session_start();
    $_SESSION['isLogged'] = '' ;
    session_destroy();
?>

<!DOCTYPE html>
<html>
<head></head>
    <body>
        <meta http-equiv="refresh" content="1;url=../HTML/Login.html">
    </body>
</html>
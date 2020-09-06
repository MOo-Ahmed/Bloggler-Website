<?php 
    require ('db.php');
    $connection = establishConnection();
    $id = $_POST["id"] ;
    $query = "SELECT User.name as Name , Post.postDate as PostDate , Post.postBody as Body  FROM Post inner join User where User.id = Post.UserID and User.id = '$id' order by Post.postDate desc";
    $result = mysqli_query($connection, $query);
    $data = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
			$data[] = $row;
        }
        $result->free();
    } 
    else {
        echo ("0 result") ;
    }
    $connection->close();
    echo json_encode($data); 
?>
<?php 
    
    class Post {
        private $ID;
        private $postTitle;
        private $userID;
        private $postDate;
        private $postBody;


        function setAll($postTitle, $postDate, $postBody, $userID) {
            $this->postTitle = $postTitle;
            $this->postBody = $postBody;
            $this->postDate = $postDate;
            $this->userID = $userID;
        }
        function setID($ID) {
            $this->ID = $ID;
        }
        function setTitle($title) {
            $this->postTitle = $title;
        }
        function setDate($date) {
            $this->postDate = $date;
        }
        function setBody($body) {
            $this->postBody = $body;
        }
        function setUserID($id) {
            $this->userID = $id;
        }
        
        function getID() {
            return $this->ID;
        }
        function getTitle() {
            return $this->postTitle;
        }
        function getDate() {
            return $this->postDate;
        }
        function getBody() {
            return $this->postBody;
        }
        function getUserID() {
            return $this->userID;
        }
        function print() {
            echo $this->ID . " " . $this->postBody . " " . $this->postTitle . " " . $this->postDate . " " . $this->userID . "<br>";
        }
    }    

    class User{
        private $id ;
        private $name ;
        private $email ;
        private $password ;
        private $bio ;
        
        function setAll($name, $id, $email, $password, $bio) {
            $this->id = $id;
            $this->name = $name;
            $this->password = $password;
            $this->email = $email;
            $this->bio = $bio ;
        }
        
        function getID (){
            return $this->id  ;
        }
        
        function getName (){
            return $this->name  ;
        }
        
        function getEmail (){
            return $this->email  ;
        }
        
        function getPassword (){
            return $this->password  ;
        }

        function getBio (){
            return $this->bio  ;
        }
    }

    function establishConnection() {
        define("SERVER_LOCATION", "localhost");
        define("USER_NAME", "root");
        define("PASSWORD", '');
        define("DATABASE_NAME", "bloggler");

        return mysqli_connect(SERVER_LOCATION, USER_NAME, PASSWORD, DATABASE_NAME);
    }

    function getPostFromDataBase($ID) {
        $connection = establishConnection();
        $query = "select * from `Post` where `ID` = $ID";
        $result = mysqli_query($connection, $query);
        $post = new Post();
        while($row = mysqli_fetch_assoc($result)) {
            $post->setID($row["ID"]);
            $post->setAll($row["postTitle"], $row["postDate"], $row["postBody"], $row["userID"]);
        }
        $result->free();
        $connection->close();
        return $post;
    }

    function savePostToDataBase($post) {
        $connection = establishConnection();
        if(!$connection) {
            //$returnMessage = "Can't connect to server.";
            mysqli_close($connection);
            header("Location: profile.php");
        }

        if($post->getTitle() == null || $post->getBody() == null || $post->getUserID() == null) {
            //$returnMessage = "One of the required inputs is null";
            mysqli_close($connection);
            header("Location: profile.php");
        }
        $postTitle = $post->getTitle();
        $postDate = $post->getDate();
        $postBody = $post->getBody();
        $userID = $post->getUserID();
        $query = "insert into `Post`(`postTitle`, `postDate`, `postBody`, `userID`)
        values('$postTitle', '$postDate', '$postBody','$userID')";

        $result = mysqli_query($connection, $query);
        if($result) {
            //$returnMessage = "Insertion Succeed.";
            mysqli_close($connection);
            header("Location: profile.php");
        } else {
            //$returnMessage = "Insertion Failed.";
            mysqli_close($connection);
            header("Location: profile.php");
        }
        $result->free();
        $connection->close();
    }

    function selectAllPostsOfUserFromDataBase($userID){
        $connection = establishConnection();
        $query = "SELECT * FROM Post where `userID` = '$userID'";
        $result = mysqli_query($connection, $query);
        
        echo '
        <table class="">
			<tr>
				<th> ID </th>
				<th> Brand </th>
				<th> Model </th>
				<th> Price </th>
				<th> Warranty </th>
            </tr>';

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $ID = $row["id"];
                $brand = $row["brand"];
                $model = $row["model"];
                $warranty = $row["warranty"];
                $price = $row["price"]; 


                echo '
                <tr> 
            <td>'.$ID.'</td> 
            <td>'.$brand.'</td> 
            <td>'.$model.'</td> 
            <td>'.$price.'</td> 
            <td>'.$warranty.'</td> 
            </tr>

            ';

            }
            echo '</table>' ;
           $result->free();
        } 
        else {
            echo ("0 result") ;
        }
         $connection->close();
    } 

    function updatepostInDataBase($post) {
        $connection = establishConnection();
        if(!$connection) {
            //$returnMessage = "Can't connect to server.";
            mysqli_close($connection);
            //header("Location: UpdatepostForm.php");
        }

        if($post->getBrand() == null || $post->getModel() == null || $post->getPrice() == null) {
            //$returnMessage = "One of the required inputs is null";
            mysqli_close($connection);
            //header("Location: UpdatepostForm.php");
        }
        $ID = $post->getID();
        $brand = $post->getBrand();
        $price = $post->getPrice();
        $model = $post->getModel();
        $warranty = $post->getWarranty();
        $query = "update `post` set `brand` = '$brand', `price` = '$price', `model` = '$model',
        `warranty`= '$warranty' where id = '$ID'";

        $result = mysqli_query($connection, $query);
        if($result) {
            //$returnMessage = "Insertion Succeed.";
            mysqli_close($connection);
            //header("Location: Main.php");
        } else {
            //$returnMessage = "Insertion Failed.";
            mysqli_close($connection);
            //header("Location: UpdatepostForm.php");
        }
        $result->free();
        $connection->close();
    }
    
    function isEmailExists($connection, $email){
        $query = "select * from `user` where `email` like '$email'";
        $result = mysqli_query($connection, $query);
        $counter = 0;
        while($row = mysqli_fetch_assoc($result)) {
            $counter++;
        }
        if($counter == 0) {
            return false;
        } else {
            return true;
        }
    }

	function saveUserToDB($user){
        $connection = establishConnection();
        /*
        if($user->getName() == null || $user->getPassword() == null || $user->getEmail() == null) {
            //$returnMessage = "One of required inputs is null.";
            mysqli_close($connection);
            header("Location: RegPage.html");
        }
        */
        if(isEmailExists($connection, $user->getEmail())) {
            //$returnMessage = "User Name is already exists.";
            mysqli_close($connection);
            header("Location: ../HTML/index.html#username");
        }
        
        $name = $user->getName();
        $password = $user->getPassword() ;
        $email = $user->getEmail() ;
        $bio = $user->getBio();
        
        $query = "INSERT INTO `User` (`name`, `password`, `email` , `bio`) VALUES ('$name', '$password', '$email', '$bio')";

        $result = mysqli_query($connection, $query);
        if($result) {
            //$returnMessage = "Registration Completed.";
            mysqli_close($connection);
            //echo '<script>alert("success");</script>' ;
            header("Location: profile.php");
            //echo '<script>alert("success");</script>' ;
        } else {
            //$returnMessage = "Registration Failed.";
            mysqli_close($connection);
            header("Location: ../HTML/index.html#username");
        }
    }

    function getCurrentCairoTime(){
        date_default_timezone_set('Africa/Cairo');
        return date('Y-m-d H:i');
    }
    

    /*
    function isUserRegistered($email, $password){
        $connection = establishConnection();
        //if(isEmailExists($connection, $email) == true){
            $query = "select * from `user` where `email` = '$email' and `password` = '$password'";
            $result = mysqli_query($connection, $query);
            $counter = 0;
            while($row = mysqli_fetch_assoc($result)) {
                $counter++;
            }
            mysqli_close($connection);
            if($counter == 1) {
                return true;
            } else {
                return false;
            }
        //}
    }
    */
?>
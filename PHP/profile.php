<?php
  session_start();
  if(empty($_SESSION["isLogged"]) || $_SESSION["isLogged"] == ''){
    session_destroy();
    echo "<script type='text/javascript'> document.location = '../HTML/Login.html'; </script>";
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?php echo $_SESSION["name"] ; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="../JS/jquery.min.js"></script>
    <link href="../JS/popper.min.js" rel="stylesheet">
    <link href="../CSS/bootstrap.min.css" rel="stylesheet">
    <script src="../JS/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../CSS/profileStyles.css">
    <script src="../JS/profilePageScript.js"></script>
</head>
<body>
  <div class="ui-bg-cover ui-bg-overlay-container text-white" style="background:#00BFFF;">
    <div class="ui-bg-overlay bg-dark opacity-50"></div>
    <div class="container py-5">
      <div class="media col-md-10 col-lg-8 col-xl-7 p-0 my-4 mx-auto">
        <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt class="d-block ui-w-100 rounded-circle">
        <div class="media-body ml-5">
          <h4 class="font-weight-bold mb-4">
            <?php echo $_SESSION["name"] ; ?>
          </h4>
          <div class="opacity-75 mb-4">
            <?php echo $_SESSION["bio"] ; ?>
          </div>
          <a href="#" class="d-inline-block text-white">
            <strong>234</strong>
            <span class="opacity-75">followers</span>
          </a>
          <a href="#" class="d-inline-block text-white ml-3">
            <strong>111</strong>
            <span class="opacity-75">following</span>
          </a>
        </div>
      </div>
    </div>

    <div class="ui-bg-overlay-container">
      <div class="ui-bg-overlay bg-dark opacity-25"></div>
      <ul class="nav nav-tabs tabs-alt justify-content-center border-transparent">
        <li class="nav-item">
          <a class="nav-link text-white py-4 active" href="#">Posts</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white py-4" href="#">Likes</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white py-4" href="#">Followers</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white py-4" href="#">Following</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white py-4" href="processLogout.php">Log out</a>
        </li>
      </ul>
    </div>
  </div>

  <div class="row">
    <div class="col-sm-3">
      
    </div>
    <!--The middle column-->
    <div class="col-sm-6 .text-dark">
      <div class="row">
        <div class="col-6 align-content-sm-center">
          <a class="_btn text-white" data-toggle="modal" data-target="#newPostModal">Create new post</a>
        </div>
        <div class="col-6"> 
          <a class="_btn text-white" id="showAllPosts">Show all your posts</a>
        </div>
        <input type="hidden" id="session_id" style="display:none" value="<?php echo $_SESSION["id"] ; ?>">
      </div>
      

      <!--Create new post modal --> 
      <div id="newPostModal" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">New Post</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form id="newPostForm" action="processNewPost.php" method="post" class="contact-form">
                <div class="input-group">
                  <input type="text" class="input" name="Title" placeholder="Post Title" required>
                  <span class="bar"></span>
                </div>

                <!--Hidden but necessary post data -->
                
                <div class="input-group">
                  <input type="hidden" class="input" name="UserID" value=<?php echo $_SESSION['id'] ;?>>
                </div>

                
                <div class="input-group">
                  <textarea class="input" cols='30' rows="8" name="Body" placeholder="What's in your mind ?" required></textarea>
                  <span class="bar"></span>
                </div>
                        
                <button type="submit" class="_btn" id="submitNewPostBtn">
                    save
                </button>

              </form>
            </div>
          </div>
        </div>
      </div>

      <!-- The time line section -->
      <div class="timeline">

      </div>
    </div>

    <div class="col-sm-3">
      
    </div>
  </div>

</body>
</html>
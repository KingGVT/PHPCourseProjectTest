<?php
//include('forumFunctions.php');
include('PostCommentsFunctions.php');
//include ('UserAccessToApp.php');
isLoggedIn();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My posts</title>
</head>
<body>
<div>
    <h2> My posts </h2>
    <a href="index.php"> GO home </a>
    <div>
        <p> Create posta <a href="CreatePost.php"> Create post </a> </p>

    </div>

    <div>
        <?php
        getPostsByUserId(getIdByUsername($_SESSION['username']));
        ?>
    </div>
</div>
</body>
</html>
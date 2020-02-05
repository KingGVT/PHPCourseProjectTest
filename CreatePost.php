<?php
//include('forumFunctions.php');
include('PostCommentsFunctions.php');
//include('UserAccessToApp.php');
isLoggedIn();
if(isset($_POST['createPost'])){createPost(getIdByUsername($_SESSION['username']));}
//    include('functions.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create post</title>
</head>
<body>
<div>
    <h2> Create post </h2>
    <a href="index.php"> GO home </a>
    <div>
        <p> Create new post </p>

        <?php
        //displayErrors();
        include('errors.php')?>

        <form method="post" id="createpost">

            <label> Title </label>
            <input type="text" name="postTitle">
            <br>
            <textarea rows="4" cols="50" name="postText"></textarea>
            <button type="submit" name="createPost"> Create post </button>

        </form>


    </div>
</div>
</body>
</html>

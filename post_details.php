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
    <title> <?php echo $_GET['page']?> </title>
</head>
<body>
<div>
    <div>
        <a href="index.php"> GO home </a>

        <?php
            $mId = seePost();
            displayCommentsByPostId(getPostIdByTitle($mId));
            if (isset($_POST['postComment'])) {
                postComment(getPostIdByTitle($mId), getIdByUsername($_SESSION['username']));
            }
        ?>

        <?php
        //displayErrors();
        include('errors.php')?>

        <form method="post" id="createComment">
            <label> Comment: </label>
            <textarea rows="4" cols="50" name="commentText"></textarea>
            <button type="submit" name="postComment"> Post comment </button>
        </form>
</body>
</html>
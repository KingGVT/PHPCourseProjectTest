<?php
//include('forumFunctions.php');
include('UserAccessToApp.php');
//include('PostCommentsFunctions.php');
//    include('functions.php');
isLoggedIn();
if(isset($_POST['logout'])){logout();}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
</head>
<body>
<div>
    <h2>Home Page</h2>
</div>
<div>
    <?php
    if(isset($_SESSION['username']) && isset($_SESSION['email'])){
        $user = getUserDetails($_SESSION['username'], $_SESSION['email']);
        echo "<p> Welocome </p>" . $user['firstname'];
    }
    ?>
    <a href="posts.php"> My posts </a>

    <div>
        <h2> Recent posts </h2>
        <?php recentPostsFeed(); ?>
    </div>

    <div>
        <form method="post">
            <button type="submit" name="logout"> Logout </button>
        </form>
    </div>
</div>
</body>
</html>
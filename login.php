<?php include('UserAccessToApp.php') ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title> Login </title>
    <link rel="stylesheet" href="forumStyle.css" type="text/css">
</head>
<body style="background-color: #9932CC">
<div class="accessContainer">
    <h2> Login: </h2>
    <form method="post">
        <?php include('errors.php') ?>
        <label> Username </label>
        <input type="text" name="username" class="inputField">

        <label> Password </label>
        <input type="password" name="password" class="inputField">

        <button class="accessbtn" type="submit" name="UserLogin"> Login</button>
    </form>
    <p> Not a member yet? <a href="register.php"> Sign in </a></p>
</div>
</body>
</html>
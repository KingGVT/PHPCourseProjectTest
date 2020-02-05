<?php
//include('forumFunctions.php');
include('UserAccessToApp.php') ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title> Register </title>
    <link rel="stylesheet" href="forumStyle.css" type="text/css">
</head>
<body style="background-color: #9932CC">
<div class="accessContainer">
    <h2> Register: </h2>
    <form method="post">
        <label> First name </label>
        <input type="text" name="firstName" class="inputField">

        <label> Last name </label>
        <input type="text" name="lastName" class="inputField">

        <label> Username </label>
        <input type="text" name="username" class="inputField">

        <label>Email</label>
        <input type="email" name="email" class="inputField">

        <label>Password</label>
        <input type="password" name="password" class="inputField">

        <label>Confirm password</label>
        <input type="password" name="passwordConfirmation" class="inputField">

        <button class="accessbtn" type="submit" name="UserRegistration"> Register</button>
    </form>
    <?php include('errors.php') ?>
    <p> Already a member? <a href="login.php">Login</a></p>
</div>
</body>
</html>

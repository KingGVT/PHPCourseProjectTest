<?php

$errorListVar = array();
function dataBaseConnection(){
    $db = mysqli_connect('localhost', 'root', '', 'forumdatabase');
    if(!$db) {die("Connection failed: " . mysqli_connect_error());}
    return $db;
}

function checkForExistence($db, $query){
    $result = mysqli_query($db, $query);
    if(mysqli_num_rows($result) > 0){
        return true;
    }
    return false;
}

function getUserDetails($user, $email)
{
    global $DataBase;
    $DBQuery = "SELECT * FROM users WHERE username='$user' AND email='$email'";
    $results = mysqli_fetch_assoc(mysqli_query($DataBase, $DBQuery));
    return $results;
}

function missingParam($param, $type){
    global $errorListVar;
    if(empty($param)){array_push($errorListVar, "$type is required");}
}

function getIdByUsername($username)
{
    global $DataBase;
    $result = mysqli_query($DataBase, "SELECT * FROM users WHERE username='$username'");
    return mysqli_fetch_assoc($result)['user_id'];
}

function getUsernameById($id)
{
    global $DataBase;
    $result = mysqli_query($DataBase, "SELECT * FROM users WHERE user_id='$id'");
    return mysqli_fetch_assoc($result)['username'];
}

function isLoggedIn(){
    if(!isset($_SESSION['username']) || !isset($_SESSION['email'])) {
        header('location: login.php');
    }
}

function logout(){
    unset($_SESSION['username']);
    unset($_SESSION['email']);
    session_destroy();
    header('location: login.php');
    exit();
}

function recentPostsFeed(){
    global $DataBase;
    //$query = mysqli_query($DataBase, "SELECT * FROM posts WHERE user_id='1'");
    $query = mysqli_query($DataBase, "SELECT * FROM posts ORDER BY created_at DESC LIMIT 10");
    $posts = mysqli_fetch_all($query, MYSQLI_ASSOC);
    if($posts){
        $cnt = 0;
        foreach ($posts as $post){
                $p = $post['title'];//change to title
                echo "<div> <a href='post_details.php?page=$p'>" . $post['title'] . "</a></div>";
        }
    }
    else{
        echo "No posts available";
    }
}

?>
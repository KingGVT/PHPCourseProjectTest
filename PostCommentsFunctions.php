<?php

include('functions.php');

session_start();

$DataBase = dataBaseConnection();

//$DataBase = mysqli_connect('localhost', 'root', '', 'moviesappdatabase');
//if(!$DataBase) {die("Connection failed: " . mysqli_connect_error());}

//to here tested

//$user_id = getIdByUsername($_SESSION['username']);
//$post_query_result = mysqli_query($DataBase, "SELECT * FROM movies WHERE id='$user_id'");
//$post = mysqli_fetch_assoc($post_query_result);

//    //If the submit comment button is clicked
//    if(isset($_POST['comment_posted'])) {
//        global $DataBase;
//        //taking comment through ajax call
//        $comment_text = $_POST['comment_text'];
//        //inserting into database
//        $sql = "INSERT INTO comments (post_id, user_id, body, created_at, updated_at) VALUES (1,'$user_id', '$comment_text', now(), null)";
//        $result = mysqli_query($DataBase, $sql);
//        //query same comment to be displayed
//        $inserted_id = $DataBase->insert_id;
//        $res = mysqli_query($DataBase, "SELECT * FROM comments WHERE id='$inserted_id'");
//        $inserted_comment = mysqli_fetch_assoc($res);
//        //if successful
//        if ($result) {
//            $comment = "<div>
//					<div>
//						<span>" . getUsernameById($inserted_comment['user_id']) . "</span>
//						<span>" . date('F j, Y ', strtotime($inserted_comment['created_at'])) . "</span>
//						<p>" . $inserted_comment['body'] . "</p>
//						<a href='#' data-id='" . $inserted_comment['id'] . "'>reply</a>
//					</div>
//					<!-- reply form -->
//					<form action='post_details.php' id='comment_reply_form_" . $inserted_comment['id'] . "' data-id='" . $inserted_comment['id'] . "'>
//						<textarea name='reply_text' id='reply_text' cols='30' rows='2'></textarea>
//						<button>Submit reply</button>
//					</form>
//				</div>";
//            $comment_info = array(
//                'comment' => $comment,
//                'comments_count' => getCommentsCountByPostId(1)
//            );
//            echo json_encode($comment_info);
//            exit();
//        } else {
//            exit("error has occurred");
//        }
//    }
//
//    // If the user clicked submit on reply form...
//    if (isset($_POST['reply_posted'])) {
//        global $DataBase;
//        // grab the reply that was submitted through Ajax call
//        $reply_text = $_POST['reply_text'];
//        $comment_id = $_POST['comment_id'];
//        // insert reply into database
//        $sql = "INSERT INTO replies (user_id, comment_id, body, created_at, updated_at) VALUES (" . $user_id . ", $comment_id, '$reply_text', now(), null)";
//        $result = mysqli_query($DataBase, $sql);
//        $inserted_id = $DataBase->insert_id;
//        $res = mysqli_query($DataBase, "SELECT * FROM replies WHERE id='$inserted_id'");
//        $inserted_reply = mysqli_fetch_assoc($res);
//        // if insert was successful, get that same reply from the database and return it
//        if ($result) {
//            $reply = "<div>
//					    <div>
//						    <span>" . getUsernameById($inserted_reply['user_id']) . "</span>
//						    <span>" . date('F j, Y ', strtotime($inserted_reply['created_at'])) . "</span>
//						    <p>" . $inserted_reply['body'] . "</p>
//						    <a href='#'>reply</a>
//					    </div>
//				    </div>";
//            echo $reply;
//            exit();
//        } else {
//            exit("an error has occurred");
//        }
//    }

//    function getCommentsCountByPostId($post_id)
//    {
//        global $DataBase;
//        $result = mysqli_query($DataBase, "SELECT COUNT(*) AS total FROM comments");
//        $data = mysqli_fetch_assoc($result);
//        return $data['total'];
//    }
//
//    function getRepliesByCommentId($id)
//    {
//        global $DataBase;
//        $result = mysqli_query($DataBase, "SELECT * FROM replies WHERE comment_id='$id'");
//        $replies = mysqli_fetch_all($result, MYSQLI_ASSOC);
//        return $replies;
//    }


//from here
//    function getIdByUsername($username)
//    {
//        global $DataBase;
//        $result = mysqli_query($DataBase, "SELECT * FROM users WHERE username='$username'");
//        return mysqli_fetch_assoc($result)['id'];
//    }


//    function getUsernameById($id)
//    {
//        global $DataBase;
//        $result = mysqli_query($DataBase, "SELECT * FROM users WHERE id='$id'");
//        return mysqli_fetch_assoc($result)['username'];
//    }

//$query = "SELECT FROM users,posts,movies WHERE users.UserId =  u";



function createPost($uId){
    global $DataBase, $errorListVar;
    $postTitle = mysqli_real_escape_string($DataBase, $_POST['postTitle']);
    $postText = mysqli_real_escape_string($DataBase, $_POST['postText']);

    missingParam($postTitle, "Title");
    missingParam($postText, "Text");

    if(count($errorListVar) == 0) {
        $DBRegQuery = "INSERT INTO posts (user_id, title, body) VALUES('$uId', '$postTitle', '$postText')";
        mysqli_query($DataBase, $DBRegQuery);
        header('location: posts.php');
    }
}

function postComment($postId, $userId){
    global $DataBase, $errorListVar;
    $commentText = mysqli_real_escape_string($DataBase, $_POST['commentText']);
    missingParam($commentText, "Comment");
    if(count($errorListVar) == 0) {
        $DBRegQuery = "INSERT INTO comments (post_id, user_id, body) VALUES('$postId', '$userId', '$commentText')";
        mysqli_query($DataBase, $DBRegQuery);
        header("Refresh:0");
    }
}

function getPostsByUserId($id){
    global $DataBase;
    $query = mysqli_query($DataBase, "SELECT * FROM posts WHERE user_id='$id'");
    $posts = mysqli_fetch_all($query, MYSQLI_ASSOC);
    if($posts){
        foreach ($posts as $post){
            $p = $post['title'];//change to title
            echo "<div> <a href='post_details.php?page=$p'>" . $post['title'] . "</a></div>";
        }
    }
    else{
        echo "No posts available";
    }
}

/*function recentPostsFeed(){
    global $DataBase;
    //$query = mysqli_query($DataBase, "SELECT * FROM posts WHERE user_id='1'");
    $query = mysqli_query($DataBase, "SELECT TOP 10 * FROM posts ORDER BY created_at DESC");
    $posts = mysqli_fetch_all($query, MYSQLI_ASSOC);
    if($posts){
        foreach ($posts as $post){
            $p = $post['title'];//change to title
            echo "<div> <a href='post_details.php?page=$p'>" . $post['title'] . "</a></div>";
        }
    }
    else{
        echo "No posts available";
    }
}*/

if(isset($_GET['page'])){
    function seePost(){
        global $DataBase;
        $title = $_GET['page'];
        $query = mysqli_query($DataBase, "SELECT * FROM posts WHERE title='$title'");
        $post = mysqli_fetch_assoc($query);
        echo "<div>";
        echo "<h2> " . $title . "</h2>";
        echo "<div>" . $post['body'] . "</div>";
        echo "<p> Created at: " . $post['created_at'] . " | By: " . getUsernameById($post['user_id']) . "</p>";
        echo "</div> <p> COMMENTS: </p>";
        //displayCommentsByPostId($post['post_id']);
        return $title;
    }
}

function getPostIdByTitle($title){
    global $DataBase;
    $query = mysqli_query($DataBase, "SELECT post_id FROM posts WHERE title='$title'");
    return mysqli_fetch_array($query, MYSQLI_NUM)[0];
    //return mysqli_fetch_assoc($query)['post_id'];
}

function displayCommentsByPostId($postId){
    global $DataBase;
    $query = mysqli_query($DataBase, "SELECT * FROM comments WHERE post_id='$postId'");
    $comments = mysqli_fetch_all($query, MYSQLI_ASSOC);
    foreach ($comments as $comment){
        //$p = $movie['title'];//change to title
        $display = "<div>
                            <p> User: " . getUsernameById($comment['user_id']) . " | " . $comment['body'] . "</p>
                        </div>";
        echo $display;
    }
}

?>
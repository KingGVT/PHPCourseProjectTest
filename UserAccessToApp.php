<?php
include('functions.php');
//include('PostCommentsFunctions.php');

session_start();

$DataBase = dataBaseConnection();

$usernameVar = "";
$emailVar = "";
//$errorListVar = array();

//Registration
if (isset($_POST['UserRegistration'])) {
    UserRegistration();
}

//Login
if (isset($_POST['UserLogin'])) {
    UserLogin();
}

//Registration process
function UserRegistration()
{
    global $DataBase, $usernameVar, $emailVar, $errorListVar;
    //Getting user info
    $firstNameVar = mysqli_real_escape_string($DataBase, $_POST['firstName']);
    $lastNameVar = mysqli_real_escape_string($DataBase, $_POST['lastName']);
    $usernameVar = mysqli_real_escape_string($DataBase, $_POST['username']);
    $emailVar = mysqli_real_escape_string($DataBase, $_POST['email']);
    $passwordVar = mysqli_real_escape_string($DataBase, $_POST['password']);
    $passwordConfirmation = mysqli_real_escape_string($DataBase, $_POST['passwordConfirmation']);

    //check if they are missing
    missingParam($firstNameVar, "First name");
    missingParam($lastNameVar, "Last name");
    missingParam($usernameVar, "Username");
    missingParam($emailVar, "Email");
    missingParam($passwordVar, "Password");
    missingParam($passwordConfirmation, "Password confirmation");

    //check if the passwords are the same
    if ($passwordVar != $passwordConfirmation) {array_push($errorListVar, "The two passwords do not match!");}

    //CHECK FOR EXISTING USER
    $sql_q_usernameExistence = "SELECT * FROM users WHERE username='$usernameVar'";
    $sql_q_emailExistence = "SELECT * FROM users WHERE email='$emailVar'";
    $userNExist = checkForExistence($DataBase, $sql_q_usernameExistence);
    $emailExist = checkForExistence($DataBase, $sql_q_emailExistence);
    if($userNExist){
        array_push($errorListVar, "Username is already taken!");
    }
    if($emailExist){
        array_push($errorListVar, "Email is already taken!");
    }

    //no errors occurred so far
    if (count($errorListVar) == 0) {
        $passwordVar = md5($passwordVar); //we encrypt the password
        $DBRegQuery = "INSERT INTO users (username, firstname, lastname, email, password) VALUES('$usernameVar', '$firstNameVar', '$lastNameVar', '$emailVar', '$passwordVar')";
        mysqli_query($DataBase, $DBRegQuery);
        $_SESSION['username'] = $usernameVar;
        $_SESSION['email'] = $emailVar;
        header('location: index.php');
    }
}


//Login process
function UserLogin()
{
    global $DataBase, $usernameVar, $errorListVar;
    $usernameVar = mysqli_real_escape_string($DataBase, $_POST['username']);
    $passwordVar = mysqli_real_escape_string($DataBase, $_POST['password']);

    missingParam($usernameVar, "Username");
    missingParam($passwordVar, "Email");

    if (count($errorListVar) == 0) {
        $passwordVar = md5($passwordVar);
        $DBLogQuery = "SELECT * FROM users WHERE (username='$usernameVar' OR email='$usernameVar') AND password='$passwordVar'";//this way the user should be able to log in with username or email
        $results = mysqli_query($DataBase, $DBLogQuery);

        if (mysqli_num_rows($results) == 1) {
            $loggedUser = mysqli_fetch_assoc($results);

            $_SESSION['username'] = $loggedUser['username'];
            $_SESSION['email'] = $loggedUser['email'];
            header('location: index.php');
        } else {
            array_push($errorListVar, "Wrong username/password combination");
        }
    }
}
?>


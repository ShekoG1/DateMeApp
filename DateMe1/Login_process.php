<?php
session_start();
// get values passe from form in login.php file
$username=$_POST['user'];
$password=$_POST['pass'];

// to prevent mysql injection
$username = stripcslashes($username);
$password = stripcslashes($password);

 //connect to the server and select database
        $dbh = mysqli_connect("localhost","root","");
        mysqli_select_db($dbh,"datemeapp");

try{
    $username = mysqli_real_escape_string($dbh,$username);
$password = mysqli_real_escape_string($dbh,$password);}
catch(PDOException $e){    echo "Nope";}
        
        //Query database for user
        $result = mysqli_query($dbh,"select * from users where UserName = '$username' and Password = '$password'")
                or die("Failed to query database".mysqli_error());
        //checks if the user has completed their profile
        $completedProfile = mysqli_query($dbh,"SELECT * FROM `completedprofiles` WHERE UserName = '$username';")
               or die("Failed to query database".mysqli_error($dbh));
        $isComplete = mysqli_fetch_array($completedProfile);
        $row = mysqli_fetch_array($result);
        if($row['UserName'] == $username && $row['Password'] == $password){
        //decides whether or not the users profile is complete and takes user to the appropriate page    
            if($row['Admin'] === "0" && $row['Reviewer'] === "0" && $isComplete['profile_complete'] === "1")
        {header('Location: HomePage.php');}
            else if($row['Admin'] === "0" && $row['Reviewer'] === "0" && $isComplete['profile_complete'] === "0")
            {header('Location: HomePage.php');}
        //checks whether or not the user is an admin    
        if($row['Admin'] === "1" && $row['Reviewer'] === "0"){header('Location: AdminPage.php');}
        //checks whether or not the use is a reviewer
        if($row['Admin'] === "0" && $row['Reviewer'] === "1"){header('Location: ReviewerPage.php');}
        
       }else{
            echo "ERROR 1: Failed to login";
            echo"<p><a href='Login.php'>Try Again</a></p>";
            echo"<p><a href='CreateUser'>Create new user</a>/p>";
        }
        
       $_SESSION['name'] = $username;
        $_SESSION['password'] = $password;
        $_SESSION['Admin']=$row['Admin'];
        
?>


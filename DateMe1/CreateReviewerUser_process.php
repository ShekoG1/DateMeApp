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
        $result = mysqli_query($dbh,"INSERT INTO users(UserName,Password,Reviewer) VALUES('$username','$password','1');")
                or die("Failed to query database".mysqli_error($dbh));
        $query = mysqli_query($dbh,"INSERT INTO reviewerprofiledetails(Reviewer,Upvotes,Downvotes) VALUES('$username','0','0');")
                or die("Failed to query database".mysqli_error($dbh));
        $query = mysqli_query($dbh,"INSERT INTO reviewertasks(Reviewer,Task,Package,isAvailable) VALUES('$username','Null','0','1');")
                or die("Failed to query database".mysqli_error($dbh));
        
        $_SESSION['name'] = $username;
        $_SESSION['password'] = $password;
        $_SESSION['Reviewer']=$row['Reviewer'];
                header('Location: ReviewerPage.php');
                //reviewerprofiledetails
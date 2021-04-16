<?php
session_start();
$name = $_SESSION['NAME'];
$dislike = $_SESSION['DOWNVOTES'];

//connect to the server and select database
        $dbh = mysqli_connect("localhost","root","");
        mysqli_select_db($dbh,"datemeapp");
        
        $QUERY = mysqli_query($dbh,"select UpVotes from userprofiledetails Where UserName='$name';")
                or die("Failed to query database".mysql_error());
        
        $AddDislikes = $dislike;
        $AddDislikes++;
       
        
        $QUERY = mysqli_query($dbh,"UPDATE `userprofiledetails` SET `DownVotes` = '$AddDislikes' WHERE `userprofiledetails`.`UserName` = '$name';")
                or die("Failed to query database".mysql_error());

        echo "Sorry about the dislike...";
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
         <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title></title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" 
        rel="stylesheet" 
        crossorigin="anonymous">
    </head>
    <body bgcolor="black">
        <div><img src="PurpleHeart.jpg" height="300" width="600"></div>
        <style>
            body{
                background: #040404;
            }
        </style>
        </body>
        </html>
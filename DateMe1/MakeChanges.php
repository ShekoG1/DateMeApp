<?php
session_start();
// get values passed from form in login.php file
$name=$_GET['FindUser'];
        $msg ="";
        

if(isset($_GET['upload'])){
    //path to store the uploaded img
$target = "Images/". basename($_FILES['image']['name']);

//connect to the database
$dbh = mysqli_connect("localhost","root","","datemeapp");
       // mysqli_select_db($dbh,"use_images");
        
        //get all submitted data from the form

$image = $_FILES['image']['name'];

        
        $sql ="UPDATE `userprofileimages` SET `Profile_Img` = '$image' WHERE `userprofileimages`.`UserName` = '$name';";
        mysqli_query($dbh,$sql)
or die("Failed to query database".mysqli_error($dbh));// stores the submitted data
        
        //now lets move the uploaded image into the source folder
        if(move_uploaded_file($_FILES['image']['tmp_name'],$target)){
            $msg= "Image Uploaded successfully";
        }else{
            $msg= "There was a problem uploading images";
        } 
}
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" 
        rel="stylesheet" 
        crossorigin="anonymous">
        <!--above is the link to bootstrap-->
        
        <title>MakeChanges</title>
    </head>
    
    <body>
        <!-- <div class='content'>
             <form method="post" enctype="multipart/form-data" action="AdminPage.php">
                <input type='hidden' name='size' value='1000000'>
                <div>
                    <input id='ChooseFile' type='file' name="image">
                </div>
                <div>
                    <input id='Submit' type='submit' name='upload' value='Upload Image'>
                </div>
            </form>
        </div>-->
<?php
// get values passed from form in login.php file
$username=$_GET['FindUser'];

// to prevent mysql injection
$username = stripcslashes($username);

 //connect to the server and select database
        $dbh = mysqli_connect("localhost","root","");
        mysqli_select_db($dbh,"datemeapp");

try{
    $username = mysqli_real_escape_string($dbh,$username);
}
catch(PDOException $e){    echo "Error: ". mysqli_error($dbh);}
        

        //Query database for basic user details
        $result = mysqli_query($dbh,"SELECT * FROM users WHERE UserName = '$username'")
                or die("Failed to query database".mysqli_error($dbh));
        $row = mysqli_fetch_array($result);
         $_SESSION['UserName'] = $row['UserName'];
        // determines whether or not the selected user is an Admin/Reviewer
        if($row['Admin'] === "1"){
            $isAdmin = "Yes";
        }else{ $isAdmin ="No";}
        
        if($row['Reviewer'] ==="1"){
            $isReviewer="Yes";
        }else{$isReviewer="No";}
        
        $_SESSION['isAdmin']=$isAdmin;
        $_SESSION['isReviewer']=$isReviewer;
        
        echo "<style>
            @import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap');
            </style>";
        
        //START DIV TAG HERE
        echo "<div class=''printDetails>";
        
        //printing basic profile details
        echo"UserName: ";
        echo $row['UserName'],"<br/>";
        echo"Password: ";
        echo $row['Password'],"<br/>";
        echo"Admin: ";
        echo $isAdmin,"<br/>";
        echo "Reviewer: ";
        echo $isReviewer,"<br/>";
        
        //Query database for profile statistics and characteristics
        if($isReviewer === "No" && $isAdmin === "No"){
           
            //profile details
        $result = mysqli_query($dbh,"SELECT * FROM userprofiledetails WHERE UserName = '$username'")
                or die("Failed to query database".mysqli_error($dbh));
        $row = mysqli_fetch_array($result);
        
        //determines user gender as well as gender interested in
         if($row['Gender'] ==="1"){$userGender="Male";}
        else if($row['Gender'] ==="0"){$userGender="Female";}
        if($row['InterestedIn'] ==="1"){$userType ="Male";}
        else if($row['InterestedIn'] ==="0"){$userType ="Female";}
        
        //printing user details
        echo "<hr/>";
        echo "Profile Details: <br/>";
        echo "<hr/>";
        echo "Age: ";
        echo $row['Age'],"<br/>";
        echo "Gender: ";
        echo $userGender,"<br/>";
        echo "Interested In: ";
        echo $userType,"<br/>";
        echo "UpVotes: ";
        echo $row['Upvotes'],"<br/>";
        echo "DownVotes: ";
        echo $row['Downvotes'],"<br/>";
        
         $result = mysqli_query($dbh,"SELECT * FROM usercharacteristics WHERE UserName = '$username'")
                or die("Failed to query database".mysqli_error($dbh));
        $row = mysqli_fetch_array($result);
        //printing user characteristics
        echo "<hr/>";
        echo "Characteristics: <br/>";
        echo "<hr/>";
        echo "Jovial: ";
        echo $row['Jovial'],"<br/>";
        echo "Affectionate: ";
        echo $row['Affectionate'],"<br/>";
        echo "Dedication: ";
        echo $row['Dedication'],"<br/>";
        echo "Sentimental: ";
        echo $row['Sentimental'],"<br/>";
        echo "Consistant: ";
        echo $row['Consistant'],"<br/>";
        echo "About Me: ";
        echo $row['AboutYourself'],"<br/>";
        
            $dbh = mysqli_connect("localhost","root","","datemeapp");
            $sql="SELECT * FROM userprofileimages WHERE UserName='$username';";
            $result = mysqli_query($dbh, $sql);
            $row= mysqli_fetch_array($result);
                echo"<div class='ProfileImg'><img class='myImg' src='Images/",$row['Profile_Img'],"' height='370' width='300'></div>";
            
        //END DIV TAG HERE
        echo "</div>";
        //START NEW DIV TAG HERE
        //form to change details
        echo "<hr/>";
        echo"<div class='myForm'>";
        echo"<form action='SaveChanges.php' enctype='multipart/form-data>
            <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
            <h2>Change Details</h2><br/>
        
            <label> username: </label>
            <input type='text' id='Name' name='Name'><br/>
            <label> Password: </label>
            <input type='text' id='Password' name='Password'><br/>
            <label> Age:</label><br/>
            <input type='number' id='Age' name='Age'><br/>
            
             <label> Gender:</label>
             <input type='checkbox' class='ChooseGender' value='1' name='Male'>Male |
             <input type='checkbox' class='ChooseGender' value='0' name='Female'>Female<br/>
<script>
$(document).ready(function(){
    $('.ChooseGender').click(function() {
        $('.ChooseGender').not(this).prop('checked', false);
    });
});
</script>
            <label> Interested in:</label>
            <input type='checkbox' class='interestedIn' value='1' name='interestedInmale'>Male |
            <input type='checkbox' class='interestedIn' value='0' name='interestedInfemale'>Female<br/>
<script>
$(document).ready(function(){
    $('.interestedIn').click(function() {
        $('.interestedIn').not(this).prop('checked', false);
    });
});
</script>
            <h2> Characteristics: </h2>
            
            <label> Jovial:</label>
            <input type='range' min='1' max='10' id='Jovial' name='Jovial'><br/>
            <label> Affectionate:</label>
            <input type='range' min='1' max='10' id='Affectionate' name='Affectionate'><br/>
            <label> Dedicated:</label>
            <input type='range' min='1' max='10' id='Dedicated' name='Dedicated'><br/>
            <label> Sentimental:</label>
            <input type='range' min='1' max='10' id='Sentimental' name='Sentimental'><br/>
            <label> Consistant:</label>
            <input type='range' min='1' max='10' id='Consistant' name='Consistant'><br/>
            <label>About Me:</label>
            <input type='text' id='Aboutme' name='Aboutme'><br/>
            <input type='submit' class='btn'>
        </form></div>";
        //END NEW DIV TAG HERE
        }
        else if($isReviewer === "Yes" && $isAdmin === "No"){
            echo"<h1>Profile details</h1>";
             $result = mysqli_query($dbh,"SELECT * FROM users WHERE UserName = '$username' AND Reviewer=1;")
                or die("Failed to query database".mysqli_error($dbh));
             $row = mysqli_fetch_array($result);
             //printing basic reviewer info
             echo"UserName: ";
             echo $row['UserName'],"<br/>";
             echo"Password: ";
             echo$row['Password'],"<br/>";
             
             $result = mysqli_query($dbh,"SELECT * FROM reviewerprofiledetails WHERE Reviewer = '$username';")
                or die("Failed to query database".mysqli_error($dbh));
             $row = mysqli_fetch_array($result);
             echo "Likes: ";
             echo $row['Upvotes'],"<br/>";
             echo "Dislikes: ";
             echo $row['Downvotes'],"<br/>";
              echo"<div class='myForm'>";
             echo "<form action='SaveChanges.php'>
                 <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
            <h2>Change Details</h2><br/>
            <label> username: </label>
            <input type='text' id='Name' name='ReviewerName'>
            <label> Password: </label>
            <input type='text' id='Password' name='ReviewerPassword'>
<label> Privilages:</label><br/>
            <input type='checkbox' class='Privilages' value='1' name='MakeAdmin'>Male
            <input type='checkbox' class='Privilages' value='0' name='MakeReviewer'>Female<br/>
<script>
$(document).ready(function(){
    $('.Privilages').click(function() {
        $('.Privilages').not(this).prop('checked', false);
    });
});
</script>
            <input type='submit' class='btn' value='Submit'>
        </form>";
             echo "</div>";
        }
        else if($isReviewer === "No" && $isAdmin === "Yes"){
             echo"<div class='myForm'>";
            echo "<form action='SaveChanges.php'>
                <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
            <h2>Change Details</h2><br/>
            <label> username: </label>
            <input type='text' id='Name' name='Name'>
            <label> Password: </label>
            <input type='text' id='Password' name='Password'>
            <label> Privilages:</label><br/>
            <input type='checkbox' class='Privilages' value='1' name='MakeAdmin'>Male
            <input type='checkbox' class='Privilages' value='0' name='MakeReviewer'>Female<br/>
<script>
$(document).ready(function(){
    $('.Privilages').click(function() {
        $('.Privilages').not(this).prop('checked', false);
    });
});
</script>
            <input type='submit' class='btn'>
        </form>";
            echo "</div>";
        }
        else{echo"Whoops Something Goof'd";}
echo "<style>
            body{
            margin: 10px 10px;
                font-family: 'Open Sans', sans-serif;
                background: #181818;
                color: gray;
            }
            #Age{
            width: 20%;
}
            #frm{
                background: white;
            }
            .myForm{
            position: fixed
    top: 300px;
    border: solid gray 1px;
    width: 35%;
    border-radius: 5px;
    margin: 100px auto;
    background: black;
    padding: 50px;
}
.btn{
    color: #fff;
    background: #337ab7;
    padding: 5px;
    margin-left: 69%;
}
#Aboutme{
width: 200px;
height: 100px; }
.ProfileImg{
    position: fixed;
    top: 113px;
    right: 10px; 
hr{
width: 50%;
}    
}";
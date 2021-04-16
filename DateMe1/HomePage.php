<?php
session_start();
        $msg ="";
         $name = $_SESSION['name'];
// if upload button is pressed
if(isset($_POST['upload'])){
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
        <!--above is the link to bootstrap and below is the link to the preferred css file -->
        <!--<link rel="stylesheet" href="HomePageStyle.css" type="text/css"/> -->
        
        <title>Home</title>
        <nav>
            <form action="ViewUserProfile.php">
                <div class="searchBar">
        <input type="text" placeholder="Enter username here" name="searchProfile">
        <input type="submit" value="Search" >
                </div>
       </form></nav>
    </head>
    
    <body>
        <div class="DateMe">DateMe</div>
        <div class="slogan">Loneliness ends here...</div>
        
        <div class="searchReviewer">
        <section>Need some help with your profile?</section>
        <form action="ViewReviewerProfile.php">
        <input type="text" placeholder="Enter reviewer name here" name="searchProfile">
        <input type="submit" value="Search" >
       </form>
        </div>
           
        <div class="ViewmyProfile">
           <p class="ViewProfileTitle">My Profile</p>
        <?php
        // put your code here
         $name = $_SESSION['name'];
       //connect to the server and select database
        $dbh = mysqli_connect("localhost","root","");
        mysqli_select_db($dbh,"datemeapp");
        
         //Query database for user
        $result_1 = mysqli_query($dbh,"select * from userprofiledetails Where UserName='$name';")
                or die("Failed to query database".mysql_error());
        
        $row_1 = mysqli_fetch_array($result_1);
        
        if($row_1['Gender'] ==="1"){$userGender="Male";}
        else if($row_1['Gender'] ==="0"){$userGender="Female";}
        if($row_1['InterestedIn'] ==="1"){$userType ="Male";}
        else if($row_1['InterestedIn'] ==="0"){$userType ="Female";}
        
            echo "Username: ";
            echo $row_1['UserName'],"<br/>";
            echo "Age: ";
            echo $row_1['Age'],"<br/>";
            echo "Gender: ";
            echo $userGender,"<br/>";
            echo "Interested In: ";
            echo $userType,"<br/>";
            echo "UpVotes: ";
            echo $row_1['Upvotes'],"<br/>";
            echo "DownVotes: ";
            echo $row_1['Downvotes'],"<br/>";
            
            //show Characteristics 
            $result_1 = mysqli_query($dbh,"select * from usercharacteristics Where UserName='$name';")
                or die("Failed to query database".mysql_error());
        
        $row_1 = mysqli_fetch_array($result_1);
        echo "Jovial: ";
        echo $row_1['Jovial'],"<br/>";
        echo "Affectionate: ";
        echo $row_1['Affectionate'],"<br/>";
        echo "Dedication: ";
        echo $row_1['Dedication'],"<br/>";
        echo "Sentimental: ";
        echo $row_1['Sentimental'],"<br/>";
        echo "Consistant: ";
        echo $row_1['Consistant'],"<br/>";
        echo "About Me: ";
        echo $row_1['AboutYourself'],"<br/>";
        ?>
              
            </div>
        <!--uploading img-->
            <?php
            $sql="SELECT * FROM userprofileimages WHERE UserName='$name';";
            $result = mysqli_query($dbh, $sql);
            $row= mysqli_fetch_array($result);
                echo"<div class='ProfileImg'><img class='myImg' src='Images/",$row['Profile_Img'],"' height='370' width='300'></div>";
            ?>
        <div class="content">
            <form method="post" action="HomePage.php" enctype="multipart/form-data">
                <input type="hidden" name="size" value="1000000">
                <div>
                    <input id="ChooseFile" type="file" name="image">
                </div>
                <div>
                    <input id="Submit" type="submit" name="upload" value="Upload Image">
                </div>
            </form>
        </div>
        <div id='nav'><a href='Login.php'>LogOut</a></div>
        <div class="PreviewNames">
            <p>Suggested Searches</p>
            <?php 
            if($userType==="Female"){
                $userType="0";
            }else  if($userType==="Male"){
                $userType="1";
            }
            $sql="SELECT * FROM userprofiledetails WHERE Gender='$userType' AND UserName !='$name';";
            $result = mysqli_query($dbh, $sql);
            echo "<ul>";
            while($row= mysqli_fetch_array($result)){
            //$userType
            echo "<li>",$row['UserName'],"</li>";
            }
            echo"</ul>";
            ?>
        </div>
        <div class="Review">
            <h3>Your Latest Review:</h3>
            <?php
            $result = mysqli_query($dbh,"SELECT * FROM usersreviewed WHERE UserName ='$name';")
                    or die("Failed to query database".mysqli_error($dbh));
            $row = mysqli_fetch_array($result);
                    echo "Review: <br/>",$row['Review'],"<br/>";
                    echo "Rating: ",$row['Rating'],"<br/>";
            ?>
        </div>
        <style>
html,body,p{
    padding: 2px 2px;
        margin: 2px;
        color: white;
        background: #181818;
}
.ViewmyProfile{
    position: fixed;
    right: 300px;
    left:300px;
    top:  100px;
    color: white;
    background: #070707;
    padding: 10px 10px;
    margin: 15px 15px;
    border: solid purple 3px;
    height: 370px;
}

.searchBar{
    position: fixed;
    right: 20px;
    padding: 10px 10px;
}
.searchReviewer{
    position: fixed;
    padding: 10px 10px;
    right: 20px;
    bottom: 100px;
}
#nav,a{
    font-weight: 700;
    background: #181818;
    color:white;
    height: 20px;
        width: 60px;
}

.ProfileImg{
    position: fixed;
    top: 113px;
    left: 10px;
}
.content{
    position: fixed;
    top: 500px;
}
#ChooseFile{
    color: white;
    background:  #181818;
}
#Submit{
    color: white;
    background:  #181818;
}
.PreviewNames{
    position: fixed;
    height: 370px;
    width: 300px;
    right: 10px;
    top: 115px;
    background: #070707;
    padding: 10px 10px;
   
    border-style: solid;
    border: 10em;
}
.DateMe{
    font-size: 90px;
    font-weight: 300;
    color: purple;
    position: fixed;
    top: 0px;
    left: 10px;
}
.slogan{
    font-size: 25px;
    font-weight: 200;
    color: white;
    position: fixed;
   top: 70px;
   left: 350px;
}
.Review{
    position: fixed;
    bottom: 10px;
    left: 320px;
}
        </style>
    </body>
</html>

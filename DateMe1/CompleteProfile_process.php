<?php
session_start();
       //setsup user variables for name and password
       $NAME=$_SESSION['name'];
       $age=$_GET['Age'];
       $ChooseGender[0]=$_GET['Male'];
       $ChooseGender[1]=$_GET['Female'];
       $Type[0]=$_GET['interestedInmale'];
       $Type[1]=$_GET['interestedInfemale'];
       $jovial=$_GET['Jovial'];
       $affectionate=$_GET['Affectionate'];
       $dedication=$_GET['Dedicated'];
       $sentimental=$_GET['Sentimental'];
       $consistant=$_GET['Consistant'];
       $aboutYourself=$_GET['Aboutme'];
       
       //finding true values
       //what is the users gender?
        if(isset($ChooseGender[0])){
           $Gender = 1;
       }else if(isset($ChooseGender[1])){
           $Gender = 0;
       }
       // interested in which gender?
       if(isset($Type[0])){
           $interestedIn = 1;
       }else if(isset($Type[1])){
           $interestedIn = 0;
       }
       //connect to the server and select database
        $dbh = mysqli_connect("localhost","root","");
        mysqli_select_db($dbh,"datemeapp");
       
      //Userprofiledetails
      
       // to prevent mysql injection
    $NAME = stripcslashes($NAME);
    $age = stripcslashes($age);
    $Gender = stripcslashes($Gender);
    $interestedIn = stripcslashes($interestedIn);
    $affectionate = stripcslashes($affectionate);
    $dedication = stripcslashes($dedication);
    $sentimental = stripcslashes($sentimental);
    $consistant = stripcslashes($consistant);
    $aboutYourself = stripcslashes($aboutYourself);
    $jovial = stripcslashes($jovial);

    try{
    $NAME = mysqli_real_escape_string($dbh,$NAME);
    $age = mysqli_real_escape_string($dbh,$age);
    $Gender = mysqli_real_escape_string($dbh,$Gender);
    $interestedIn = mysqli_real_escape_string($dbh,$interestedIn);
    $affectionate = mysqli_real_escape_string($dbh,$affectionate);
    $dedication = mysqli_real_escape_string($dbh,$dedication);
    $sentimental = mysqli_real_escape_string($dbh,$sentimental);
    $consistant = mysqli_real_escape_string($dbh,$consistant);
    $aboutYourself = mysqli_real_escape_string($dbh,$aboutYourself);
    $jovial = mysqli_real_escape_string($dbh,$jovial);
    }
    catch(PDOException $e){ echo "Nope";}

        //Query database for user
        $result = mysqli_query($dbh,"INSERT INTO userprofiledetails(UserName,Age,Gender,InterestedIn) VALUES('$NAME','$age','$Gender','$interestedIn');")
                or die("Failed to query database".mysqli_error($dbh));
       
      //UserCharacteristics
         $result = mysqli_query($dbh,"INSERT INTO usercharacteristics(UserName,Jovial,Affectionate,Dedication,Sentimental,Consistant,AboutYourself) VALUES('$NAME','$jovial','$affectionate','$dedication','$sentimental','$consistant','$aboutYourself');")
                or die("Failed to query database".mysqli_error($dbh));
         //completedprofiles
          $result = mysqli_query($dbh,"INSERT INTO completedprofiles(UserName,profile_complete) VALUES('$NAME','1');")
                or die("Failed to query database".mysqli_error($dbh));
        
        header('Location: HomePage.php');
         
        //https://stackoverflow.com/questions/4554758/how-to-read-if-a-checkbox-is-checked-in-php
        //code to check if the checkbox is selected
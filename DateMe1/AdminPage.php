<?php
session_start();
 //connect to the server and select database
        $dbh = mysqli_connect("localhost","root","");
        mysqli_select_db($dbh,"datemeapp");
        
        if(isset($_GET['SubmitPack1'])){
            echo "Pack 1 changed";
            $Tasks = $_GET['ChangePack1'];
            $result = mysqli_query($dbh,"UPDATE reviewpackages SET Tasks='$Tasks' WHERE PackID='1';")
                or die("Failed to query database".mysql_error());
            
        } else if(isset($_GET['SubmitPack2'])){
            echo "Pack 2 changed";
            $Tasks = $_GET['ChangePack2'];
            $result = mysqli_query($dbh,"UPDATE reviewpackages SET Tasks='$Tasks' WHERE PackID='2';")
                or die("Failed to query database".mysql_error());
            
        } else if(isset($_GET['SubmitPack3'])){
            echo "Pack 3 changed";
            $Tasks = $_GET['ChangePack3'];
            $result = mysqli_query($dbh,"UPDATE reviewpackages SET Tasks='$Tasks' WHERE PackID='3';")
                or die("Failed to query database".mysql_error());
        }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" 
        rel="stylesheet" 
        crossorigin="anonymous">
        <!--above is the link to bootstrap and below is the link to the preferred css file -->
        <link rel="stylesheet" href="AdminStyle.css" type="text/css"/>
        <title>AdminPage</title>
    </head>
    <body>
   <div class="Banner"> <marquee direction="right"><div  class="WelcomeBanner">WELCOME TO THE END OF LONELINESS AND THE START OF HAPPINESS</div></marquee></div>
   <div id='nav'><a href='Login.php'>LogOut</a></div>     
   <div class="AdminBanner">Admin Control</div>
        <div class="DateMe">DateMe</div>
        <div class="slogan">Loneliness ends here...</div>
   <p>Your details:</p>
        <?php
        
        // put your code here
       $NAME=$_SESSION['name'];
       $PASSWORD=$_SESSION['password'];
       echo "Username: ",$NAME," | Password: ",$PASSWORD;
        ?>
        <p>Users currently registered on the site: </p>
       <table border="1">
           <tr bgcolor='black'>
               <td>ID</td>
               <td>UserName</td>
               <td>Password</td>
           </tr>
        <?php
        //Query database for user
        $result = mysqli_query($dbh,"select * from users where Admin=0 and Reviewer=0;")
                or die("Failed to query database".mysql_error());

        while($row = mysqli_fetch_array($result)){
            echo "<tr>";
            
            echo "<td class='ID'> ",$row['ID'],"</td>";
        echo "<td class='username'>",$row['UserName'],
                "</td> <td class='password'> ",$row['Password'],"</td>";
           
        echo "</tr>";}
        //Admin
        $result = mysqli_query($dbh,"select * from users where Admin=1 and Reviewer=0;")
                or die("Failed to query database".mysql_error());
        echo "<tr bgcolor='black'>
               <td>ID</td>
               <td>AdminName</td>
               <td>Password</td>
           </tr>";
        while($row = mysqli_fetch_array($result)){
            echo "<tr>";
            
            echo "<td class='ID'> ",$row['ID'],"</td>";
        echo "<td class='username'>",$row['UserName'],
                "</td> <td class='password'> ",$row['Password'],"</td>";
           
        echo "</tr>";}
         //Reviewer
        $result = mysqli_query($dbh,"select * from users where Admin=0 and Reviewer=1;")
                or die("Failed to query database".mysqli_error($dbh));
        
        echo "<tr bgcolor='black'>
               <td>ID</td>
               <td>ReviewerName</td>
               <td>Password</td>
           </tr>";
        while($row = mysqli_fetch_array($result)){
            echo "<tr>";
            echo "<td class='ID'> ",$row['ID'],"</td>";
        echo "<td class='username'>",$row['UserName'],
                "</td> <td class='password'> ",$row['Password'],"</td>";
           
        echo "</tr>";}
        
        ?>
        </table>
        <form action="MakeChanges.php">
        <input type="text" name="FindUser" >
        <input type="submit" value="Search">
        </form>
        <p class="CreateAdmin"><a href="CreateAdminUser.php">Create New Admin User</a></p>
        <!--Allowing admin to view and change review packages-->
        <div class="Packages">
            <?php
            $query = mysqli_query($dbh,"select * from reviewpackages;")
                or die("Failed to query database".mysqli_error($dbh));
            while($Answer = mysqli_fetch_array($query)){
                echo "<form action=''>";
            echo "Package ",$Answer['PackID'],"<br/>";
            echo "Task: ",$Answer['Tasks'],"<br/>";
            echo "<input type='text' class='ChangePack",$Answer['PackID'],"' name='ChangePack",$Answer['PackID'],"' placeholder='Change Pack",$Answer['PackID'],"'>";
            echo "<input type='submit' class='SubmitPack",$Answer['PackID'],"' name='SubmitPack",$Answer['PackID'],"' value='Change'>";
            echo "<hr/>";
            echo "</form>";
            }
            
            ?>
        </div>
        <style>
            body{
                 background: #181818;
                color: gray;
            }
            .WelcomeBanner{
                background: #181818;
                color: purple
            }
            .Banner{
    background: #181818;
}
hr{
    width: 28%;
}
.DateMe{
    font-size: 200px;
    font-weight: 300;
    color: purple;
    position: fixed;
    bottom: 200px;
   right: 20px
}
.slogan{
    font-size: 50px;
    font-weight: 200;
    color: white;
    position: fixed;
   bottom: 200px;
   right: 20px;
}
.AdminBanner{
    font-size: 30px;
    font-weight: 200;
    color: white;
    position: fixed;
   bottom: 420px;
   right: 480px;
}
        </style>
    </body>
</html>

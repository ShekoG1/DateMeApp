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
        <link rel="stylesheet" href="style.css" type="text/css"/>
        <title></title>
    </head>
    <body>
        <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
        <div>WELCOME TO THE END OF LONELINESS AND THE START OF HAPPINESS</div>
        <?php
        session_start();
        // put your code here
       $NAME=$_SESSION['name'];
       $PASSWORD=$_SESSION['password'];
       echo "Username: ",$NAME," password: ",$PASSWORD;
        ?>
        <div class="myForm">
        <form action="CompleteProfile_process.php">
            <h2>Tell us about yourself...</h2><br/>
            <label> Age:</label>
            <input type="text" id="Age" name="Age"><br/>
            
             <label> Gender:</label><br/>
             <input type="checkbox" class="Gender" value="1" name="Male">Male
             <input type="checkbox" class="Gender" value="0" name="Female">Female<br/>
             
<script>
$(document).ready(function(){
    $('.Gender').click(function() {
        $('.Gender').not(this).prop('checked', false);
    });
});
</script>
             
            <label> Interested in:</label><br/>
            <input type="checkbox" class="interestedIn" value="1" name="interestedInmale">Male
            <input type="checkbox" class="interestedIn" value="0" name="interestedInfemale">Female<br/>
            
<script>
$(document).ready(function(){
    $('.interestedIn').click(function() {
        $('.interestedIn').not(this).prop('checked', false);
    });
});
</script>
            
            <h2> Characteristics </h2>
            
            <label> Jovial</label><br/>
            <input type="range" min="1" max="10" id="Jovial" name="Jovial"><br/>
            <label> Affectionate</label><br/>
            <input type="range" min="1" max="10" id="Affectionate" name="Affectionate"><br/>
            <label> Dedicated</label><br/>
            <input type="range" min="1" max="10" id="Dedicated" name="Dedicated"><br/>
            <label> Sentimental</label><br/>
            <input type="range" min="1" max="10" id="Sentimental" name="Sentimental"><br/>
            <label> Consistant</label><br/>
            <input type="range" min="1" max="10" id="Consistant" name="Consistant"><br/>
            <input type="text" id="Aboutme" name="Aboutme"><br/>
            <input type="submit" class="btn"><br/>
        </form>
            </div>
        <style>
            body{
                background: #181818;
            }
            #frm{
    border: solid gray 1px;
    width: 30%;
    border-radius: 5px;
    margin: 100px auto;
    background: black;
    padding: 50px;
}
#btn{
    color: #fff;
    background: #337ab7;
    padding: 5px;
    margin-left: 69%;
}
        </style>
    </body>
</html>
<!-- use .empty() in php to check if a checkbox is ticked or not -->
<!-- https://www.w3schools.com/html/html_form_input_types.asp
Type of input: range
-->
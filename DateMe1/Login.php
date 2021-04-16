<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" 
        rel="stylesheet" 
        crossorigin="anonymous">
        <!--above is the link to bootstrap and below is the link to the preferred css file -->
        <link rel="stylesheet" href="style.css" type="text/css"/>
    </head>
    <body>
        <div class="DateMe">DateMe</div>
        <div class="slogan">Loneliness ends here...</div>
        <div id="frm">
            <form action="Login_process.php" method="POST">
                <p>
                    <label>Username:</label>
                    <input type="text"id="user"name="user">
                </p>
                 <p>
                    <label>Password:</label>
                    <input type="password"id="pass"name="pass">
                </p>   
                <p> 
                    <input type="submit"id="btn" value="Login">
                </p>
                <p><a href="CreateUser.html">Create new user</a></p>
            </form>
        </div>
        <?php
        // put your code here
        
        ?>
        <style>
            body{
                background: #181818;
            }
            #frm{
                position: sticky;
                background: white;
            }
            .DateMe{
    font-size: 100px;
    font-weight: 300;
    color: purple;
    position: fixed;
    bottom: 435px;
   
}
.slogan{
    font-size: 25px;
    font-weight: 200;
    color: white;
    position: fixed;
   bottom: 415px;
   left: 20px;
}
        </style>
    </body>
</html>

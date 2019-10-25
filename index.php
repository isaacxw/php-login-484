<?php include("src/server.php") ?>
<!DOCTYPE html>
<html>
<head>
	<title>Lab2</title>
    <meta charset="utf-8" lang="en">
	<link rel="stylesheet" type="text/css" href="./templates/main.css">
</head>
<body>

    <div id="wrapper">
        <form name="login-form" class="login-form" method="post" action="index.php">

            <div class="header">
                <h1>Login</h1>
                <span>Fill out the form to gain access to high level government data</span>
            </div>

            <div class="content">
                <input type="text" name="username" class="input username" placeholder="Username">
                <input type="password" name="password" class="input password" placeholder="Password">
            </div>

            <?php include('src/errors.php'); ?>

            <div class="footer">
                <input type="submit" class="button" name="login" value="Submit">
                <input type="submit" class="button" name="register" value="Register">

            </div>

        </form>
    </div>


</body>
</html>
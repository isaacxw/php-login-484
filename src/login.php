<?php
	session_start();

	if (!isset($_SESSION['username'])) {
		$_SESSION['msg'] = "You must log in first";
		header('location: ../index.php');
	}

	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['username']);
		header("location: ../index.php");
	}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Welcome</title>
        <link rel="stylesheet" type="text/css" href="../templates/home.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">

        <style type="text/css">
            body{ font: 14px sans-serif; text-align: center; }
        </style>

        <script type="application/javascript">
            function lightFade (lightId)
            {
                var lightOn = true;
                var bri = 255;
                var authCode = "YOUR_AUTH_CODE";
                var urlStr = "YOUR_URL_PATH";
                urlStr += authCode;
                urlStr += "/lights/" + lightId + "/state";

                sendAjax(urlStr, "PUT",
                    JSON.stringify({"on": true, "bri":255 }));

                for (var xyz = 0; xyz<4; xyz++){
                    for (var i=0; i<6; i++) {
                        if (bri <= 0) lightOn = false;
                        sendAjax(urlStr, "PUT", JSON.stringify({
                            "hue" : 0,
                            "bri" : bri,
                            "on" : lightOn
                        }));
                        bri -= 25;
                        sleepMs(400);
                    }
                    sendAjax(urlStr, "PUT", JSON.stringify({"on": true, "bri": 255}));
                    sendAjax(urlStr, "PUT", JSON.stringify({"on": false, "bri": 0}));
                }


            }

            function sendAjax (url, method, str)
            {

                var req = new XMLHttpRequest();
                req.open(method, url, true);
                req.setRequestHeader("Content-type", "application/json");
                req.send(str);

            }

            function sleepMs(msec)
            {

                var start = new Date().getTime();
                while ( (new Date().getTime()) < (start + msec));

            }

            function start()
            {
                document.getElementById("theButton").
                addEventListener("click", function() {lightFade(1);});

            }

            //window.addEventListener("load", start);
        </script>
    </head>

    <body>
        <div class="page-header">
            <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site!</h1>
        </div>

        <form action ="#">
            <input type="checkbox" class="l" id="theButton" value="s w i t c h">
        </form>
        <br>
        <p>OR</p>
        <p>
            <a href="../src/index.php?logout='1'" class="btn btn-primary">Log out</a>
        </p>
    </body>
</html>
<?php
    include("config.php");
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Admin</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="../templates/admin.css">
    </head>

    <body>
        <h1>Admin Panel</h1>

        <?php
            $result = mysqli_query($db, "SELECT * FROM users ORDER BY username ASC");

            echo "<table border='2'>
            <tr>
                <th>Username</th>
                <th>Password</th>
            </tr>";

            while ($row = mysqli_fetch_array($result)) {
                // only show rows with role permission set to user
                if ($row['role'] == 'user') {
                    echo "<tr>";
                    echo "<td>" . $row['username'] . "</td>";
                    echo "<td>" . $row['password'] . "</td>";
                    echo "</tr>";
                }
            }

            echo "</table>";
        ?>

        <p>
            <a href="../src/index.php?logout='1'" class="btn btn-primary">Log out</a>
        </p>
    </body>
</html>



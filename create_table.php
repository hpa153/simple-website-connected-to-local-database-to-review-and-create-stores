<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create a table</title>
</head>
<body>
<?php
    require("creds.php");
    if ($conn) {
        // Create the query
        $query = 'CREATE TABLE entries (
            id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(100) NOT NULL,
            review TEXT NOT NULL,
            date_entered DATETIME NOT NULL
            ) CHARACTER SET utf8';
        // Execute the query
        if (@mysqli_query($conn, $query)) {
            print '<p>The table has been created</p>';
        } else {
            print '<p style="color: red;">Error connecting to the database: '. mysqli_connect_error() . '</p>';
        }
    }
?>
</body>
</html>
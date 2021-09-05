<?php
    $username = "reviews_system";
    $password = "foobars";
    $host = "localhost";
    $database = "reviews";
    if ($conn = @mysqli_connect($host, $username, $password, $database)) {
        print '<p>Connection established</p>';

        // Close the connection
        mysqli_close($conn);
    } else {
        print '<p style="color: red;">Error connecting to the database: '. mysqli_connect_error() . '</p>';
    }
?>
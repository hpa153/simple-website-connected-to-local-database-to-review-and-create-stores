<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Review</title>
</head>
<body>
    <h1>Delete Review</h1>
<?php
    require("creds.php");
    // Create query
    $query = "DELETE FROM entries WHERE id = {$_GET['id']} LIMIT 1";
    // Execute query
    $r = mysqli_query($conn , $query);
    if (mysqli_affected_rows($conn)==1) {
        print '<p>The review has been deleted</p>';
    } else {
        print '<p style="color: red;">Could not delete the review because: <br>' . mysqli_error($conn) . 
                '</p><p>The query being run was: ' . $query . '</p>';
    }
    mysqli_close($conn); // Close the connection    
?>
</body>
</html>
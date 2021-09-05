<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Read Reviews</title>
</head>
<body>
    <h1>Reviews</h1>
<?php
    require("creds.php");

    // Create query
    $query = 'SELECT * FROM entries ORDER BY date_entered DESC';
    
    if ($r = mysqli_query($conn, $query)) { // Execute query
        // Retrieve and pprint every record
        while ($row = mysqli_fetch_array($r)) {
            print "<p><h3>{$row['name']}</h3>
            {$row['review']}<br/>
            <a href=\"edit_review.php?id={$row['id']}\">Edit</a>
            <a href=\"delete_review.php?id={$row['id']}\">Delete</a>
            </p><hr>\n";
        } 
    } else { // Query error
        print '<p style="color: red;">Could not retrieve the data because: <br>' . mysqli_error($conn) . 
                '</p><p>The query being run was: ' . $query . '</p>';
    } 
    // End of query IF
    mysqli_close($conn); // Close the connection      
?>
</body>
</html>
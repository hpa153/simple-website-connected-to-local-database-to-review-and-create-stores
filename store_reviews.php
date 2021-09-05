<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Store Reviews</title>
</head>
<body>
    <h1>Store Reviews</h1>
<?php
    require("creds.php");
    // Create query to retrieve data from stores table
    $storeQuery = 'SELECT * FROM stores';
    if ($stores = mysqli_query($conn, $storeQuery)) { // Execute query
        // Retrieve and print every record
        while ($store = mysqli_fetch_array($stores)) {
            print "<h3>Store {$store['id']}</h3>
            <p>Location: {$store['location']}</p>";
            // Create query to retrieve reviews from entries table
            $reviewQuery = "SELECT review FROM entries WHERE storeid = {$store['id']}";
            if ($reviews = mysqli_query($conn, $reviewQuery)) { // Execute query
                // Retrieve and print every review
                while ($review = mysqli_fetch_array($reviews)) {
                    print "{$review['review']}<br>";
                }
            } else {
                print '<p style="color: red;">Could not retrieve the reviews because: <br>' . mysqli_error($conn) . 
                '</p><p>The query being run was: ' . $reviewQuery . '</p>';
            }
            print "<hr>";
        }
    } else {
        print '<p style="color: red;">Could not retrieve the stores because: <br>' . mysqli_error($conn) . 
        '</p><p>The query being run was: ' . $storeQuery . '</p>';
    }
    mysqli_close($conn); // Close the connection      
?>
</body>
</html>
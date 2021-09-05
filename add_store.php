<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add a Store</title>
</head>
<body>
    <h1>Add a Store</h1>
<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        //  Connect to the reviews database
        require("creds.php");
        // Set the character set
        mysqli_set_charset($conn, 'utf-8');
        // Validate the input
        $problem = FALSE;
        if (!empty($_POST['location'])) {
            $location = mysqli_real_escape_string($conn, trim(strip_tags($_POST['location'])));
        } else {
            print '<p style="color: red;">Please submit a location.</p>';
            $problem = TRUE;
        }

        if (!$problem) {
            // Define the query
            $query = "INSERT INTO stores (id, location) VALUES (0, '$location')";
            // Execute the query
            if (@mysqli_query($conn, $query)) {
                print '<p>The store has been added!</p>';
            } else {
                print '<p style="color: red;">Could not add the store because: <br>' . mysqli_error($conn) . 
                '</p><p>The query being run was: ' . $query . '</p>';
            }
        } // No problem
        mysqli_close($conn); // Close the connection to the database
    } // End of form submission IF
// Display the form        
?>
<form action="add_store.php" method="post">
    <p>Enter Your Location: <textarea name="location" cols="40" rows="5"></textarea></p>
    <input type="submit" name="submit" value="Add This Store!">
</form>
</body>
</html>
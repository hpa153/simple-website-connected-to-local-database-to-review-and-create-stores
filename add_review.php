<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add a Review</title>
</head>
<body>
<h1>Add a Review</h1>
<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        //  Connect to the reviews database
        require("creds.php");
        // Set the character set
        mysqli_set_charset($conn, 'utf-8');
        // Validate the input
        $problem = FALSE;
        if (!empty($_POST['name']) && !empty($_POST['review'])) {
            $name = mysqli_real_escape_string($conn, trim(strip_tags($_POST['name'])));
            $review = mysqli_real_escape_string($conn, trim(strip_tags($_POST['review'])));
            $storeid = $_POST['storeid'];
        } else {
            print '<p style="color: red;">Please submit both a name and a review.</p>';
            $problem = TRUE;
        }

        if (!$problem) {
            // Define the query
            $query = "INSERT INTO entries (id, name, review, date_entered, storeid) VALUES (0, '$name', '$review', NOW(), '$storeid')";
            // Execute the query
            if (@mysqli_query($conn, $query)) {
                print '<p>The review has been added!</p>';
            } else {
                print '<p style="color: red;">Could not add the review because: <br>' . mysqli_error($conn) . 
                '</p><p>The query being run was: ' . $query . '</p>';
            }
        } // No problem
        mysqli_close($conn); // Close the connection to the database
    } // End of form submission IF
// Display the form        
?>
<form action="add_review.php" method="post">
    <p>Enter Your Name: <input type="text" name="name" size="40" maxsize="100"></p>
    <p>Enter Your Review: <textarea name="review" cols="40" rows="5"></textarea></p>
    <p>Choose Store for Review: <select name="storeid">
        <?php
            //  Connect to the reviews database
            require("creds.php");
            // Create query
            $idQuery = 'SELECT id FROM stores';
            if ($records = mysqli_query($conn, $idQuery)) { // Execute query
                // Retrieve and print every record
                while ($data = mysqli_fetch_array($records)) {
                    print "<option value='{$data['id']}'>{$data['id']}</option>";
                }
            } else {
                print '<p style="color: red;">Could not retrieve the store ids because: <br>' . mysqli_error($conn) . 
                '</p><p>The query being run was: ' . $idQuery . '</p>';
            } 
        ?>
    </select></p>
    <input type="submit" name="submit" value="Post This Review!">
</form>
</body>
</html>
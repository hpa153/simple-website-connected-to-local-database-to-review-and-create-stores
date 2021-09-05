<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Review</title>
</head>
<body>
    <h1>Update Review</h1>
<?php
    // Retrieve id from GET request
    $id = $_GET['id'];
    
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
        } else {
            print '<p style="color: red;">Please submit both a name and a review.</p>';
            $problem = TRUE;
        }

        if (!$problem) {
            // Define the query
            $query = "UPDATE entries SET name = '$name', review = '$review' WHERE id = $id";
            // Execute the query
            $r = mysqli_query($conn , $query);
            
            if (mysqli_affected_rows($conn)==1) {
                print '<p>The review has been edited</p>';
            } else {
                print '<p style="color: red;">Could not edit the review because: <br>' . mysqli_error($conn) . 
                        '</p><p>The query being run was: ' . $query . '</p>';
            }
        } // No problem
        mysqli_close($conn); // Close the connection to the database
    } // End of form submission IF
// Display the form
?>
<form action="edit_review.php?id=<?php print $id ?>" method="post">
    <p>Edit Your Name: <input type="text" name="name" size="40" maxsize="100"></p>
    <p>Edit Your Review: <textarea name="review" cols="40" rows="5"></textarea></p>
    <input type="submit" name="submit" value="Edit This Review!">
</form>
</body>
</html>
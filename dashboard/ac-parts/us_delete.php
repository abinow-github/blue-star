<?php
include("../root/db.php");

$id = $_GET['sa'];

// Fetch the image filename before deleting the record
$fetchImageQuery = "SELECT images FROM ac_parts WHERE id = '$id'";
$result = $mysqli->query($fetchImageQuery);

if ($result->num_rows > 0) {
    $imageFilenames = explode(',', $result->fetch_assoc()['images']);

    // Loop through and delete each image file
    foreach ($imageFilenames as $filename) {
        unlink("../gallery/ac_parts/" . trim($filename));
    }

    // Delete the record from the database
    $deleteQuery = "DELETE FROM ac_parts WHERE id = '$id'";

    if (mysqli_query($mysqli, $deleteQuery)) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . mysqli_error($mysqli);
    }
} else {
    echo "Error fetching image filenames.";
}

// Redirect to the index page
header('location: index.php');
?>

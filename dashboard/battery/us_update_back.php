<?php
include("../root/db.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $imageId = mysqli_real_escape_string($mysqli, $_POST['image_id']);

    // Update other fields (title, date, text)
    $title = mysqli_real_escape_string($mysqli, $_POST['title']);
    $date = mysqli_real_escape_string($mysqli, $_POST['date']);
    $text = mysqli_real_escape_string($mysqli, $_POST['text']);

    $updateCaptionQuery = "UPDATE news SET title = '$title', date = '$date', text = '$text' WHERE id = '$imageId'";
    if (!mysqli_query($mysqli, $updateCaptionQuery)) {
        die('Error updating caption: ' . mysqli_error($mysqli));
    }

    // Check if new images are provided
    if (!empty($_FILES['new_images']['tmp_name'][0])) {
        // Fetch old image filenames from the database
        $fetchImageQuery = "SELECT images FROM news WHERE id = '$imageId'";
        $result = $mysqli->query($fetchImageQuery);

        if ($result->num_rows > 0) {
            $oldImageFilenames = explode(',', $result->fetch_assoc()['images']);

            // Delete old image files
            foreach ($oldImageFilenames as $oldImage) {
                unlink("../news-images/" . trim($oldImage));
            }

            // Clear the array of old filenames
            $oldImageFilenames = array();

            // Loop through each file
            foreach ($_FILES['new_images']['tmp_name'] as $key => $tmp_name) {
                // Your existing image upload and update logic here

                // Example:
                $maxFileSize = 1 * 1024 * 1024; // 1MB in bytes
                $fileSize = $_FILES['new_images']['size'][$key];

                if ($fileSize > $maxFileSize) {
                    $_SESSION['upload_error'] = "Error: File size exceeds the maximum allowed size (1MB).";
                    header("Location: index.php");
                    exit();
                }

                $temp1 = explode(".", $_FILES["new_images"]["name"][$key]);
                $newfilename1 = rand() . "_" . date('m-d-Y_hia') . '.' . end($temp1);
                move_uploaded_file($_FILES['new_images']['tmp_name'][$key], "../news-images/" . $newfilename1);

                // Add the new filename to the array of old filenames
                $oldImageFilenames[] = $newfilename1;
            }

            // Update images in the database
            $newImageFilenames = implode(',', $oldImageFilenames);
            $updateImageQuery = "UPDATE news SET images = '$newImageFilenames' WHERE id = '$imageId'";
            if (!mysqli_query($mysqli, $updateImageQuery)) {
                die('Error updating images: ' . mysqli_error($mysqli));
            }
        }
    }

    // Redirect back to the edit page
    header("Location: index.php");
    exit();
}

// If form is not submitted, redirect to the index page or any other desired location
header("Location: index.php");
exit();
?>

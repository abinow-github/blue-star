<?php
include("../root/db.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $imageId = mysqli_real_escape_string($mysqli, $_POST['image_id']);

    // Get other form data
    $name = mysqli_real_escape_string($mysqli, $_POST["name"]);
    $brand = mysqli_real_escape_string($mysqli, $_POST["brand"]);
    $weight = mysqli_real_escape_string($mysqli, $_POST["weight"]);
    $diamension = mysqli_real_escape_string($mysqli, $_POST["diamension"]);
    $unit = mysqli_real_escape_string($mysqli, $_POST["unit"]);
    $description = mysqli_real_escape_string($mysqli, $_POST["description"]);
    $url = mysqli_real_escape_string($mysqli, $_POST["url"]);
    $phone = mysqli_real_escape_string($mysqli, $_POST["phone"]);

    // Check product name not empty
    if (empty($name)) {
        $_SESSION['error_name'] = "Please enter product Name!";
        header("Location: us_update.php?sa=$imageId");
        exit();
    }
    if (empty($url)) {
        $url=$name;
    }
    $url = preg_replace('/[^a-zA-Z0-9\-]/', '', $url);
    $url = str_replace(' ', '-', $url);
    if (empty($phone)) {
        $phone='+971507611980';
    }

    $updateCaptionQuery = "UPDATE ac_parts SET
    name = '$name',
    brand = '$brand',
    weight = '$weight',
    diamension = '$diamension',
    unit = '$unit',
    url = '$url',
    phone = '$phone',
    description = '$description' WHERE id = '$imageId'";
    if (!mysqli_query($mysqli, $updateCaptionQuery)) {
        die('Error updating caption: ' . mysqli_error($mysqli));
    }

    // Check if new images are provided
    if (!empty($_FILES['new_images']['tmp_name'][0])) {
        // Fetch old image filenames from the database
        $fetchImageQuery = "SELECT images FROM ac_parts WHERE id = '$imageId'";
        $result = $mysqli->query($fetchImageQuery);

        if ($result->num_rows > 0) {
            $oldImageFilenames = explode(',', $result->fetch_assoc()['images']);

            // Delete old image files
            foreach ($oldImageFilenames as $oldImage) {
                unlink("../gallery/ac_parts/" . trim($oldImage));
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
                move_uploaded_file($_FILES['new_images']['tmp_name'][$key], "../gallery/ac_parts/" . $newfilename1);

                // Add the new filename to the array of old filenames
                $oldImageFilenames[] = $newfilename1;
            }

            // Update images in the database
            $newImageFilenames = implode(',', $oldImageFilenames);
            $updateImageQuery = "UPDATE ac_parts SET images = '$newImageFilenames' WHERE id = '$imageId'";
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

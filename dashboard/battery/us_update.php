<?php
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['username'])) {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.2/classic/ckeditor.js"></script>
    <title>Edit Image and Caption</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
   <?php
   include("../root/db.php");
   $id=$_GET['sa'];
   $sql="SELECT * FROM news WHERE id='$id'";
   $result=$mysqli->query($sql);
   if($result->num_rows>0){
    while($row=$result->fetch_assoc()){
?>
        <table width="100%" style="margin: auto;padding-top:20px" align="center" cellpadding="0" cellspacing="0">
            <tr>
                <td>
                    <form action="us_update_back.php" method="post" enctype="multipart/form-data" id="formID" class="formular">
                        <table width="100%" border="1" cellspacing="0" cellpadding="0">
                            <tr>
                                <td width="175">ID</td>
                                <td width="419"><input type="text" name="image_id" value="<?php echo $row['id'];?>" readonly/></td>
                            </tr>
                            
                            <tr>
                                <td style="text-align: center;">Images</td>
                                <td>
                                <?php
                                  $imageFilenames = explode(',', $row['images']);
                                  $num = count($imageFilenames);

                                  for ($i = 0; $i < $num; $i++) {
                                    $firstImage = trim($imageFilenames[$i]);
                                    $imagePath = "../news-images/" . $firstImage;
                                    ?>
                                      <img src="<?php echo $imagePath; ?>" alt="Current Image" style="max-width: 300px; max-height: 300px;">
                                      <?php
                                  }
                                  ?>
                                </td>
                            </tr>

                            <tr style="height: 50px;">
                                <td style="text-align: center;">Add New Images</td>
                                <td><input type="file" name="new_images[]" class="validate[required]" multiple /></td>
                            </tr>
                            
                            <tr>
                                <td style="text-align: center;">News Title</td>
                                <td style="width: 90%;"><input style="width: 99%;height: 60px;" type="text" name="title" value="<?php echo $row['title'];?>"/></td>
                            </tr>
                            
                            <tr style="height: 50px;">
                                <td style="text-align: center;">Date</td>
                                <td style="width: 90%;"><input  class="form-control" type="date" name="date" value="<?php echo $row['date'];?>"/></td>
                            </tr>
                            
                            <tr>
                                <td style="text-align: center;">News Content</td>
                                <td style="width: 90%;"><textarea name="text" id="editor"><?php echo $row['text'];?></textarea></td>
                            </tr>
                            
                        </table>
                        <br>
                        <input type="hidden" name="image_id" id="image_id" value="<?php echo $row['id']; ?>">
                        <div class="card">
                            <input type="submit" name="button" id="button" value="Submit" class="submit-btn"/>
                        </div>
                    </form>
                </td>
            </tr>
        </table>
<?php
        }
    }
?>
<script>
    ClassicEditor
        .create(document.querySelector('#editor'))
        .catch(error => {
            console.error(error);
        });
</script>
</body>
</html>
<?php 
} else {
    header("Location: ../login/index.php");
    exit();
}
?>

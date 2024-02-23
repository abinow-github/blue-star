<br><br><br>

<div class="container-fluid" style="background-color: #3dbb5f;color:white;padding:10px"><h4> Edit/Delete</h4></div>

<div class="blog-content">
<div class="container">
<?php
include("../root/db.php");
$sql = "SELECT * FROM battery";

$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $imageFilenames = explode(',', $row['images']);
        $firstImage = trim($imageFilenames[0]);
        $imagePath = "../gallery/battery" . $firstImage;
              ?>

             
				  <div class="card">
					<div class="card__header">
					  <img src="<?php echo $imagePath; ?>" alt="card__image" class="card__image" width="600">
					</div>
          <div class="card-body">
            <h4><?php echo $row['title'];?></h4>
          </div>
					<div class="card__footer">
					  <div class="button-div">
                        <a href="us_update.php?sa=<?php echo $row['id'];?>" style="margin-right: 5px;"><button>Edit</button></a>
                        <a href="us_delete.php?sa=<?php echo $row["id"];?>"><button>Delete</button></a>
							
							
					  </div>
                      </div>
                      </div>
                  <?php
                
              }
            }
	
                ?>
                
				
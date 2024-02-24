<?php
session_start(); // Start the session
$conn = mysqli_connect('localhost', 'root', '', 'bluestar');
$query = $conn->prepare('SELECT * FROM `battery`');
$query->execute();
$query_result = $query->get_result();

while ($row = $query_result->fetch_assoc()) {
    $table = 'battery';
    $_SESSION['table'] = $table;
    echo '<a href="batttery/'.$row['url'].'">'.$row['name'].'</a>';
    echo "<br>";
?>

<a class="card" href="battery/<?php echo $row['url']; ?>">
          <div class="img-div">
            <img src="../dashboard/gallery/battery/<?php echo $row['images']; ?>" alt="" srcset="">
          </div>
          <div class="card-body">
            <div class="card-title"><?php echo $row['name']; ?></div>
            <a href="product-details" class="call-btn mx-auto">Enquiry Now</a>
          </div>
        </div>
          </a>
          <?php 
}
          ?>
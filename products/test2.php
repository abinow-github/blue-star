<?php
session_start(); // Start the session

$conn = mysqli_connect('localhost', 'root', '', 'bluestar');
$url = $_GET['url'];

// Retrieve the value from the session
if (isset($_SESSION['table'])) {
    $table = $_SESSION['table'];
    // Don't unset the session variable unless you want to clear it explicitly
    // unset($_SESSION['table']);
} else {
    $table = ''; // Set a default value if the session variable is not set
}

$query = $conn->prepare('SELECT * FROM `battery` WHERE `url`= ?');
$query->bind_param('s', $url);
$query->execute();
$query_result = $query->get_result();

$query_data = $query_result->fetch_assoc();
echo '<h1>'.$query_data['brand'].'</h1>';
echo '<p>'.$query_data['weight'].'</p>';
?>
<h1><?php echo $table;?></h1>

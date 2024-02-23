<?php
define('BASE_URL', 'http://localhost/htdocs/bluestar/');
include('../dashboard/root/db.php');

// Check if the 'url' parameter is set in the URL
if(isset($_GET['url'])) {
    // Sanitize the input to prevent SQL injection
    $url = $mysqli->real_escape_string($_GET['url']);

   

    // Prepare the SQL query using a prepared statement
    $sql = "SELECT * FROM battery WHERE url = ?";
    
    // Bind the parameter to the prepared statement
    if($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("s", $url);

        // Execute the statement
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

        // Check if there are rows in the result
        if ($result->num_rows > 0) {
            // Fetch the data and display it
            while ($row = $result->fetch_assoc()) {
                ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>blue star</title>
    <!-- favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="../assets/img/logo/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/img/logo/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/img/logo/favicon-16x16.png">
    <link rel="manifest" href="../assets/img/logo/site.webmanifest">
    <link rel="mask-icon" href="../assets/img/logo/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <!-- css -->
    <link rel="stylesheet" href="../assets/css/style2.css">
    <link rel="stylesheet" href="../assets/css/products.css">

    <!-- bootsrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css'>

    <!-- font-awesome cdn-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<style>
  .container.product-details .imgBx:before {
    content: 'Acdelco';
    position: absolute;
    top: 0px;
    left: 24px;
    color: #000;
    opacity: 0.2;
    font-size: 5rem;
    font-weight: 800;
}
</style>
<body>
 <!-- header -->
    <header>

        <div id="mainNavigation">
           <nav role="navigation">
             <div class="text-center">
               <img src="../assets/img/logo/BLUE STAR LOGO.png" alt="" class="invert">
             </div>
           </nav>
           <div class="navbar-expand-lg">
             <div class="navbar-dark text-center my-2">
               <button class="navbar-toggler" type="button" onclick="showNav()"   aria-expanded="false" aria-label="Toggle navigation">
                 <span class="navbar-toggler-icon w-100 h-100"></span> <span class="align-middle"></span>
               </button>
             </div>
             <div class="text-center mt-3 collapse navbar-collapse d-flex" id="navbarNavDropdown">
               <div class="hide-on-lg close-div"> <button class="close-btn" onclick="closeNav()"><i class="fa-solid fa-xmark"></i></button></div>
               <ul class="navbar-nav mx-auto ">
                 <li class="nav-item">
                   <a class="nav-link" aria-current="page" href="../home">Home</a>
                 </li>
                 <li class="nav-item">
                   <a class="nav-link" href="../about">About</a>
                 </li>
                 <li class="nav-item">
                   <a class="nav-link" href="../brands">Brands</a>
                 </li>
                 <li class="nav-item dropdown">
                   <a class="nav-link dropdown-toggle"  id="navbarDropdownMenuLink" role="button" aria-expanded="false">
                     Products 
                   </a>
                   <ul class="dropdown-menu"  id="dropdown-menu">
                     <li class="col-lg-3 col-md-3 col-6"><a class="dropdown-item" href="filter"><img src="../assets/img/icons/dropdown/filters.png" alt="" srcset="">Filters</a></li>
                     <li class="col-lg-3 col-md-3 col-6"><a class="dropdown-item" href="battery"><img src="../assets/img/icons/dropdown/battery.png" alt="" srcset="">Battery</a></li>
                     <li class="col-lg-3 col-md-3 col-6"><a class="dropdown-item" href="marine-spare-parts"><img src="../assets/img/icons/dropdown/marine-spare-parts.png" alt="" srcset="">Marine Spare Parts</a></li>
                     <li class="col-lg-3 col-md-3 col-6"><a class="dropdown-item" href="engin-parts"><img src="../assets/img/icons/dropdown/engin-parts.png" alt="" srcset="">Engine parts</a></li><br>
                     <li class="col-lg-3 col-md-3 col-6"><a class="dropdown-item" href="electrical-parts"><img src="../assets/img/icons/dropdown/electrical-parts.png" alt="" srcset="">electrical parts</a></li>
                     <li class="col-lg-3 col-md-3 col-6"><a class="dropdown-item" href="body-parts"><img src="../assets/img/icons/dropdown/body-parts.png" alt="" srcset="">body parts</a></li>
                     <li class="col-lg-3 col-md-3 col-6"><a class="dropdown-item" href="suspenssion"><img src="../assets/img/icons/dropdown/suspension.png" alt="" srcset="">suspenssion</a></li>
                     <li class="col-lg-3 col-md-3 col-6"><a class="dropdown-item" href="ac-parts"><img src="../assets/img/icons/dropdown/ac-parts.png" alt="" srcset="">a/c parts</a></li>
                     <li class="col-lg-3 col-md-3 col-6"><a class="dropdown-item" href="other-parts"><img src="../assets/img/icons/dropdown/other-parts.png" alt="" srcset="">Other parts</a></li>
                   </ul>
                 </li>
                 <li class="nav-item">
                   <a class="nav-link" href="contact">Contact</a>
                 </li>
               </ul>
             </div>
           </div>
         </div>
       </header>
 <!-- header End -->

 <!-- banner -->
 <div class="banner2"></div>
 <!-- banner END -->


 <div class="container product-details mt-5 mb-5">
  <div class="imgBx">
      <img src="../assets/img/gallery/products/battery/Acdelco-car battery.png" alt="Nike Jordan Proto-Lyte Image">
  </div>
  <div class="details">

      <div class="content">
        <div class="title-specs-div">
          <h2>Acdelco-car battery<br>
              <span>Battery</span>
          </h2>
          <p class="description">dvhsdinovhiofughi dusfgusdigiu dufgiudlsguhlsdgiurh isurgiurntiusnunghdvhsdinovhiofughi dusfgusdigiu dufgiudlsguhlsdg</p>
          <h4 class="h4"><span>Brand</span>Acdelco</h4>
          <h4 class="h4"><span>Weight</span>40kg</h4>
          <h4 class="h4"><span>Diamension</span>L 21.26" W8.74" H9.45" Inches</h4>
          <h4 class="h4"><span>Unit</span>40kg</h4>
        </div>
          <div class="buttons-div d-flex">
            <button>Enquiry Now</button>
            <div class="pre-nxt-div">
              <a class="prev" href=""><i class="fa-solid fa-backward"></i>Prev.</a>
              <a class="next" href=""><i class="fa-solid fa-forward"></i>Next</a>
            </div>
          </div>
      </div>

  </div>
</div>

<?php
           }
        } else {
            // No rows found
            echo "No data found.";
        }

        // Close the statement
        $stmt->close();
    } else {
        // Error in preparing the statement
        echo "Error in preparing SQL statement.";
    }
} else {
    // 'url' parameter is not set in the URL
    echo "URL parameter 'url' is missing.";
}

// Close the database connection
$mysqli->close();
?>



 <footer id="footer"></footer>


    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- Then include Slick slider script -->
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script><script src="../assets/js/script.js"></script>
    <script src="../assets/js/footer.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js'></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
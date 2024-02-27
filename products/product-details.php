<?php
session_start();
include('../dashboard/root/db.php');
$url = $_GET['url'];
// Retrieve the value from the session
if (isset($_SESSION['table'])) {
    $table = $_SESSION['table'];
} else {
    $table = ''; // Set a default value if the session variable is not set
}

$query = $mysqli->prepare('SELECT * FROM '.$table.' WHERE `url`= ?');
$query->bind_param('s', $url);
$query->execute();
$query_result = $query->get_result();

$query_data = $query_result->fetch_assoc();

// Get all URLs from your database based on your logic
$allUrlsQuery = $mysqli->prepare('SELECT url FROM '.$table);
$allUrlsQuery->execute();
$allUrlsResult = $allUrlsQuery->get_result();
$allUrls = [];
while ($row = $allUrlsResult->fetch_assoc()) {
    $allUrls[] = $row['url'];
}

// Find the index of the current URL in the array
$currentUrlIndex = array_search($url, $allUrls);

// Calculate the index of the next URL considering the looping
$nextUrlIndex = ($currentUrlIndex + 1) % count($allUrls);
$prevUrlIndex = ($currentUrlIndex - 1 + count($allUrls)) % count($allUrls);


// Get the next URL
$nextUrl = $allUrls[$nextUrlIndex];
$prevUrl = $allUrls[$prevUrlIndex];

// Store the next URL in the session
$_SESSION['next_url'] = $nextUrl;
$_SESSION['prev_url'] = $prevUrl;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>blue star</title>
    <!-- favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo BASE_URL; ?>/assets/img/logo/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo BASE_URL; ?>/assets/img/logo/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo BASE_URL; ?>/assets/img/logo/favicon-16x16.png">
    <link rel="manifest" href="../assets/img/logo/site.webmanifest">
    <link rel="mask-icon" href="../assets/img/logo/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <!-- css -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/style2.css?v=538">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/products.css?v=3618">

    <!-- bootsrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css'>

    <!-- font-awesome cdn-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<style>
  .container.product-details .imgBx:before {
    content: '<?php echo $query_data['brand']?>';
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
               <img src="<?php echo BASE_URL; ?>/assets/img/logo/BLUE STAR LOGO.png" alt="" class="invert">
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
                   <a class="nav-link" aria-current="page" href="<?php echo BASE_URL; ?>home">Home</a>
                 </li>
                 <li class="nav-item">
                   <a class="nav-link" href="<?php echo BASE_URL; ?>about">About</a>
                 </li>
                 <li class="nav-item">
                   <a class="nav-link" href="<?php echo BASE_URL; ?>brands">Brands</a>
                 </li>
                 <li class="nav-item">
                  <a class="nav-link" href="<?php echo BASE_URL; ?>branch">Branches</a>
                </li>
                 <li class="nav-item dropdown">
                   <a class="nav-link dropdown-toggle"  id="navbarDropdownMenuLink" role="button" aria-expanded="false">
                     Products 
                   </a>
                   <ul class="dropdown-menu"  id="dropdown-menu">
                     <li class="col-lg-3 col-md-3 col-6"><a class="dropdown-item" href="../filter"><img src="<?php echo BASE_URL; ?>/assets/img/icons/dropdown/filters.png" alt="" srcset="">Filters</a></li>
                     <li class="col-lg-3 col-md-3 col-6"><a class="dropdown-item" href="../battery"><img src="<?php echo BASE_URL; ?>/assets/img/icons/dropdown/battery.png" alt="" srcset="">Battery</a></li>
                     <li class="col-lg-3 col-md-3 col-6"><a class="dropdown-item" href="../marine-spare-parts"><img src="<?php echo BASE_URL; ?>/assets/img/icons/dropdown/marine-spare-parts.png" alt="" srcset="">Marine Spare Parts</a></li>
                     <li class="col-lg-3 col-md-3 col-6"><a class="dropdown-item" href="../engin-parts"><img src="<?php echo BASE_URL; ?>/assets/img/icons/dropdown/engin-parts.png" alt="" srcset="">Engine parts</a></li><br>
                     <li class="col-lg-3 col-md-3 col-6"><a class="dropdown-item" href="../electrical-parts"><img src="<?php echo BASE_URL; ?>/assets/img/icons/dropdown/electrical-parts.png" alt="" srcset="">electrical parts</a></li>
                     <li class="col-lg-3 col-md-3 col-6"><a class="dropdown-item" href="../body-parts"><img src="<?php echo BASE_URL; ?>/assets/img/icons/dropdown/body-parts.png" alt="" srcset="">body parts</a></li>
                     <li class="col-lg-3 col-md-3 col-6"><a class="dropdown-item" href="../suspenssion"><img src="<?php echo BASE_URL; ?>/assets/img/icons/dropdown/suspension.png" alt="" srcset="">suspenssion</a></li>
                     <li class="col-lg-3 col-md-3 col-6"><a class="dropdown-item" href="../ac-parts"><img src="<?php echo BASE_URL; ?>/assets/img/icons/dropdown/ac-parts.png" alt="" srcset="">a/c parts</a></li>
                     <li class="col-lg-3 col-md-3 col-6"><a class="dropdown-item" href="../other-parts"><img src="<?php echo BASE_URL; ?>/assets/img/icons/dropdown/other-parts.png" alt="" srcset="">Other parts</a></li>
                   </ul>
                 </li>
                 <li class="nav-item">
                   <a class="nav-link" href="<?php echo BASE_URL; ?>contact">Contact</a>
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
      <img src="<?php echo BASE_URL; ?>/dashboard/gallery/<?php echo $table ?>/<?php echo $query_data['images'] ?>" alt="Nike Jordan Proto-Lyte Image">
  </div>
  <div class="details">

      <div class="content">
        <div class="title-specs-div">
          <h2><?php echo $query_data['name']?>
              <span><?php echo $table ?></span>
          </h2>
          <p class="description"><?php echo $query_data['description'] ?></p>
          <h4 class="h4"><span>Brand</span><?php echo $query_data['brand'] ?></h4>
          <h4 class="h4"><span>Weight</span><?php echo $query_data['weight'] ?></h4>
          <h4 class="h4"><span>Diamension</span><?php echo $query_data['diamension'] ?></h4>
          <h4 class="h4"><span>Unit</span><?php echo $query_data['unit'] ?></h4>
        </div>
          <div class="buttons-div d-flex">
            <button onclick="window.location.href='tel:<?php echo $query_data['phone'] ?>'">Enquiry Now</button>
            <div class="pre-nxt-div">
              <a class="prev" href="<?php echo BASE_URL; ?>products/battery/<?php echo $prevUrl; ?>"><i class="fa-solid fa-backward"></i>Prev.</a>
              <a class="next" href="<?php echo BASE_URL; ?>products/battery/<?php echo $nextUrl; ?>"><i class="fa-solid fa-forward"></i>Next</a>
            </div>
          </div>
      </div>

  </div>
</div>




 <footer>
 <div class="container">
    <div class="row">
      <div class="col-md-4 pr-md-5 d-flex text-center align-items-center justify-content-center" >
        <a href="#" class="footer-site-logo d-block mb-4"><img src="<?php echo BASE_URL; ?>/assets/img/logo/BLUE STAR LOGO.png" height="50px" alt="" srcset=""></a>
      </div>
      <div class="col-md">
        <h3>Menu</h3>
        <ul class="list-unstyled nav-links">
          <li><a href="<?php echo BASE_URL; ?>../home">Home</a></li>
          <li><a href="<?php echo BASE_URL; ?>../about">About Us</a></li>
          <li><a href="<?php echo BASE_URL; ?>../brands">Brands</a></li>
          <li><a href="<?php echo BASE_URL; ?>../contact">Contact</a></li>
        </ul>
      </div>
      <div class="col-md">
        <h3>Products</h3>
        <ul class="list-unstyled nav-links">
          <li><a href="../battery">Battery</a></li>
          <li><a href="../filter">Filter</a></li>
          <li><a href="../marine-spare-parts">Marine Spare Parts</a></li>
        </ul>
      </div>
      
      <div class="col-md">
        <h3>Follow Us</h3>
        <ul class="social list-unstyled">
          <li><a href="#" class="pl-0"><i class="fa-brands fa-instagram"></i></a></li>
          <li><a href="#"><i class="fa-brands fa-x-twitter"></i></a></li>
          <li><a href="#"><i class="fa-brands fa-facebook"></i></a></li>
        </ul>
      </div>
    </div> 

    <div class="row ">
      <div class="col-12 text-center">
        <div class="copyright mt-5 pt-5">
          <p><small>&copy; 2024 All Rights Reserved.</small></p>
        </div>
      </div>
    </div> 
  </div>
  <img src="help/composition-different-car-accessories.jpg" class="pos-abs-img" alt="" srcset="">
 </footer>


    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- Then include Slick slider script -->
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script><script src="<?php echo BASE_URL; ?>/assets/js/script.js"></script>
    <script src="<?php echo BASE_URL; ?>/assets/js/footer.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js'></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
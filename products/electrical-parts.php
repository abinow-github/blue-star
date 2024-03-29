<?php
session_start();
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
                 <li class="nav-item">
                  <a class="nav-link" href="../branch">Branches</a>
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
 <div class="banner">
    <div class="container">
        <a class="pos-abs-title"> electrical parts </a>
    </div>
 </div>
 <!-- banner END-->


 <!-- section-1 -->
 <section class="section-1 filter">
  <div class="container">
  <div class="row">
    <?php
    include('../dashboard/root/db.php');
$query = $mysqli->prepare('SELECT * FROM `electrical_parts`');
$query->execute();
$query_result = $query->get_result();
$nextUrls = array();
for (; $row = $query_result->fetch_assoc(); ) {
    $table = 'electrical_parts';
    $_SESSION['table'] = $table;
    ?>
    <div class="col-lg-3 col-md-4 col-6">
        <div class="card" onclick="window.location.href='electrical-parts/<?php echo $row['url'] ?>'">
            <div class="img-div">
                <img src="../dashboard/gallery/electrical_parts/<?php echo $row['images']; ?>" alt="" srcset="">
            </div>
            <div class="card-body">
                <div class="card-title"><?php echo $row['name']; ?></div>
                <a href="tel:<?php echo $row['phone']; ?>" class="call-btn mx-auto">Enquiry Now</a>
            </div>
        </div>
    </div>

<?php
}
// Store all next URLs in the session
$_SESSION['next_urls'] = $nextUrls;
?>
    </div>
  </div>
 </section>
 <!-- section-1 END -->



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
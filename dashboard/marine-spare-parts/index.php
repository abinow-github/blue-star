<?php 
session_start();

// Check if the user is not authenticated (not logged in)
if (!isset($_SESSION["username"])) {
    header("Location:../login/index.php"); // Redirect to the login page
    exit();
}
if (isset($_SESSION['upload_error'])) {
  echo '<script>alert("' . $_SESSION['upload_error'] . '");</script>';
  unset($_SESSION['upload_error']);
}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php
  
  include("../root/db.php");
  ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dashboard</title>
    <link rel="stylesheet" href="../css/card.css">
        <!-- Custom CSS -->
       
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.2/classic/ckeditor.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light w-100" style="position: fixed;top:0;height:100px;">
        <div class="container-fluid">
          <a class="navbar-brand" style="color:white">Dashboard</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarScroll">
            <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll profile" style="--bs-scroll-height: 100px;">
             
              
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img
                    src="../user.png"
                    class="rounded-circle"
                    height="50"
                    alt="bluestar"
                    loading="lazy"
                  />
                </a>
                <ul class="dropdown-menu profile-menu" aria-labelledby="navbarScrollingDropdown">
                  <li><a class="dropdown-item" href="#"><?php echo $_SESSION['username']; ?></a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="../login/logout_action.php">Log out</a></li>
                </ul>
              </li>
              
            </ul>
           
          </div>
        </div>
      </nav>
   

<div class="contents" style="margin-top: 100px;">
    <div class="side-menu" style="position: fixed;">
        <ul>
            <li><a href="../battery"><img src="../../assets/img/icons/dropdown/battery.png" alt="">Battery</a></li>
            <li><a href="../filter"><img src="../../assets/img/icons/dropdown/filters.png" alt="">Filter</a></li>
            <li class="active"><a href=""><img src="../../assets/img/icons/dropdown/marine-spare-parts.png" alt="">Marine Spare Parts</a></li>
            <li><a href="../engin-parts"><img src="../../assets/img/icons/dropdown/engin-parts.png" alt="">Engine Parts</a></li>
            <li><a href="../electrical-parts"><img src="../../assets/img/icons/dropdown/electrical-parts.png" alt="">Electrical Parts</a></li>
            <li><a href="../body-parts"><img src="../../assets/img/icons/dropdown/body-parts.png" alt="">Body Parts</a></li>
            <li><a href="../suspenssion"><img src="../../assets/img/icons/dropdown/suspension.png" alt="">Suspension</a></li>
            <li><a href="../ac-parts"><img src="../../assets/img/icons/dropdown/ac-parts.png" alt="">A/C Parts</a></li>
            <li><a href="../other-parts"><img src="../../assets/img/icons/dropdown/other-parts.png" alt="">Other Parts</a></li>
        </ul>
    </div>
    <div class="content" style="margin-left: 200px;">
    <div class="container-fluid" style="background-color: #336db6;color:white;padding:10px"><h4> Add marine spare parts</h4></div>
    <div class="blog-content">
				<div class="container">
				 
         
          <form action="us_add_back.php" method="post" enctype="multipart/form-data" id="formID" class="formular">
			
				<!--............blog...............-->

        <div style="box-shadow: inset 0px 0px 3px rgb(60 64 67 / 40%);background: #f3f3f3; border-radius:10px; padding: 10px;padding:20px;    width: 950px;" id="page-wrapper">
          <div class="container-fluid">
              <div class="row">
                <div class="col-md-8">
                
               
                

              <div class="form-group">
              
              <label>Images (maximum file size 1mb / use png images)</label><br>
              <input type="file" name="images[]" class="validate[required]" multiple>
                                      </div>
              
          </div>
          <br><br>
          <br>

         <div class="form-group col-md-6">
         <label>Product Name</label>
              <input class="form-control" type="text" name="name">
          </div><br><br><br>
          
         <div class="form-group col-md-6">
         <label>Brand</label>
              <input class="form-control" type="text" name="brand">
          </div><br><br><br>
          
         <div class="form-group col-md-6">
         <label>Weight</label>
              <input class="form-control" type="text" name="weight">
          </div><br><br><br>
          
         <div class="form-group col-md-6">
         <label>Diamension</label>
              <input class="form-control" type="text" name="diamension">
          </div><br><br><br>
          
         <div class="form-group col-md-6">
         <label>unit</label>
              <input class="form-control" type="text" name="unit">
          </div><br><br><br>
          
         <div class="form-group col-md-6">
         <label>Description</label>
              <input class="form-control" type="text" name="description">
          </div><br><br><br>
          
         <div class="form-group col-md-6">
         <label>URL</label>
              <input class="form-control" type="text" name="url">
          </div><br><br><br>

         <div class="form-group col-md-6">
         <label>Phone Number (optional)</label>
              <input class="form-control" type="number" name="phone" placeholder="+971 50 761 1980">
          </div><br><br><br>

       

         

                  </div>
         
            
                  

              </div>
            
      

          </div>
    

</div>
				  
				 
				 <!--...............blog..............-->
         <div class="container">
        
         <div style="text-align: center;">
         
                <button type="submit" class="btn btn-default" style="background-color: var(--red);color:white">Submit</button>
                </div>
                </div>
                  <script>
    ClassicEditor
        .create(document.querySelector('#editor'))
        .catch(error => {
            console.error(error);
        });
</script>

</form>

<div class="w-100">
<?php include("us_select.php"); ?>
        </div>
				</div>



        
				</div>




</div>


</body>
</html>

<?php 
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($con);
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Triploo | See the World Your Way</title>

  <!-- Fav Icon -->
  <link rel="icon" href="/images/logos/favIconPng.png" />

  <!-- Bootstrap 5 css file -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" />

  <!-- External CSS file -->
  <link rel="stylesheet" href="/style.css" />

  <!-- Utilities Css file -->
  <link rel="stylesheet" href="/css/utilities.css">

  <!-- Dizzpy custom button  -->
  <link rel="stylesheet" href="/css/dizzpyButton.css">

  <!-- Remix icon cdn -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.min.css" />

  <!-- Google font link -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Gabarito:wght@400;500;600;700;800;900&family=Lato:wght@700&family=Onest:wght@100;200;300;400;500;600;700;800;900&family=Source+Sans+3:wght@600&display=swap"
    rel="stylesheet" />

    <style>
      /* content start here */
  .ProfileTabTopMargin{
    margin-top: 12%;
  }

  .P-DisplayPictureDiv{
    border-radius: 50%;
  }
  .P-DisplayPicture{
    width: 250px;
    height: 250px;
  }

    </style>
</head>

<body>


  <!-- Nav Bars start -->
  <div class="container-fluid">
    <div class="container fixed-top">
      <nav class="navbar navbar-expand-lg bg-body-tertiary px-4 py-0 mt-4 d-NavContainerFluid">
        <a class="navbar-brand" href="#">
          <img src="/images/logos/logoPrimary.svg" alt="MainLogo" class="main-logo" />
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link D-Active" href="/index.html">Home</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="/html/J-PackagesMain.html">Packages</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="/html/T-Shop-MainPage.html">Shop</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="/html/M-Blog-MainPage.html">Blog</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="/html/about-us.html">About</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="/html/contact-us.html">Contact</a>
            </li>
          </ul>
          <div class="d-flex justify-content-center g-4">
            <a href="login.php" target="_blank">
              <button class="D-Button-Primary text-center">
                Login
              </button>
            </a>
            <div>
              <!-- <a href="profile.php">
                <img src="https://placehold.co/45" alt="Profile Icon" class="D-MainAccountPFP" id="D-MainAccountPFP">
              </a> -->
            </div>
            
          </div>
        </div>
      </nav>
    </div>
  </div>
  <!-- NavBar end -->


  <!-- content start -->
  <div class="space-tab-100"></div>

  <div class="ProfileTabTopMargin"></div>
  <div class="container">
    <div class="P-DisplayPictureDiv text-center">

        <?php 
        // Check if the profile picture exists
        if (!empty($user_data['profile_picture']) && file_exists($user_data['profile_picture'])) {
            $profile_picture = $user_data['profile_picture'];
        } else {
            $profile_picture = 'default.png'; // Provide a default picture path or use a placeholder
        }
        ?>


        <img src="<?php echo $profile_picture; ?>" alt="Profile Picture" class="P-DisplayPicture">

        <div class="P-text mt-5">
            <h1>
                <span class="normalP">Hello </span>
                <span class="Pnamephp">
                <?php echo $user_data['user_name']; ?>
                </span> 
            </h1>
            <h4 class="Psubtext mt-2">Welcome to Triploo</h4>
        </div>

        <!-- logout button -->
        <a href="logout.php" target="_blank">
            <button class="D-Button-Primary text-center mt-5" type="submit">
              LogOut
            </button>
          </a>
    </div>
  </div>
  <!-- content end -->
  

  <!-- 
      =======================================
            JavaScript Section
      =======================================
  -->



  <!-- Bootstrap 5 js file -->
  <!-- <script src="js/bootstrap.bundle.min.js"></script> -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

  <!-- External JS file -->
  <script src="/js/script.js"></script>
  <script src="/js/home-page.js"></script>
</body>

</html>
<?php 
session_start();

include("connection.php");
include("functions.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $user_name = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    $profilePicture = ''; // Initialize profile picture variable

    if (!empty($_FILES['profile_picture']['name'])) {
        $target_directory = "uploads/";
        $target_file = $target_directory . basename($_FILES["profile_picture"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["profile_picture"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["profile_picture"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
                $profilePicture = $target_file; // Set profile picture path
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }

    if (!empty($user_name) && !empty($password) && !empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $user_id = generateRandomString(20);

        // No hashing, storing plain text password
        $plain_password = $password;

        // Use prepared statements to prevent SQL injection
        $stmt = $con->prepare("INSERT INTO users (user_id, user_name, password, email, profile_picture) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $user_id, $user_name, $plain_password, $email, $profilePicture);

        if ($stmt->execute()) {
            header("Location: login.php");
            exit;
        } else {
            echo "Error: " . $stmt->error;
        }
    } else {
        echo "Please enter valid information!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Triploo | Login With Your Account</title>

    <!-- Fav Icon -->
    <link rel="icon" href="/images/logos/favIconPng.png" />

    <!-- Bootstrap 5 css file -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" />

    <!-- External CSS file -->
    <link rel="stylesheet" href="../css/style.css" />

    <!-- Utilities Css file -->
    <link rel="stylesheet" href="../css/utilities.css" />

    <!-- Dizzpy custom button  -->
    <link rel="stylesheet" href="../css/dizzpayButton.css" />

    <!-- About us CSS -->
    <link rel="stylesheet" href="../css/pages/about-us.css" />

    <!-- Login and Singup button css file -->
    <link rel="stylesheet" href="../css/pages/login-singup.css">

    <!-- Remix icon cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.min.css" />

    <!-- Google font link -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Gabarito:wght@400;500;600;700;800;900&family=Lato:wght@700&family=Onest:wght@100;200;300;400;500;600;700;800;900&family=Source+Sans+3:wght@600&display=swap"
        rel="stylesheet" />
</head>

<body>

  <!-- Nav Bars start -->
  <div class="container-fluid">
    <div class="container fixed-top">
      <nav class="navbar navbar-expand-lg bg-body-tertiary px-4 py-0 mt-4 d-NavContainerFluid">
        <a class="navbar-brand" href="/index.html">
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
              
          </div>
        </div>
      </nav>
    </div>
  </div>
  <!-- NavBar end -->







  <form method="post" enctype="multipart/form-data">
  <div class="col-12 col-md-5 col-lg-6">
                                <div class="card px-4 py-3">
                                    <h1 class="Log-MainText mt-4">Welcome Back</h1>
                                    <p class="Log-SubHeading">We are really happy to see you again!</p>

                                    <!-- Search box section -->
                                    <div class="Log-InputBoxs">
                                        <!-- Full name -->
                                        <div class="mb-4">
                                            <label for="username" class="form-label">
                                                <span class="j-SearchBarLabel">UserName <span
                                                        class="j-redStarMark">*</span></span>
                                            </label>
                                            <input name="username" type="text" class="form-control form-input" id="username"
                                                placeholder="JohnDoe" required>
                                        </div>
                                        <!-- User name -->
                                        <div class="mb-4">
                                            <label for="username" class="form-label">
                                                <span class="j-SearchBarLabel">Email <span
                                                        class="j-redStarMark">*</span></span>
                                            </label>
                                            <input name="email" type="email" class="form-control form-input" id="username"
                                                placeholder="johndoe123@email.com" required>
                                        </div>
                                        <!-- Password -->
                                        <div class="mb-4">
                                            <label for="password" class="form-label">
                                                <span class="j-SearchBarLabel">Password <span
                                                        class="j-redStarMark">*</span></span>
                                            </label>
                                            <input name="password" type="password" class="form-control form-input" id="password"
                                                placeholder="Password" required>
                                        </div>

                                        <!-- profile picture -->
                                        <div class="mb-4">
                                            <label for="password" class="form-label">
                                                <span class="j-SearchBarLabel">Profile Picture <span
                                                        class="j-redStarMark">*</span></span>
                                            </label>
                                            <br>
                                            <input type="file" name="profile_picture">
                                        </div>





                                        <!-- checkbox -->
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                            <label class="form-check-label j-SearchBarLabel" for="flexCheckDefault">
                                                Agree with Privacy Policies
                                            </label>
                                          </div>
                                    </div>
                                    <!-- Login button -->
                                    <div class="Log-LoginButton text-center mt-3 mb-3">
                                        <button class="D-Button-Primary btn-block" type="submit">Register</button>
                                    </div>

                                    
                                    <a href="login.php"><p class="Log-SubHeading mt-3 text-center">Click to Login</p></a>
                                </div>
                            </div>
  </form>










  

    <!-- Bootstrap 5 js file -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- components js -->
</body>

</html>
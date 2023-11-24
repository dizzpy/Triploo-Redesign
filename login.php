<?php
session_start();

include("connection.php");
include("functions.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // something was posted
    $user_name = $_POST['username'];
    $password = $_POST['password'];

    if (!empty($user_name) && !empty($password)) {
        // read from database
        $query = "SELECT * FROM users WHERE user_name = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param("s", $user_name);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user_data = $result->fetch_assoc();
            $stored_password = $user_data['password'];

            // Verify password without hashing
            if ($password === $stored_password) {
                $_SESSION['user_id'] = $user_data['user_id'];
                header("Location: profile.php");
                die;
            } else {
                echo "Wrong username or password!";
            }
        } else {
            echo "Wrong username or password!";
        }
    } else {
        echo "Please enter username and password!";
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
    <link rel="icon" href="../images/logos/favIconPng.png" />

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





<form method="post">
<div class="col-12 col-md-5 col-lg-6">
                                <div class="card px-4 py-3">
                                    <h1 class="Log-MainText mt-4">Welcome to Triploo</h1>
                                    <p class="Log-SubHeading">We are really happy to see you again!</p>

                                    <!-- Search box section -->
                                    <div class="Log-InputBoxs">
                                        <!-- User name -->
                                        <div class="mb-4">
                                            <label for="username" class="form-label">
                                                <span class="j-SearchBarLabel">Username <span
                                                        class="j-redStarMark">*</span></span>
                                            </label>
                                            <input type="text" class="form-control form-input" id="username"
                                                placeholder="JohnDoe" name="username" required>
                                        </div>
                                        <!-- Password -->
                                        <div class="mb-4">
                                            <label for="password" class="form-label">
                                                <span class="j-SearchBarLabel">Password <span
                                                        class="j-redStarMark">*</span></span>
                                            </label>
                                            <input type="password" class="form-control form-input" id="password"
                                                placeholder="Password" name="password" required>
                                        </div>
                                    </div>
                                    <!-- Login button -->
                                    <div class="Log-LoginButton text-center mt-3 mb-3">
                                        <button class="D-Button-Primary btn-block" type="submit">Login</button>
                                    </div>

                                    <a href="signup.php"><p class="Log-SubHeading mt-3 text-center">Click to Login</p></a>
                                </div>
                            </div>
</form>



    <!-- Bootstrap 5 js file -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- components js -->
</body>

</html>
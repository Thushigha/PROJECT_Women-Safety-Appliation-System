<?php
require_once "dbcon.php";

// Define variables and initialize with empty values
$username = $mobile = $email = $password = "";
$username_err = $mobile_err = $email_err = $password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Validate username
  $input_username = trim($_POST["username"]);
  if (empty($input_username)) {
    $username_err = "Please enter the username.";
  } else {
    $username = $input_username;
  }

  // Validate mobile
  $input_mobile = trim($_POST["mobile"]);
  if (empty($input_mobile)) {
    $mobile_err = "Please enter the mobile.";
  } elseif (!ctype_digit($input_mobile)) {
    $mobile_err = "Please enter a positive integer value.";
  } else {
    $mobile = $input_mobile;
  }

  // validate role
  $input_role = trim($_POST["role"]);
  if (empty($input_role)) {
    $role_err = "Please select the role.";
  } else {
    $role = $input_role;
  }

  // Validate email
  $input_email = trim($_POST["email"]);
  if (empty($input_email)) {
    $email_err = "Please enter the email.";
  } else {
    $email = $input_email;
  }

  // Validate password
  $input_password = trim($_POST["password"]);
  if (empty($input_password)) {
    $password_err = "Please enter the password.";
  } else {
    $password = $input_password;
  }

  // Check input errors before inserting in database
  if (empty($username_err) && empty($mobile_err) && empty($email_err) && empty($password_err) && empty($role_err)) {
    // Prepare an insert statement
    $sql = "INSERT INTO users (username, mobile, email, password, role) VALUES (:username, :mobile, :email, :password, :role)";

    if ($stmt = $pdo->prepare($sql)) {
      // Bind variables to the prepared statement as parameters
      $stmt->bindParam(":username", $param_username);
      $stmt->bindParam(":mobile", $param_mobile);
      $stmt->bindParam(":email", $param_email);
      $stmt->bindParam(":password", $param_password);
      $stmt->bindParam(":role", $param_role);

      // Set parameters
      $param_username = $username;
      $param_mobile = $mobile;
      $param_email = $email;
      $param_password = $password;
      $param_role = $role;

      // Attempt to execute the prepared statement
      if ($stmt->execute()) {
        // Records created successfully. Redirect to landing page
        header("location: user.php");
        exit();
      } else {
        echo "Oops! Something went wrong. Please try again later.";
      }
    }

    // Close statement
    unset($stmt);
  }

  // Close connection
  unset($pdo);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <title>
    Women Security Application System
  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="assets/css/material-dashboard.css?v=3.0.4" rel="stylesheet" />
</head>

<body class="">
  <div class="container position-sticky z-index-sticky top-0">
    <div class="row">
      <div class="col-12">
        <!-- Navbar -->
        <!-- End Navbar -->
      </div>
    </div>
  </div>
  <main class="main-content  mt-0">
    <section>
      <div class="page-header min-vh-100">
        <div class="container">
          <div class="row">
            <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 start-0 text-center justify-content-center flex-column">
              <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center" style="background-image: url('assets/img/illustrations/illustration-signup.jpg'); background-size: cover;">
              </div>
            </div>
            <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column ms-auto me-auto ms-lg-auto me-lg-5">
              <div class="card card-plain">
                <div class="card-header">
                  <h4 class="font-weight-bolder">Sign Up</h4>
                  <p class="mb-0">Enter your email and password to register</p>
                </div>
                <div class="card-body">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="input-group input-group-outline mb-3">
                      <label class="form-label"></label>
                      <input name="username" class="form-control" placeholder="Name" type="text">
                    </div>
                    <div class="input-group input-group-outline mb-3">
                      <label class="form-label"></label>
                      <input name="email" class="form-control" placeholder="Email" type="email">
                    </div>
                    <div class="input-group input-group-outline mb-3">
                      <label class="form-label"></label>
                      <input name="mobile" class="form-control" placeholder="Mobile number" type="text">
                    </div>
                    <div class="input-group input-group-outline mb-3">
                      <label class="form-label"></label>
                      <input id="password" name="password" class="form-control" placeholder="Create password" type="password">
                    </div>
                    <div class="input-group input-group-outline mb-3">
                      <label class="form-label"></label>
                      <input id="cpassword" name="cpassword" class="form-control" placeholder="Repeat password" type="password">
                    </div>
                    <div class="input-group input-group-outline mb-3">
                      <label class="form-label">Login Type</label>
                      <select name="role" class="form-control" required>
                        <option value="" selected=""></option>
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                        <option value="police">Police</option>
                      </select>
                    </div>
                    <div class="form-check form-check-info text-start ps-0">
                      <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" checked>
                      <label class="form-check-label" for="flexCheckDefault">
                        I agree the <a href="javascript:;" class="text-dark font-weight-bolder">Terms and Conditions</a>
                      </label>
                    </div>
                    <div class="text-center">
                      <input type="submit" class="btn btn-lg bg-gradient-primary btn-lg w-100 mt-4 mb-0" value="Submit">
                      <!-- <button type="submit" value="submit" class="btn btn-lg bg-gradient-primary btn-lg w-100 mt-4 mb-0">Sign Up</button> -->
                    </div>
                  </form>
                </div>
                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                  <p class="mb-2 text-sm mx-auto">
                    Already have an account?
                    <a href="sign-in.php" class="text-primary text-gradient font-weight-bold">Sign in</a>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  <!--   Core JS Files   -->
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>
  <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var password = document.getElementById("password"),
      confirm_password = document.getElementById("cpassword");

    function validatePassword() {
      if (password.value != confirm_password.value) {
        confirm_password.setCustomValidity("Passwords Don't Match");
      } else {
        confirm_password.setCustomValidity('');
      }
    }

    // password.onchange = validatePassword;
    confirm_password.onchange = validatePassword;
  </script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="assets/js/material-dashboard.min.js?v=3.0.4"></script>
</body>

</html>
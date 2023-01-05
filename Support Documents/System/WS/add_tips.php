<?php
session_start();
include 'header.php';
require_once "dbcon.php";


if (empty($_SESSION['user_id'])) {
  header('Location: sign-in.php');
}

// Define variables and initialize with empty values
$tip = "";
$tip_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Validate tip
  $input_tip = trim($_POST["tip"]);
  if (empty($input_tip)) {
    $tip_err = "Please enter the tip.";
  } else {
    $tip = $input_tip;
  }

  // Check input errors before inserting in database
  if (empty($tip_err)) {
    // Prepare an insert statement
    $sql = "INSERT INTO safety_tips (tip) VALUES (:tip)";

    if ($stmt = $pdo->prepare($sql)) {
      // Bind variables to the prepared statement as parameters
      $stmt->bindParam(":tip", $param_tip);

      // Set parameters
      $param_tip = $tip;

      // Attempt to execute the prepared statement
      if ($stmt->execute()) {
        // Records created successfully. Redirect to landing page
        header("location: women_safety_tips.php");
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

if ($_SESSION['role'] != 'admin') {
  header('Location: dashboard.php');
}
?>

<?php include 'sidenav.php'; ?>

<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

  <!-- Navbar -->
  <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
    <div class="container-fluid py-1 px-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
          <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
          <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Women Safety Tips</li>
        </ol>
        <h6 class="font-weight-bolder mb-0">Women Safety Tips</h6>
      </nav>
      <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
        <div class="ms-md-auto pe-md-3 d-flex align-items-center">
          <div class="input-group input-group-outline">
            <label class="form-label">Type here...</label>
            <input type="text" class="form-control">
          </div>
        </div>
        <ul class="navbar-nav  justify-content-end">
            <li class="nav-item d-flex align-items-center">

            </li>
            <?php if(isset($_SESSION['user_id'])): ?>
            <li class="nav-item d-flex align-items-center">
              <a href="logout.php" class="nav-link text-body font-weight-bold px-0">
                <i class="fa fa-user me-sm-1"></i>
                <span class="d-sm-inline d-none">Logout</span>
              </a>
            </li>
            <?php endif; ?>
            <?php if(!isset($_SESSION['user_id'])): ?>
            <li class="nav-item d-flex align-items-center">
              <a href="sign-in.php" class="nav-link text-body font-weight-bold px-0">
                <i class="fa fa-user me-sm-1"></i>
                <span class="d-sm-inline d-none">Sign In</span>
              </a>
            </li>
            <?php endif; ?>
          </ul>
      </div>
    </div>
  </nav>
  <!-- End Navbar -->

  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">CREATE WOMEN SAFETY TIPS</h4>
        <div class="col-12 grid-margin">
          <div class="card">
            <div class="card-body">
              <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <textarea placeholder="Have a Plan. When you are going out, whether it be alone or with a group of friends, it is best to have a plan in place." id="w3review" name="tip" rows="15" cols="125"></textarea>
                <div class="row">
                  <div class="col-md-6">
                    <input type="submit" class="btn btn-primary mr-2" value="Submit">
                    <a href="women_safety_tips.php" class="btn btn-dark">Cancel</a>
                  </div>
                  <div class="col-md-6">
                  </div>
                </div>
            </div>
          </div>
          <?php include 'footer.php'; ?>
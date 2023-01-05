<?php
session_start();
include 'header.php';
require_once "dbcon.php";


if (empty($_SESSION['user_id'])) {
  header('Location: sign-in.php');
}

// Define variables and initialize with empty values
$district = $police_station = "";
$district_err = $police_station_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Validate district
  $input_district = trim($_POST["district"]);
  if (empty($input_district)) {
    $district_err = "Please enter the district.";
  } else {
    $district = $input_district;
  }

  // Validate police_station
  $input_police_station = trim($_POST["police_station"]);
  if (empty($input_police_station)) {
    $police_station_err = "Please enter the police station.";
  } else {
    $police_station = $input_police_station;
  }

  // Check input errors before inserting in database
  if (empty($district_err) && empty($police_station_err)) {
    // Prepare an insert statement
    $sql = "INSERT INTO police_stations (district, police_station) VALUES (:district, :police_station)";

    if ($stmt = $pdo->prepare($sql)) {
      // Bind variables to the prepared statement as parameters
      $stmt->bindParam(":district", $param_district);
      $stmt->bindParam(":police_station", $param_police_station);

      // Set parameters
      $param_district = $district;
      $param_police_station = $police_station;

      // Attempt to execute the prepared statement
      if ($stmt->execute()) {
        // Records created successfully. Redirect to landing page
        header("location: police_station.php");
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
<?php include 'sidenav.php'; ?>

<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

  <!-- Navbar -->
  <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
    <div class="container-fluid py-1 px-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
          <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
          <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Police Station</li>
        </ol>
        <h6 class="font-weight-bolder mb-0">Police Station</h6>
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
        <h4 class="card-title">CREATE NEW POLICE STATION</h4>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
          <div class="form-group">
            <label>Police Station</label>
            <input type="text" name="police_station" class="form-control <?php echo (!empty($police_station_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $police_station; ?>" placeholder="Police Station">
            <span class="invalid-feedback"><?php echo $police_station_err; ?></span>
          </div>
          <div class="form-group">
            <label>District</label>
            <input type="text" name="district" class="form-control  <?php echo (!empty($district_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $district; ?>" placeholder="District">
            <span class="invalid-feedback"><?php echo $district_err; ?></span>
          </div>
          <input type="submit" class="btn btn-primary mr-2" value="Submit">
          <a href="police_station.php" class="btn btn-dark">Cancel</a>
        </form>
      </div>
    </div>
    <?php include 'footer.php'; ?>
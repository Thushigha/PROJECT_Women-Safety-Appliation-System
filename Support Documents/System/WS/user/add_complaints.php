<?php
session_start();
include 'header.php';
require_once "dbcon.php";

if (empty($_SESSION['user_id'])) {
  header('Location: sign-in.php');
}

// Define variables and initialize with empty values
$name = $mobile = $harresment = $status = "";
$name_err = $mobile_err = $harresment_err = $status_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Validate name
  $input_name = trim($_POST["name"]);
  if (empty($input_name)) {
    $name_err = "Please enter the name.";
  } else {
    $name = $input_name;
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

  // Validate harresment
  $input_harresment = trim($_POST["harresment"]);
  if (empty($input_harresment)) {
    $harresment_err = "Please enter the harresment.";
  } else {
    $harresment = $input_harresment;
  }

  // Validate status
  $input_status = trim($_POST["status"]);
  if (empty($input_status)) {
    $status_err = "Please enter the status.";
  } else {
    $status = $input_status;
  }

  // Validate date
  $input_date = trim($_POST["date"]);
  if (empty($input_date)) {
    $date_err = "Please enter the date.";
  } else {
    $date = $input_date;
  }

  // Check input errors before inserting in database
  if (empty($name_err) && empty($mobile_err) && empty($harresment_err) && empty($status_err)) {
    // Prepare an insert statement
    $sql = "INSERT INTO complaints (user_id, name, mobile, harresment, status, date) VALUES (:user_id, :name, :mobile, :harresment, :status, :date)";

    if ($stmt = $pdo->prepare($sql)) {
      // Bind variables to the prepared statement as parameters
      $stmt->bindParam(":user_id", $param_user_id);
      $stmt->bindParam(":name", $param_name);
      $stmt->bindParam(":mobile", $param_mobile);
      $stmt->bindParam(":harresment", $param_harresment);
      $stmt->bindParam(":status", $param_status);
      $stmt->bindParam(":date", $param_date);

      // Set parameters
      $param_user_id = $_SESSION['user_id'];
      $param_name = $name;
      $param_mobile = $mobile;
      $param_harresment = $harresment;
      $param_status = $status;
      $param_date = $date;

      // Attempt to execute the prepared statement
      if ($stmt->execute()) {
        // Records created successfully. Redirect to landing page
        header("location: complaints.php");
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
          <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Complaints</li>
        </ol>
        <h6 class="font-weight-bolder mb-0">Complaints</h6>
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
        <h4 class="card-title">CREATE COMPLAINTS</h4>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Name</label>
                <div class="col-sm-9">
                  <input type="text" name="name" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>" placeholder="Name">
                  <span class="invalid-feedback"><?php echo $name_err; ?></span>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Mobile Number</label>
                <div class="col-sm-9">
                  <input type="number" name="mobile" class="form-control  <?php echo (!empty($mobile_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $mobile; ?>" placeholder="Mobile">
                  <span class="invalid-feedback"><?php echo $mobile_err; ?></span>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label>Type of Harresment</label>
                <div>
                  <div class="col-sm-4">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="harresment" id="" value="Physical Hazard" checked> Physical Hazard </label>
                    </div>
                  </div>
                  <div class="col-sm-5">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="harresment" id="" value="Verbal Harressment"> Verbal Harressment </label>
                    </div>
                  </div>
                  <div class="col-sm-5">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="harresment" id="" value="Ragging"> Ragging </label>
                    </div>
                  </div>
                </div>
                <span class="invalid-feedback"><?php echo $harresment_err; ?></span>
              </div>

            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="">Complaint Status</label>
                <div>
                  <div class="col-sm-4">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="status" id="" value="Not Started" checked> Not Started</label>
                    </div>
                  </div>
                  <div class="col-sm-5">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="status" id="" value="In Progress"> In Progress </label>
                    </div>
                  </div>
                  <div class="col-sm-5">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="status" id="" value="Completed"> Completed </label>
                    </div>
                  </div>
                </div>
                <span class="invalid-feedback"><?php echo $status_err; ?></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label> Date </label>
                <input type="date" name="date" class="form-control">
                <span class="invalid-feedback"><?php echo $date_err; ?></span>

              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">

              </div>
            </div>
          </div>
          <input type="submit" class="btn btn-primary mr-2" value="Submit">
          <a href="complaints.php" class="btn btn-dark">Cancel</a>
        </form>
      </div>
    </div>
    <?php include 'footer.php'; ?>
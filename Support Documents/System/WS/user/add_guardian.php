<?php
session_start();
include 'header.php';
require_once "dbcon.php";


if (empty($_SESSION['user_id'])) {
  header('Location: sign-in.php');
}

// Define variables and initialize with empty values
$username = $name = $mobile = $email = $relationship = "";
$username_err = $name_err = $mobile_err = $email_err = $relationship_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Validate username
  $input_username = trim($_POST["username"]);
  if (empty($input_username)) {
    $username_err = "Please enter the username.";
  } else {
    $username = $input_username;
  }

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

  // Validate email
  $input_email = trim($_POST["email"]);
  if (empty($input_email)) {
    $email_err = "Please enter the email.";
  } else {
    $email = $input_email;
  }

  // Validate relationship
  $input_relationship = trim($_POST["relationship"]);
  if (empty($input_relationship)) {
    $relationship_err = "Please enter the relationship.";
  } else {
    $relationship = $input_relationship;
  }

  
  // Check input errors before inserting in database
  if (empty($username_err) && empty($name_err) && empty($mobile_err) && empty($email_err) && empty($relationship_err)) {
    // Prepare an insert statement
    $sql = "INSERT INTO guardians (user_id, username, name, mobile, email, relationship) VALUES (:user_id, :username, :name, :mobile, :email, :relationship)";

    if ($stmt = $pdo->prepare($sql)) {
      // Bind variables to the prepared statement as parameters
      $stmt->bindParam(":user_id", $param_user_id);
      $stmt->bindParam(":username", $param_username);
      $stmt->bindParam(":name", $param_name);
      $stmt->bindParam(":mobile", $param_mobile);
      $stmt->bindParam(":email", $param_email);
      $stmt->bindParam(":relationship", $param_relationship);

      // Set parameters
      $param_user_id = $_SESSION['user_id'];
      $param_username = $username;
      $param_name = $name;
      $param_mobile = $mobile;
      $param_email = $email;
      $param_relationship = $relationship;

      // Attempt to execute the prepared statement
      if ($stmt->execute()) {
        // Records created successfully. Redirect to landing page
        header("location: guardian.php");
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
          <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Page</a></li>
          <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Guardians</li>
        </ol>
        <h6 class="font-weight-bolder mb-0">Guardians</h6>
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
        <h4 class="card-title">CREATE NEW GUARDIAN</h4>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
          <div class="form-group">
            <label>User Name</label>
            <input type="text" name="username" class="form-control  <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>" placeholder="User Name">
            <span class="invalid-feedback"><?php echo $username_err; ?></span>
          </div>
          <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control  <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>" placeholder="Name">
            <span class="invalid-feedback"><?php echo $name_err; ?></span>
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="text" name="email" class="form-control  <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>" placeholder="Email">
            <span class="invalid-feedback"><?php echo $email_err; ?></span>
          </div>
          <div class="form-group">
            <label>Mobile</label>
            <input type="text" name="mobile" class="form-control  <?php echo (!empty($mobile_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $mobile; ?>" placeholder="Mobile">
            <span class="invalid-feedback"><?php echo $mobile_err; ?></span>
          </div>
          <div class="form-group">
            <label>Relationship</label>
            <input type="text" name="relationship" class="form-control  <?php echo (!empty($relationship_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $relationship; ?>" placeholder="Relationship">
            <span class="invalid-feedback"><?php echo $relationship_err; ?></span>
          </div>
          <input type="submit" class="btn btn-primary mr-2" value="Submit">
          <a href="guardian.php" class="btn btn-dark">Cancel</a>
        </form>
      </div>
    </div>
    <?php include 'footer.php'; ?>
<?php
session_start();
include 'header.php';
require_once "dbcon.php";

if (empty($_SESSION['user_id'])) {
    header('Location: sign-in.php');
}

// Define variables and initialize with empty values
$district = $police_station = $mobile = "";
$district_err = $police_station_err = $mobile_err = "";

// Processing form data when form is submitted
if (isset($_POST["id"]) && !empty($_POST["id"])) {
    // Get hidden input value
    $id = $_POST["id"];

    // Validate district
    $input_district = trim($_POST["district"]);
    if (empty($input_district)) {
        $district_err = "Please enter a district.";
    } elseif (!filter_var($input_district, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $district_err = "Please enter a valid district.";
    } else {
        $district = $input_district;
    }

    // Validate police_station police_station
    $input_police_station = trim($_POST["police_station"]);
    if (empty($input_police_station)) {
        $police_station_err = "Please enter an police_station.";
    } else {
        $police_station = $input_police_station;
    }

    // Check input errors before inserting in database
    if (empty($district_err) && empty($police_station_err)) {
        // Prepare an update statement
        $sql = "UPDATE police_stations SET district=:district, police_station=:police_station WHERE id=:id";

        if ($stmt = $pdo->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":district", $param_district);
            $stmt->bindParam(":police_station", $param_police_station);
            $stmt->bindParam(":id", $param_id);

            // Set parameters
            $param_district = $district;
            $param_police_station = $police_station;
            $param_id = $id;

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Records updated successfully. Redirect to landing page
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
} else {
    // Check existence of id parameter before processing further
    if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
        // Get URL parameter
        $id =  trim($_GET["id"]);

        // Prepare a select statement
        $sql = "SELECT * FROM police_stations WHERE id = :id";
        if ($stmt = $pdo->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":id", $param_id);

            // Set parameters
            $param_id = $id;

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                if ($stmt->rowCount() == 1) {
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);

                    // Retrieve individual field value
                    $district = $row["district"];
                    $police_station = $row["police_station"];
                } else {
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        unset($stmt);

        // Close connection
        unset($pdo);
    } else {
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
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
                <h6 class="font-weight-bolder mb-0">Police Users</h6>
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
                    <?php if (isset($_SESSION['user_id'])) : ?>
                        <li class="nav-item d-flex align-items-center">
                            <a href="logout.php" class="nav-link text-body font-weight-bold px-0">
                                <i class="fa fa-user me-sm-1"></i>
                                <span class="d-sm-inline d-none">Logout</span>
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if (!isset($_SESSION['user_id'])) : ?>
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
                <h4 class="card-title">UPDATE NEW POLICE STATION</h4>
                <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                    <div class="form-group">
                        <label>Police Station</label>
                        <input type="text" name="police_station" class="form-control <?php echo (!empty($police_station_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $police_station; ?>">
                        <span class="invalid-feedback"><?php echo $police_station_err; ?></span>
                    </div>
                    <div class="form-group">
                        <label>District</label>
                        <input type="text" name="district" class="form-control <?php echo (!empty($district_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $district; ?>">
                        <span class="invalid-feedback"><?php echo $district_err; ?></span>
                    </div>
                    <input type="hidden" name="id" value="<?php echo $id; ?>" />
                    <input type="submit" class="btn btn-primary" value="Submit">
                    <a href="police_station.php" class="btn btn-dark">Cancel</a>
                </form>
            </div>
        </div>
    </div>
    <?php include 'footer.php'; ?>
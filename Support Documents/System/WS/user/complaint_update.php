<?php
session_start();
include 'header.php';
require_once "dbcon.php";


if (empty($_SESSION['user_id'])) {
    header('Location: sign-in.php');
}


// Define variables and initialize with empty values
$name = $mobile = $harresment = $status = $date = "";
$name_err = $mobile_err = $harresment_err = $status_err = $date_err = "";

// Processing form data when form is submitted
if (isset($_POST["id"]) && !empty($_POST["id"])) {
    // Get hidden input value
    $id = $_POST["id"];

    // Validate name
    $input_name = trim($_POST["name"]);
    if (empty($input_name)) {
        $name_err = "Please enter a name.";
    } elseif (!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $name_err = "Please enter a valid name.";
    } else {
        $name = $input_name;
    }

    // Validate mobile
    $input_mobile = trim($_POST["mobile"]);
    if (empty($input_mobile)) {
        $mobile_err = "Please enter an mobile.";
    } else {
        $mobile = $input_mobile;
    }

    // Validate harresment
    $input_harresment = trim($_POST["harresment"]);
    if (empty($input_harresment)) {
        $harresment_err = "Please enter an harresment.";
    } else {
        $harresment = $input_harresment;
    }

    // Validate status
    $input_status = trim($_POST["status"]);
    if (empty($input_status)) {
        $status_err = "Please enter an status.";
    } else {
        $status = $input_status;
    }

    // Validate date
    $input_date = trim($_POST["date"]);
    if (empty($input_date)) {
        $date_err = "Please enter an date.";
    } else {
        $date = $input_date;
    }

    // Check input errors before inserting in database
    if (empty($name_err) && empty($mobile_err) && empty($harresment_err) && empty($status_err) && empty($date_err)) {
        // Prepare an update statement
        $sql = "UPDATE complaints SET name=:name, mobile=:mobile, harresment=:harresment, status=:status, date=:date WHERE id=:id";

        if ($stmt = $pdo->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":name", $param_name);
            $stmt->bindParam(":mobile", $param_mobile);
            $stmt->bindParam(":harresment", $param_harresment);
            $stmt->bindParam(":status", $param_status);
            $stmt->bindParam(":date", $param_date);
            $stmt->bindParam(":id", $param_id);

            // Set parameters
            $param_name = $name;
            $param_mobile = $mobile;
            $param_harresment = $harresment;
            $param_status = $status;
            $param_date = $date;
            $param_id = $id;

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Records updated successfully. Redirect to landing page
                header("location: complaints.php");
                exit();
            } else {
                echo "Something went wrong. Please try again later.";
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
        $sql = "SELECT * FROM complaints WHERE id = :id";
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
                    $name = $row["name"];
                    $mobile = $row["mobile"];
                    $harresment = $row["harresment"];
                    $status = $row["status"];
                    $date = $row["date"];
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
                <h4 class="card-title">UPDATE COMPLAINT</h4>
                <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="name" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                                    <span class="invalid-feedback"><?php echo $name_err; ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Mobile Number</label>
                                <div class="col-sm-9">
                                    <input type="mobile" name="mobile" class="form-control <?php echo (!empty($mobile_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $mobile; ?>">
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
                                <input type="date" name="date" class="form-control" required>
                                <span class="invalid-feedback"><?php echo $date_err; ?></span>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">

                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="id" value="<?php echo $id; ?>" />
                    <input type="submit" class="btn btn-primary" value="Submit">
                    <a href="complaints.php" class="btn btn-dark">Cancel</a>
                </form>
            </div>
        </div>
    </div>
    <?php include 'footer.php'; ?>
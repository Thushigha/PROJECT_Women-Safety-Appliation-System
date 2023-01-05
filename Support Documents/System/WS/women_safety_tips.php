<?php
session_start();
include 'header.php';

if (empty($_SESSION['user_id'])) {
  header('Location: sign-in.php');
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

  <div class="container-fluid py-4">
    <div class="col-6 text-end">
      <a class="btn bg-gradient-dark mb-0" href="add_tips.php"><i class="material-icons text-sm">add</i>Add New Tips</a>
    </div>

    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <div class="card mt-4">
          <div class="card-header p-3">
            <h5 class="mb-0">Tips</h5>
          </div>
          <div class="card-body p-3 pb-0">
            <?php
            // Include config file
            require_once "dbcon.php";

            // Attempt select query execution
            $sql = "SELECT * FROM safety_tips";
            if ($result = $pdo->query($sql)) {
              if ($result->rowCount() > 0) {
                while ($row = $result->fetch()) {
                  echo '<div class="alert alert-primary alert-dismissible text-white" role="alert">';
                  echo '<span class="text-sm"> <a href="javascript:;" class="alert-link text-white">'  . $row['tip'] . '</span>';
                  echo ' <div class="ms-auto text-end">';
                  echo '<a class="btn btn-link text-dark px-3 mb-0" href="tip_update.php?id=' . $row['id'] . '"><i class="material-icons text-sm me-2">edit</i>Edit</a>';
                  echo '<a class="btn btn-link text-dark px-3 mb-0" href="tip_delete.php?id=' . $row['id'] . '"><i class="material-icons text-sm me-2">delete</i>Delete</a>';
                  echo '</div>';
                  echo '</div>';
                }
                // Free result set
                unset($result);
              } else {
                echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
              }
            } else {
              echo "Oops! Something went wrong. Please try again later.";
            }

            // Close connection
            unset($pdo);
            ?>
          </div>
        </div>

      </div>
    </div>
    <div class="position-fixed bottom-1 end-1 z-index-2">
      <div class="toast fade hide p-2 bg-white" role="alert" aria-live="assertive" id="successToast" aria-atomic="true">
        <div class="toast-header border-0">
          <i class="material-icons text-success me-2">
            check
          </i>
          <span class="me-auto font-weight-bold">Woman Security Dashboard </span>
          <small class="text-body">11 mins ago</small>
          <i class="fas fa-times text-md ms-3 cursor-pointer" data-bs-dismiss="toast" aria-label="Close"></i>
        </div>
        <hr class="horizontal dark m-0">
        <div class="toast-body">
          Hello, Woman , Upated the tips - prtoect from HAZARD
        </div>
      </div>
      <div class="toast fade hide p-2 mt-2 bg-gradient-info" role="alert" aria-live="assertive" id="infoToast" aria-atomic="true">
        <div class="toast-header bg-transparent border-0">
          <i class="material-icons text-white me-2">
            notifications
          </i>
          <span class="me-auto text-white font-weight-bold">Woman Security Dashboard </span>
          <small class="text-white">11 mins ago</small>
          <i class="fas fa-times text-md text-white ms-3 cursor-pointer" data-bs-dismiss="toast" aria-label="Close"></i>
        </div>
        <hr class="horizontal light m-0">
        <div class="toast-body text-white">
          Hello, woman be deont be patient
        </div>
      </div>
      <div class="toast fade hide p-2 mt-2 bg-white" role="alert" aria-live="assertive" id="warningToast" aria-atomic="true">
        <div class="toast-header border-0">
          <i class="material-icons text-warning me-2">
            travel_explore
          </i>
          <span class="me-auto font-weight-bold">Woman Security Dashboard </span>
          <small class="text-body">11 mins ago</small>
          <i class="fas fa-times text-md ms-3 cursor-pointer" data-bs-dismiss="toast" aria-label="Close"></i>
        </div>
        <hr class="horizontal dark m-0">
        <div class="toast-body">
          Hello, escape from threat
        </div>
      </div>
      <div class="toast fade hide p-2 mt-2 bg-white" role="alert" aria-live="assertive" id="dangerToast" aria-atomic="true">
        <div class="toast-header border-0">
          <i class="material-icons text-danger me-2">
            campaign
          </i>
          <span class="me-auto text-gradient text-danger font-weight-bold">Woman Security Dashboard </span>
          <small class="text-body">11 mins ago</small>
          <i class="fas fa-times text-md ms-3 cursor-pointer" data-bs-dismiss="toast" aria-label="Close"></i>
        </div>
        <hr class="horizontal dark m-0">
        <div class="toast-body">
          Hello, warning tips added from threat
        </div>
      </div>
    </div>

  </div>
</main>
<?php include 'footer.php'; ?>
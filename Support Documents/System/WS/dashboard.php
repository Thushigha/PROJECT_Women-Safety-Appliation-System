<?php
session_start();
include 'header.php';

if (empty($_SESSION['user_id'])) {
  header('Location: sign-in.php');
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
          <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Dashboard</li>
        </ol>
        <h6 class="font-weight-bolder mb-0">Dashboard</h6>
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
    <div class="row">
    <?php if (!empty($_SESSION['role']) && $_SESSION['role'] == "user" || $_SESSION['role'] == "police") { ?>
      <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
          <div class="card-header p-3 pt-2">
            <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
              <i class="material-icons opacity-10">weekend</i>
            </div>
            <div class="text-end pt-1">
              <p class="text-sm mb-0 text-capitalize">Complaints</p>
              <?php
              require_once "dbcon.php";
              $sql = "SELECT * FROM complaints";
              $result = $pdo->query($sql);
              $result->rowCount();
              ?>
              <h4 class="mb-0"><?php echo $result->rowCount(); ?></h4>
            </div>
          </div>
          <hr class="dark horizontal my-0">
          <div class="card-footer p-3">

          </div>
        </div>
      </div>
      <?php } ?>
      <?php if (!empty($_SESSION['role']) && $_SESSION['role'] == "admin") { ?>
      <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
          <div class="card-header p-3 pt-2">
            <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
              <i class="material-icons opacity-10">person</i>
            </div>
            <div class="text-end pt-1">
              <p class="text-sm mb-0 text-capitalize">Users</p>
              <?php
              require_once "dbcon.php";
              $sql = "SELECT * FROM users";
              $result = $pdo->query($sql);
              $result->rowCount();
              ?>
              <h4 class="mb-0"><?php echo $result->rowCount(); ?></h4>
            </div>
          </div>
          <hr class="dark horizontal my-0">
          <div class="card-footer p-3">

          </div>
        </div>
      </div>
      <?php } ?>
      <?php if (!empty($_SESSION['role']) && $_SESSION['role'] == "admin" || $_SESSION['role'] == "police") { ?>
      <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
          <div class="card-header p-3 pt-2">
            <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
              <i class="material-icons opacity-10">person</i>
            </div>
            <div class="text-end pt-1">
              <p class="text-sm mb-0 text-capitalize">Police Users</p>
              <?php
              require_once "dbcon.php";
              $sql = "SELECT * FROM police_users";
              $result = $pdo->query($sql);
              $result->rowCount();
              ?>
              <h4 class="mb-0"><?php echo $result->rowCount(); ?></h4>
            </div>
          </div>
          <hr class="dark horizontal my-0">
          <div class="card-footer p-3">

          </div>
        </div>
      </div>
      <?php } ?>
      <?php if (!empty($_SESSION['role']) && $_SESSION['role'] == "admin" || $_SESSION['role'] == "police") { ?>
      <div class="col-xl-3 col-sm-6">
        <div class="card">
          <div class="card-header p-3 pt-2">
            <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
              <i class="material-icons opacity-10">weekend</i>
            </div>
            <div class="text-end pt-1">
              <p class="text-sm mb-0 text-capitalize">Police Stations</p>
              <?php
              require_once "dbcon.php";
              $sql = "SELECT * FROM police_stations";
              $result = $pdo->query($sql);
              $result->rowCount();
              ?>
              <h4 class="mb-0"><?php echo $result->rowCount(); ?></h4>
            </div>
          </div>
          <hr class="dark horizontal my-0">
          <div class="card-footer p-3">

          </div>
        </div>
      </div>
    </div>
    <?php } ?>
    <div class="row mt-4">
      <div class="col-lg-4 col-md-6 mt-4 mb-4">
        <div class="card z-index-2 ">
          <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
            <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
              <div class="chart">
                <canvas id="chart-bars" class="chart-canvas" height="170"></canvas>
              </div>
            </div>
          </div>
          <div class="card-body">
            <h6 class="mb-0 ">Completed Complaints Per Month</h6>

            <hr class="dark horizontal">
            <div class="d-flex ">
              <i class="material-icons text-sm my-auto me-1">schedule</i>
              <p class="mb-0 text-sm"> just updated </p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 mt-4 mb-4">
        <div class="card z-index-2  ">
          <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
            <div class="bg-gradient-success shadow-success border-radius-lg py-3 pe-1">
              <div class="chart">
                <canvas id="chart-line" class="chart-canvas" height="170"></canvas>
              </div>
            </div>
          </div>
          <div class="card-body">
            <h6 class="mb-0 "> Complaints Range Per Month </h6>

            <hr class="dark horizontal">
            <div class="d-flex ">
              <i class="material-icons text-sm my-auto me-1">schedule</i>
              <p class="mb-0 text-sm"> just updated </p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 mt-4 mb-3">
        <div class="card z-index-2 ">
          <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
            <div class="bg-gradient-dark shadow-dark border-radius-lg py-3 pe-1">
              <div class="chart">
                <canvas id="chart-line-tasks" class="chart-canvas" height="170"></canvas>
              </div>
            </div>
          </div>
          <div class="card-body">
            <h6 class="mb-0 ">Users per Days</h6>

            <hr class="dark horizontal">
            <div class="d-flex ">
              <i class="material-icons text-sm my-auto me-1">schedule</i>
              <p class="mb-0 text-sm">just updated</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  </div>

  </div>
</main>
<?php include 'footer.php'; ?>
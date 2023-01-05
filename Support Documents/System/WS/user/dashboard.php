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
    <div class="col-12">
      <div class="card my-4">
        <div class="col-12 text-center">
          <a class="btn bg-gradient-dark mb-3 mt-4" href="add_guardian.php"><i class="material-icons text-sm">group_add</i>&nbsp;&nbsp;Add Guardian Number</a>
        </div>
        <div class="col-12 text-center">
          <a class="btn bg-gradient-dark mb-3" href="guardian.php"><i class="material-icons text-sm">group</i>&nbsp;&nbsp;View Registered</a>
        </div>
        <div class="col-12 text-center">
          <a class="btn bg-gradient-dark mb-3" href="add_complaints.php"><i class="material-icons text-sm">add</i>&nbsp;&nbsp;Add Complaint</a>
        </div>
        <div class="col-12 text-center mb-3">
          <form id="sos" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <input type="hidden" name="lat" id="lat" value="">
            <input type="hidden" name="long" id="lng" value="">
            <input type="hidden" name="ip" id="ip" value="">
            <input type="hidden" name="message" id="message" value="">
            <input type="hidden" name="map" id="map" value="">
            <input type="hidden" name="datetime" id="datetime" value="">
            <a href="#" onclick="document.getElementById('sos').submit()"><img src="assets/img/sos.png" width="250" alt="" srcset=""></a>
          </form>
        </div>
        <div class="col-12 text-center">
          <a class="btn bg-gradient-dark mb-3" target="_blank" href="https://api.whatsapp.com/send?phone=119"><i class="material-icons text-sm">perm_phone_msg</i>&nbsp;&nbsp;WhatsApp Alert</a>
        </div>
        <div class="row">
          <div class="col-6 text-end">
            <a class="btn bg-gradient-dark mb-3" href="police_helpline.php"><i class="material-icons text-sm">person</i>&nbsp;&nbsp;Call Police Helpline</a>
          </div>
          <div class="col-6 text-start">
            <a class="btn bg-gradient-dark mb-3" href="police_station.php"><i class="material-icons text-sm">local_police</i>&nbsp;&nbsp;Nearby Police Station</a>
          </div>
        </div>
        <div class="row">
          <div class="col-6 text-end">
            <a class="btn bg-gradient-dark mb-3 w-25" href="women_safety_tips.php"><i class="material-icons text-sm">tips_and_updates</i>&nbsp;&nbsp;Safety Tips</a>
          </div>
          <div class="col-6 text-start">
            <a class="btn bg-gradient-dark mb-3" href="complaints.php"><i class="material-icons text-sm">pending_actions</i>&nbsp;&nbsp;My Complaint History</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<script>
  function getLocation() {
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(showPosition);
    } else {
      alert("Geolocation is not supported by this browser.");
    }
  }

  function showPosition(position) {
    document.getElementById("lat").value = position.coords.latitude;
    document.getElementById("lng").value = position.coords.longitude;
  }

  getLocation();

  function sendLocation() {
    var lat = document.getElementById("lat").value;
    var lng = document.getElementById("lng").value;
    var xhttp = new XMLHttpRequest();
    xhttp.open("POST", "dashboard.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("lat=" + lat + "&lng=" + lng);
  }

  let lat = document.getElementById("lat").value;
  let lng = document.getElementById("lng").value;

  // get user location ip
  fetch('https://api.ipify.org?format=json')
    .then(response => response.json())
    .then(data => {
      document.getElementById("ip").value = data.ip;
    })
    .catch((error) => {
      console.error('Error:', error);
    });

  // set user location ip 
  let ip = document.getElementById("ip").value;

  // set date time
  var today = new Date();
</script>
<?php include 'footer.php'; ?>

<?php

require_once "dbcon.php";

// insert data database when user click on sos button
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $user_name = $_SESSION['user_name'];
  $lat = $_POST['lat'];
  $long = $_POST['long'];
  $ip = $_POST['ip'];
  $message = "I am in danger. Please help me.";
  $map = "https://www.google.com/maps/search/?api=1&query=" . $lat . "," . $long . "&query_place_id=". $ip;
  $datetime = $_POST['datetime'];

  $sql = "INSERT INTO `threats`(`user_name`,`lat`, `lng`, `ip`, `message`, `map`, `datetime`) VALUES ('$user_name', '$lat', '$long', '$ip', '$message', '$map', '$datetime')";
  $result = $pdo->prepare($sql);
  if ($result->execute()) {
    echo "<script>alert('Your location has been sent to your guardian and police.')</script>";
  } else {
    echo "<script>alert('Something went wrong.')</script>";
    header("Location: dashboard.php");
  }
}
?>
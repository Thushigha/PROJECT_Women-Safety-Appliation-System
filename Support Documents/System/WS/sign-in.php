<?php
include 'header.php';
require_once 'dbcon.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
  $stmt->execute([$_POST['email']]);
  $user = $stmt->fetch();

  if ($user && $user['password'] == $_POST['password']) {
    $_SESSION['user_name'] = $user['username'];
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['role'] = $user['role'];
    if ($user['role'] == 'user') {
      $_SESSION['user_id'] = $user['id'];
      $_SESSION['role'] = $user['role'];
      header("Location:user/dashboard.php");
    } else {
      header("Location:dashboard.php");
    }
  } else {
    echo "invalid";
  }
}
?>
<main class="main-content  mt-0">
  <div class="page-header align-items-start min-vh-100" style="background-image: url('assets/img/Card.png')">
    <span class="mask bg-gradient-dark opacity-6"></span>
    <div class="container my-auto">
      <div class="row">
        <div class="col-lg-4 col-md-8 col-12 mx-auto">
          <div class="card z-index-0 fadeIn3 fadeInBottom">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Sign in</h4>
                <div class="row mt-3">
                  <div class="col-2 text-center ms-auto">
                    <a class="btn btn-link px-3" href="javascript:;">
                      <i class="fa fa-facebook text-white text-lg"></i>
                    </a>
                  </div>
                  <div class="col-2 text-center px-1">
                    <a class="btn btn-link px-3" href="javascript:;">
                      <i class="fa fa-github text-white text-lg"></i>
                    </a>
                  </div>
                  <div class="col-2 text-center me-auto">
                    <a class="btn btn-link px-3" href="javascript:;">
                      <i class="fa fa-google text-white text-lg"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-body">
              <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="input-group input-group-outline my-3">
                  <label class="form-label"></label>
                  <input name="email" class="form-control" placeholder="Email" type="email">
                </div>
                <div class="input-group input-group-outline mb-3">
                  <label class="form-label"></label>
                  <input name="password" class="form-control" placeholder="Type password" type="password">
                </div>
                <div class="input-group input-group-outline mb-3">
                      <label class="form-label" placeholder="Login Type"></label>
                      <select name="role" class="form-control" required>
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                        <option value="police">Police</option>
                      </select>
                    </div>
                <div class="form-check form-switch d-flex align-items-center mb-3">
                  <input class="form-check-input" type="checkbox" id="rememberMe" checked>
                  <label class="form-check-label mb-0 ms-3" for="rememberMe">Remember me</label>
                </div>
                <div class="text-center">
                  <input type="submit" class="btn btn-primary mr-2" value="Submit">
                </div>
                <p class="mt-4 text-sm text-center">
                  Don't have an account?
                  <a href="sign-up.php" class="text-primary text-gradient font-weight-bold">Sign up</a>
                </p>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</main>

<?php include 'footer.php'; ?>
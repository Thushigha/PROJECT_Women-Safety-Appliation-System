<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="#">
            <img src="assets/img/wm.png.png" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold text-white">Women Security </span>
        </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <?php if (!empty($_SESSION['role']) && $_SESSION['role'] == "admin" || $_SESSION['role'] == "police") { ?>
                <li class="nav-item">
                    <a class="nav-link text-white  <?php if (basename($_SERVER['PHP_SELF']) == 'dashboard.php') { ?>  active bg-gradient-primary   <?php   }  ?>" href="dashboard.php">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">dashboard</i>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>
            <?php } ?>
            <?php if (!empty($_SESSION['role']) && $_SESSION['role'] == "admin" || $_SESSION['role'] == "police") { ?>
            <li class="nav-item">
                <a class="nav-link text-white <?php if (basename($_SERVER['PHP_SELF']) == 'police_station.php' || basename($_SERVER['PHP_SELF']) == 'add_police_user.php' ||
                 basename($_SERVER['PHP_SELF']) == 'police_user_update.php' || basename($_SERVER['PHP_SELF']) == 'add_police_station.php' || basename($_SERVER['PHP_SELF']) == 'police_station_update.php')
                { ?>  active bg-gradient-primary   <?php   }  ?>" href="police_station.php">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">table_view</i>
                    </div>
                    <span class="nav-link-text ms-1">Police Station</span>
                </a>
            </li>
            <?php } ?>
            <?php if (!empty($_SESSION['role']) && $_SESSION['role'] == "admin" || $_SESSION['role'] == "police") { ?>
            <li class="nav-item">
                <a class="nav-link text-white <?php if (basename($_SERVER['PHP_SELF']) == 'complaints.php' || basename($_SERVER['PHP_SELF']) == 'add_complaints.php' || basename($_SERVER['PHP_SELF']) == 'complaint_update.php') { ?>  active bg-gradient-primary   <?php   }  ?>" href="complaints.php">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">receipt_long</i>
                    </div>
                    <span class="nav-link-text ms-1">Complaints</span>
                </a>
            </li>
            <?php } ?>
            <?php if (!empty($_SESSION['role']) && $_SESSION['role'] == "admin") { ?>
            <li class="nav-item">
                <a class="nav-link text-white <?php if (basename($_SERVER['PHP_SELF']) == 'women_safety_tips.php' || basename($_SERVER['PHP_SELF']) == 'add_tips.php' || basename($_SERVER['PHP_SELF']) == 'tip_update.php') { ?>  active bg-gradient-primary   <?php   }  ?>" href="women_safety_tips.php">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">view_in_ar</i>
                    </div>
                    <span class="nav-link-text ms-1">Women Safety Tips</span>
                </a>
            </li>
            <?php } ?>
            <?php if (!empty($_SESSION['role']) && $_SESSION['role'] == "admin") { ?>
            <li class="nav-item">
                <a class="nav-link text-white <?php if (basename($_SERVER['PHP_SELF']) == 'user.php' || basename($_SERVER['PHP_SELF']) == 'add_user.php' || basename($_SERVER['PHP_SELF']) == 'user_update.php') { ?>  active bg-gradient-primary   <?php   }  ?>" href="user.php">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">group</i>
                    </div>
                    <span class="nav-link-text ms-1">Users</span>
                </a>
            </li>
            <?php } ?>
            <?php if (!empty($_SESSION['role']) && $_SESSION['role'] == "admin") { ?>
            <li class="nav-item">
                <a class="nav-link text-white <?php if (basename($_SERVER['PHP_SELF']) == 'guardian.php' || basename($_SERVER['PHP_SELF']) == 'add_guardian.php' || basename($_SERVER['PHP_SELF']) == 'guardian_update.php') { ?>  active bg-gradient-primary   <?php   }  ?>" href="guardian.php">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">person</i>
                    </div>
                    <span class="nav-link-text ms-1">Guardian Details</span>
                </a>
            </li>
            <?php } ?>
            <?php if (!empty($_SESSION['role']) && $_SESSION['role'] == "admin" || $_SESSION['role'] == "police" || $_SESSION['role'] == "guardian") { ?>
            <li class="nav-item">
                <a class="nav-link text-white <?php if (basename($_SERVER['PHP_SELF']) == 'threat.php' || basename($_SERVER['PHP_SELF']) == 'add_threats.php' || basename($_SERVER['PHP_SELF']) == 'threat.php') { ?>  active bg-gradient-primary   <?php   }  ?>" href="threat.php">
                    <div class="text-white
                    text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">crisis_alert</i>
                    </div>
                    <span class="nav-link-text ms-1">Threats</span>
                </a>
            </li>
            <?php } ?>
        </ul>
    </div>
</aside>
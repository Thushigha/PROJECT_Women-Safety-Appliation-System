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
					<li class="breadcrumb-item text-sm text-dark active" aria-current="page">Users</li>
				</ol>
				<h6 class="font-weight-bolder mb-0">Users</h6>
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
	<div class="card">
		<div class="dial-pad-wrap mb-6">
			<div class="left-pan">
				<div class="contacts">
					<div class="title">Contacts</div>
					<?php
					require_once "dbcon.php";

					$sql = "SELECT * FROM guardians where user_id = " . $_SESSION['user_id'] . "";
					$result = $pdo->query($sql);

					if ($result->rowCount() > 0) {
						while ($row = $result->fetch()) {
							$name = $row['name'];
							$mobile = $row['mobile'];

							echo '<div class="people clearfix">
					<div class="photo pull-left">
						<img src="https://cdn-icons-png.flaticon.com/512/149/149071.png">
					</div>
					<div class="info pull-left">
						<div class="name">' . $name . '</div>
						<div class="phone"><span></span><span class="number">' . $mobile . '</span></div>
					</div>
				</div>';
						}
					}

					?>
				</div>
				<div class="calling">
					<div class="title fadeIn animated infinite">Calling</div>
					<div class="photo bounceInDown animated"></div>
					<div class="name rubberBand animated">Unknown</div>
					<div class="number"></div>
					<div class="action">
						<div class="lnk"><button class="btn fadeInLeftBig animated p-2"><i class="fa fa-mic"></i></button></div>
						<div class="lnk"><button class="btn fadeInLeftBig animated p-2"><i class="fa fa-vol"></i></button></div>
						<div class="lnk"><button class="btn fadeInRightBig animated p-2"><i class="fa fa-camera"></i></button></div>
						<div class="lnk"><button class="btn fadeInRightBig animated p-2"><i class="fa fa-video-camera"></i></button></div>
					</div>
					<div class="call-end bounceInUp animated">
						<button class="btn p-0"><i class="fa fa-phone"></i></button>
					</div>
				</div>
			</div>
			<div class="dial-pad">
				<?php
				if (isset($_GET['mobile'])) {
					echo '<div class="dial-screen" contenteditable="false">' . $_GET['mobile'] . '</div>';
				} else {
					echo '<div class="dial-screen" contenteditable="false"></div>';
				}
				?>
				<div class="dial-table">
					<div class="dial-table-row">
						<div class="dial-table-col">
							<div class="dial-key-wrap" data-key="1">
								<div class="dial-key">1</div>
								<div class="dial-sub-key">&nbsp;</div>
							</div>
						</div>
						<div class="dial-table-col">
							<div class="dial-key-wrap" data-key="2">
								<div class="dial-key">2</div>
								<div class="dial-sub-key">abc</div>
							</div>
						</div>
						<div class="dial-table-col">
							<div class="dial-key-wrap" data-key="3">
								<div class="dial-key">3</div>
								<div class="dial-sub-key">def</div>
							</div>
						</div>
					</div>
					<div class="dial-table-row">
						<div class="dial-table-col">
							<div class="dial-key-wrap" data-key="4">
								<div class="dial-key">4</div>
								<div class="dial-sub-key">ghi</div>
							</div>
						</div>
						<div class="dial-table-col">
							<div class="dial-key-wrap" data-key="5">
								<div class="dial-key">5</div>
								<div class="dial-sub-key">jkl</div>
							</div>
						</div>
						<div class="dial-table-col">
							<div class="dial-key-wrap" data-key="6">
								<div class="dial-key">6</div>
								<div class="dial-sub-key">mno</div>
							</div>
						</div>
					</div>
					<div class="dial-table-row">
						<div class="dial-table-col">
							<div class="dial-key-wrap" data-key="7">
								<div class="dial-key">7</div>
								<div class="dial-sub-key">pqrs</div>
							</div>
						</div>
						<div class="dial-table-col">
							<div class="dial-key-wrap" data-key="8">
								<div class="dial-key">8</div>
								<div class="dial-sub-key">tuv</div>
							</div>
						</div>
						<div class="dial-table-col">
							<div class="dial-key-wrap" data-key="9">
								<div class="dial-key">9</div>
								<div class="dial-sub-key">wxyz</div>
							</div>
						</div>
					</div>
					<div class="dial-table-row">
						<div class="dial-table-col">
							<div class="dial-key-wrap" data-key="*">
								<div class="dial-key">*</div>
								<div class="dial-sub-key">&nbsp;</div>
							</div>
						</div>
						<div class="dial-table-col">
							<div class="dial-key-wrap" data-key="0">
								<div class="dial-key">0</div>
								<div class="dial-sub-key">+</div>
							</div>
						</div>
						<div class="dial-table-col">
							<div class="dial-key-wrap" data-key="#">
								<div class="dial-key">#</div>
								<div class="dial-sub-key">&nbsp;</div>
							</div>
						</div>
					</div>
					<div class="dial-table-row no-sub-key">
						<div class="dial-table-col">
						</div>
						<div class="dial-table-col">
							<div class="dial-key-wrap" data-key="call">
								<div class="dial-key"><i class="fa fa-phone"></i></div>
								<div class="dial-sub-key">Call</div>
							</div>
						</div>
						<div class="dial-table-col">
							<div class="dial-key-wrap" data-key="back">
								<div class="dial-key"><i class="fa fa-long-arrow-left"></i></div>
								<div class="dial-sub-key">Back</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
<?php

include 'footer.php';
include 'dial_script.php';
?>
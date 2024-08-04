<?php 
	session_start(); 
	if(isset($_SESSION['username'])&& $_SESSION['role']=='Resident'){
		header('Location: ./resident/dashboard.php');
	}else if(isset($_SESSION['username'])&& $_SESSION['role']=='administrator'){

		header('Location: dashboard.php');
	}else if(isset($_SESSION['username'])&& $_SESSION['role']=='staff'){

		header('Location: dashboard.php');
	}else if(isset($_SESSION['username'])&& $_SESSION['role']=='superadmin'){

		header('Location: s_dashboard.php');
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'templates/header.php' ?>
	<title>Login -  WEABITS</title>

<body class="login">
<?php include 'templates/loading_screen.php' ?>
	<div class="wrapper wrapper-login">
        
		<div class="container container-login animated fadeIn">
            <?php if(isset($_SESSION['messages'])): ?>
                <div class="alert alert-<?= $_SESSION['success']; ?> <?= $_SESSION['success']=='danger' ? 'bg-danger text-light' : null ?>" role="alert">
                    <?= $_SESSION['messages']; ?>
                </div>
            <?php unset($_SESSION['messages']); ?>
            <?php endif ?>
			<h3 class="text-center">WEABITS Administrator</h3>
			<div class="login-form">
                <form method="POST" action="model/s_login.php">
				<div class="form-group form-floating-label">
					<input id="username" name="username" type="text" class="form-control input-border-bottom" required>
					<label for="username" class="placeholder">Username</label>
				</div>
				<div class="form-group form-floating-label">
					<input id="password" name="password" type="password" class="form-control input-border-bottom" required>
					<label for="password" class="placeholder">Password</label>
					<span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
				</div>
				<div class="form-action mb-3">
                    <button type="submit" class="btn btn-primary btn-login" style="font-weight:bolder;">Sign In</button>
				</div>
                </form>
			</div>
		</div>
	</div>

</body>
</html>
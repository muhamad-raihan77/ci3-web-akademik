<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Login - Akademik</title>
    <link href="<?= base_url('assets/vendor/fontawesome-free/css/all.min.css'); ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/sb-admin-2.min.css'); ?>" rel="stylesheet">
    
    <style>
        body { display: flex; align-items: center; justify-content: center; height: 100vh; }
        .login-container { width: 100%; max-width: 400px; padding: 20px; }
    </style>
</head>

<body>
	<div style="border: 1px solid gray; border-radius: 12px; box-shadow: 5px 5px #F2F2F2; padding: 10px; width: 100%; max-width: 400px;">
		<div class="text-center">
			<h3><i class="fas fa-user-lock"></i> Login</h3>
		</div>
		
		 
			<?php if ($this->session->flashdata('error'))
				{
					echo "<div class='alert alert-danger small'>";
						echo $this->session->flashdata('error');
					echo "</div>";
				} else {echo "";} ?>
		
		
		<form class="user" action="<?= base_url('auth/proses_login'); ?>" method="post">
			<div class="form-group">
				<input type="text" name="email" class="form-control form-control-user" placeholder="Username" required>
			</div>
			<div class="form-group">
				<input type="password" name="password" class="form-control form-control-user" placeholder="Password" required>
			</div>
			<button type="submit" class="btn btn-primary btn-user btn-block">
				Login
			</button>
		</form>
		
		<hr>
		<div class="text-center">
			<a class="small" href="<?= base_url('auth/register'); ?>">Daftar Akun Baru</a>
		</div>
	</div>
   

</body>
</html>

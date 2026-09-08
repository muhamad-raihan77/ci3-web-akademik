<html>
	<head>
		<title>Halaman Registrasi</title>
		<link rel="stylesheet" href = "<?= base_url('assets/vendor/fontawesome-free/css/all.min.css');?>">
		<link rel="stylesheet" href = "<?= base_url('assets/css/sb-admin-2.min.css');?>">
		<style>
		 body{display:flex; justify-content: center; align-items: center;}
		</style>
	</head>
	
	<body>
		<div style="border: 1px solid gray; border-radius: 25px; box-shadow: 5px 5px #F2F2F2; width: 100%; max-width: 400px; padding: 10px;">
			<div class="text-center">
				<h6>Halo, Selamat Registrasi</h6>
			</div>
			<?php if ($this->session->flashdata('error'))
				{
					echo "<div class='alert alert-danger small'>";
						echo $this->session->flashdata('error');
					echo "</div>";
				} else {echo "";} ?>
			<form action="<?= base_url('auth/proses_register')?>" class="user" method="post">
				<div class ="form-group">
					<input class="form-control form-control-user" type="text" name="nama" placeholder="Nama Pengguna">
				</div>
				
				<div class ="form-group">
					<input class="form-control form-control-user" type="text" name="email" placeholder="Email">
				</div>
				
				<div class ="form-group">
					<input class="form-control form-control-user" type="password" name="pwd1" placeholder="Ketikaan password">
				</div>
				
				<div class ="form-group">
					<input class="form-control form-control-user" type="password" name="pwd2" placeholder="Ketik ulang password">
				</div>
				<button type="submit" class="btn btn-primary btn-user btn-block">Simpan</button>
			</form>
			<div class="text-center">				
				<a href="<?= base_url('auth');?>">Siap Login?</a>
			</div>
		</div>
	</body>
</html>

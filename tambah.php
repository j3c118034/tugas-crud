<?php include('config.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>CRUD PHP</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<div class="container">
			<a class="navbar-brand" href="#">CRDU PHP</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item">
						<a class="nav-link" href="index.php">Home</a>
					</li>
					<li class="nav-item active">
						<a class="nav-link" href="tambah.php">Tambah</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>
	
	<div class="container" style="margin-top:20px">
		<h2>Tambah Mahasiswa</h2>
		
		<hr>
		<?php
		function upload(){
			$namaFile	=$_Files['gambar']['name'];
			$ukuranFile	=$_FILES['gambar']['size'];
			$tmpName	=$_FILES['gambar']['tmp_name'];
			$extensiGambar		=['jpg','jpeg','png'];
			$extensiGambarValid = explode(",",$namaFile);
			$extensiGambar		=strtolower(end($extensiGambar));
			if (in_array($extensiGambar,$extensiGambarValid)){
				echo "yang anda upload bukan gambar";
			}
		}
		if(isset($_POST['submit'])){
			$nim			= $_POST['nim'];
			$nama			= $_POST['nama'];
			$jenis_kelamin	= $_POST['jenis_kelamin'];
			$olahraga_fav	= implode(",",$_POST['olahraga_fav']);
			$agama			= $_POST['agama'];
			$gambar			= $_FILES['gambar']['name'];

			
			$cek = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE nim='$nim'") or die(mysqli_error($koneksi));
			
			if(mysqli_num_rows($cek) == 0){
				$sql = mysqli_query($koneksi, "INSERT INTO mahasiswa(nim, nama, jenis_kelamin, agama, olahraga_fav,gambar) VALUES('$nim', '$nama', '$jenis_kelamin', '$agama', '$olahraga_fav','$gambar')") or die(mysqli_error($koneksi));
				
				if($sql){
					echo '<script>alert("Berhasil menambahkan data."); document.location="tambah.php";</script>';
				}else{
					echo '<div class="alert alert-warning">Gagal melakukan proses tambah data.</div>';
				}
			}else{
				echo '<div class="alert alert-warning">Gagal, NIM sudah terdaftar.</div>';
			}
		}
		?>
		
		<form action="tambah.php" method="post" enctype="multipart/form-data">
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">NIM</label>
				<div class="col-sm-10">
					<input type="text" name="nim" class="form-control" size="4" required>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">NAMA MAHASISWA</label>
				<div class="col-sm-10">
					<input type="text" name="nama" class="form-control" required>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">JENIS KELAMIN</label>
				<div class="col-sm-10">
					<div class="form-check">
						<input type="radio" class="form-check-input" name="jenis_kelamin" value="LAKI-LAKI" required>
						<label class="form-check-label">LAKI-LAKI</label>
					</div>
					<div class="form-check">
						<input type="radio" class="form-check-input" name="jenis_kelamin" value="PEREMPUAN" required>
						<label class="form-check-label">PEREMPUAN</label>
					</div>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">AGAMA</label>
				<div class="col-sm-10">
					<select name="agama" class="form-control" required>
						<option value="">...</option>
						<option value="ISLAM">ISLAM</option>
						<option value="PROTESTAN">PROTESTAN</option>
						<option value="KATOLIK">KATOLIK</option>
						<option value="HINDU">HINDU</option>
						<option value="BUDHA">BUDHA</option>
						<option value="KONGHUCHU">KONGHUCHU</option>
					</select>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">OLAHRAGA</label>
				<?php $olahraga=implode(",", $_POST['olahraga_fav']); ?>
				<div class="col-sm-10">
				<div class="form-check">
				<input class="form-check-input" type="checkbox" value="SEPAK BOLA" id="defaultCheck1" name="olahraga_fav[]" <?php if(in_array("SEPAK BOLA", $olahraga_fav)) {echo "checked";} ?> >
					<label class="form-check-label" for="defaultCheck1" >
					SEPAK BOLA
					</label>
					</div>
					<div class="form-check">
					<input class="form-check-input" type="checkbox" value="BASKET" id="defaultCheck2" name="olahraga_fav[]" <?php if(in_array("BASKET", $olahraga_fav)) {echo "checked";} ?> >
					<label class="form-check-label" for="defaultCheck2">
					BASKET
					</label>
					</div>
					<div class="form-check">
					<input class="form-check-input" type="checkbox" value="FUTSAL" id="defaultCheck3" name="olahraga_fav[]" <?php if(in_array("FUTSAL", $olahraga_fav)) {echo "checked";} ?> >
					<label class="form-check-label" for="defaultCheck3">
					FUTSAL
					</label>
					</div>
					<div class="form-check">
					<input class="form-check-input" type="checkbox" value="RENANG" id="defaultCheck4" name="olahraga_fav[]" <?php if(in_array("RENANG", $olahraga_fav)) {echo "checked";} ?> >
					<label class="form-check-label" for="defaultCheck4">
					RENANG
					</label>
					</div>
					<div class="form-check">
					<input class="form-check-input" type="checkbox" value="BADMINTON" id="defaultCheck5" name="olahraga_fav[]" <?php if(in_array("BADMINTON", $olahraga_fav)) {echo "checked";} ?> >
					<label class="form-check-label" for="defaultCheck5">
					BADMINTON
					</label>
					</div>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">GAMBAR</label>
				<div class="col-sm-10">
					<input type="file" class="custome-file" name="gambar" required="" >
				</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">&nbsp;</label>
				<div class="col-sm-10">
					<input type="submit" name="submit" class="btn btn-primary" value="SIMPAN">
				</div>
			</div>
		</form>
		
	</div>
	
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	
</body>
</html>
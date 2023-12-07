<?php
    session_start();
    require_once ('config/koneksi.php');

    require_once ('cek.php');

	// cek apakah yang mengakses halaman ini sudah login

	$data_barang = mysqli_query($conn, "SELECT * FROM barang");
	$jumlah_barang = mysqli_num_rows($data_barang);

	$barang_keluar = mysqli_query($conn, "SELECT * FROM barang_masuk");
	$masuk = mysqli_num_rows($barang_keluar);

	$barang_masuk = mysqli_query($conn, "SELECT * FROM barang_keluar");
	$keluar = mysqli_num_rows($barang_masuk);
?>

<!DOCTYPE html>
<html lang="en"> 
<head>
    <title><?= $toko; ?></title>
    
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <meta name="description" content="Portal - Bootstrap 5 Admin Dashboard Template For Developers">
    <meta name="author" content="Xiaoying Riley at 3rd Wave Media">    
    <link rel="shortcut icon" href="favicon.ico"> 
    
    <!-- FontAwesome JS-->
    <script defer src="assets/plugins/fontawesome/js/all.min.js"></script>
    
    <!-- App CSS -->  
    <link id="theme-style" rel="stylesheet" href="assets/css/portal.css">

</head> 

<body class="app">   	
    <header class="app-header fixed-top">	   	            
        <?php require_once('layouts/navbar.php'); ?>
        <?php require_once('layouts/sidebar.php'); ?>
    </header><!--//app-header-->
    
    <div class="app-wrapper">
	    
	    <div class="app-content pt-3 p-md-3 p-lg-4">
		    <div class="container-xl">

				<div class="app-card alert alert-dismissible shadow-sm mb-4 border-left-decoration" role="alert">
				    <div class="inner">
					    <div class="app-card-body p-3 p-lg-4">
						    <div class="row gx-5 gy-3">
						        <div class="col-12 col-lg-9">
								<h1 class="m-0 font-weight-bold text-primary">Selamat Datang <?= $_SESSION['username']; ?></h1>
							    </div><!--//col-->
						    </div><!--//row-->
						    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					    </div><!--//app-card-body-->
					    
				    </div><!--//inner-->
			    </div><!--//app-card-->
			    
			
			    <div class="row g-4 mb-4">
				    <div class="col-6 col-lg-3">
					    <div class="app-card app-card-stat shadow-sm h-100">
						    <div class="app-card-body p-3 p-lg-4">
							    <h4 class="stats-type mb-1">Jumlah Barang</h4>
							    <div class="stats-figure"><?php echo $jumlah_barang; ?></div>
							    <div class="stats-meta text-success">
								    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-up" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
									<path fill-rule="evenodd" d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5z"/>
									</svg> </div>
						    </div><!--//app-card-body-->
						    <a class="app-card-link-mask" href="barang.php"></a>
					    </div><!--//app-card-->
				    </div><!--//col-->
				    
				    <div class="col-6 col-lg-3">
					    <div class="app-card app-card-stat shadow-sm h-100">
						    <div class="app-card-body p-3 p-lg-4">
							    <h4 class="stats-type mb-1">Jumlah Barang Masuk</h4>
							    <div class="stats-figure"><?php echo $masuk; ?></div>
							    <div class="stats-meta text-success">
								    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-down" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
									<path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1z"/>
									</svg></div>
						    </div><!--//app-card-body-->
						    <a class="app-card-link-mask" href="barang_masuk.php"></a>
					    </div><!--//app-card-->
				    </div><!--//col-->
				    <div class="col-6 col-lg-3">
					    <div class="app-card app-card-stat shadow-sm h-100">
						    <div class="app-card-body p-3 p-lg-4">
							    <h4 class="stats-type mb-1">Jumlah Barang Keluar</h4>
							    <div class="stats-figure"><?php echo $keluar; ?></div>
							    <div class="stats-meta">
								    </div>
						    </div><!--//app-card-body-->
						    <a class="app-card-link-mask" href="barang_keluar.php"></a>
					    </div><!--//app-card-->
				    </div><!--//col-->
			    </div><!--//row-->			    
		    </div><!--//container-fluid-->
	    </div><!--//app-content-->
	    
	    <?php require_once('layouts/footer.php'); ?>
	    
    </div><!--//app-wrapper-->    					

 
    <!-- Javascript -->          
    <script src="assets/plugins/popper.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>  

    <!-- Charts JS -->
    <script src="assets/plugins/chart.js/chart.min.js"></script> 
    <script src="assets/js/index-charts.js"></script> 
    
    <!-- Page Specific JS -->
    <script src="assets/js/app.js"></script> 

</body>
</html> 


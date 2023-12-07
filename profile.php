<?php
    session_start();
    require_once ('config/koneksi.php');

	// cek apakah yang mengakses halaman ini sudah login
	require_once ('cek.php');

    $result1 = mysqli_query($conn, "SELECT * FROM users");
    while($data = mysqli_fetch_array($result1))
    {
        $id = $data['id_login'];
        $nama_toko = $data['nama_toko'];
        $username = $data['username'];
        $password = $data['password'];
        $alamat = $data['alamat'];
        $telp = $data['telp'];
        $role = $data['role'];
    }

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


            <div class="row">
            
            <div class="col-sm-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h5 class="mt-2"><i class="fa fa-user"></i> Kelola Pengguna </h5>
                    </div>
                    <div class="card-body">
                        <div class="box-content">
                            <form class="form-horizontal" method="POST" action="proses.php">
                            <input type="hidden" name="id_login" value="<?php echo $id;?>">
                                <fieldset>
                                    <div class="row g-2 mb-3">
                                    <div class="col mb-0">
                                        <label class="control-label mb-3" for="typeahead">Nama Toko </label>
                                        <div class="input-group">
                                            <input type="text" name="nama_toko" class="form-control" value="<?php echo $nama_toko;?>">
                                        </div>
                                    </div>
                                    <div class="col mb-0">
                                        <label class="control-label mb-3" for="typeahead">Alamat </label>
                                        <div class="controls">
                                        <input type="text" name="alamat" class="form-control" value="<?php echo $alamat;?>">
                                        </div>
                                    </div>
                                    </div>
                                    <div class="row g-2 mb-3">
                                    <div class="col mb-0">
                                        <label class="control-label mb-3" for="typeahead">Telepon </label>
                                        <div class="input-group">
                                        <input type="number" name="telp" class="form-control" value="<?php echo $telp;?>">
                                        </div>
                                    </div>
                                    <div class="col mb-0">
                                        <label class="control-label mb-3" for="typeahead">Role </label>
                                        <div class="input-group">
                                        <input type="text" name="role" class="form-control" value="<?php echo $role;?>">
                                        </div>
                                    </div>
                                    </div>
                                    <div class="row g-2 mb-3">
                                    <div class="col mb-0">
                                        <label class="control-label mb-3" for="typeahead">Username </label>
                                        <div class="input-group">
                                            <input type="text" name="username" class="form-control" value="<?php echo $username;?>">
                                        </div>
                                    </div>
                                    </div>
                                    <input type="hidden" name="id" value="<?php echo $hasil['id_login']; ?>">
                                    <button class="btn btn-primary" type="submit" name="edit-users">
                                        <i class="fas fa-edit"></i> Ubah Profil
                                    </button>
                                    <a href="users.php" class="btn btn-warning">Close</a>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
			    
	
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


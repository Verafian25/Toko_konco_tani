<?php
    session_start();
    require_once ('config/koneksi.php');

	// cek apakah yang mengakses halaman ini sudah login
	if (!isset($_SESSION['role'])) {
		echo "<script>alert('silahkan login terlebih dahulu')</script>";
		echo "<script>document.location.href = 'login.php'</script>";
	}

    $query = mysqli_query($conn, "SELECT * FROM barang_keluar");
    
        $no = 1;

        $tgl_awal = @$_GET['tgl_awal']; // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)
        $tgl_akhir = @$_GET['tgl_akhir']; // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)
        if(empty($tgl_awal) or empty($tgl_akhir)){ // Cek jika tgl_awal atau tgl_akhir kosong, maka :
            // Buat query untuk menampilkan semua data transaksi
            $query = "SELECT * FROM barang_keluar";
            $url_cetak = "print_keluar.php";
            $label = "Semua Data Transaksi";
        }else{ // Jika terisi
            // Buat query untuk menampilkan data transaksi sesuai periode tanggal
            $query = "SELECT * FROM barang_keluar WHERE (tgl_keluar BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."')";
            $result = $conn->query($query);
            $url_cetak = "print_keluar.php?tgl_awal=".$tgl_awal."&tgl_akhir=".$tgl_akhir."&filter=true";
            $label = 'Periode Tanggal '.$tgl_awal.' s/d '.$tgl_akhir;
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head> 

<body class="app">   	
    <header class="app-header fixed-top">	   	            
        <?php require_once('layouts/navbar.php'); ?>
        <?php require_once('layouts/sidebar.php'); ?>
    </header><!--//app-header-->
    
    <div class="app-wrapper">
	    
	    <div class="app-content pt-3 p-md-3 p-lg-4">
		    <div class="container-xl">

            <div class="row g-3 mb-4 align-items-center justify-content-between">
				    <div class="col-auto">
			            <h1 class="app-page-title mb-0">Laporan Data Keluar</h1>
				    </div>
			    </div><!--//row-->

                <div class="row mb-3">
                    <div class="col inline">
                        <form action="laporan_keluar.php" class="form-inline ml-2" method="get">
                            <input type="date" name="tgl_awal" value="<?= @$_GET['tgl_awal'] ?>" class="form-control tgl_awal" placeholder="Tanggal Awal">
                            <input type="date" name="tgl_akhir" value="<?= @$_GET['tgl_akhir'] ?>" class="form-control ml-2 tgl_akhir" placeholder="Tanggal Akhir">
                            <button type="submit" name="filter" value="true" class="btn btn-primary ml-2">TAMPILKAN</button>
                            <?php
                            if(isset($_GET['filter'])) // Jika user mengisi filter tanggal, maka munculkan tombol untuk reset filter
                                echo '<a href="laporan_keluar.php" class="btn btn-primary ml-2">RESET</a>';
                            ?>
                        <a href="<?php echo $url_cetak ?>" class="btn btn-primary ml-2">cetak</a>
                        </form>
                </div>
                </div>

            
            <div class="tab-content" id="orders-table-tab-content">
			        <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
					    <div class="app-card app-card-orders-table shadow-sm mb-5">
						    <div class="app-card-body">
                            <div class="data-tables datatable-dark mb-3">
                                
                            <table class="table table-bordered" id="mauexport" width="100%" cellspacing="0">
                                <thead>
                                <th>Tanggal Keluar</th>
                                <th>Nama barang</th>
                                <th>Qty</th>
                            </thead>
                            <tbody>
                                <?php
                                $sql = mysqli_query($conn, $query); // Eksekusi/Jalankan query dari variabel $query
                                $row = mysqli_num_rows($sql); // Ambil jumlah data dari hasil eksekusi $sql
                                $total = 0;
                                if($row >= 0){ // Jika jumlah data lebih dari 0 (Berarti jika data ada)
                                    while($data = mysqli_fetch_array($sql)){ // Ambil semua data dari hasil eksekusi $sql
                                        $total += $data['stock'];
                                        // $tgl = date('d-m-Y', strtotime($data['tgl'])); // Ubah format tanggal jadi dd-mm-yyyy
                                        echo "<tr>";
                                        echo "<td>".$data['tgl_keluar']."</td>";
                                        echo "<td>".$data['nama_barang']."</td>";
                                        echo "<td>".$data['stock']."</td>";
                                    }
                                }else{ // Jika data tidak ada
                                    echo "<tr><td colspan='5'>Data tidak ada</td></tr>";
                                }
                                ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th colspan="2" class="text-right"><b>TOTAL :</b></th>
                                <th><b><?php echo($total); ?></b></th>
                                </tr>
                            </tfoot>
                            </table> 
                             
                            </div>
                            </div>             
						</div><!--//app-card-body-->		
					</div><!--//app-card-->
			</div><!--//tab-content-->
						    
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
    
    <!-- Include File JS Bootstrap -->
    <script src="libraries/js/bootstrap.min.js"></script>
    <!-- Include library Bootstrap Datepicker -->
    <script src="libraries/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <!-- Include File JS Custom (untuk fungsi Datepicker) -->
    <script src="libraries/js/custom.js"></script>
    <script>
    $(document).ready(function(){
        setDateRangePicker(".tgl_awal", ".tgl_akhir")
    })
    </script>

    

</body>
</html> 


<?php
    session_start();
    require_once ('config/koneksi.php');
    require_once ('cek.php');
    $query = "SELECT * FROM barang";
    $barang = mysqli_query($conn, $query);
    $ambil = mysqli_fetch_array($barang);
    $no = 1;
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
			    
                <div class="row g-3 mb-4 align-items-center justify-content-between">
				    <div class="col-auto">
			            <h1 class="app-page-title mb-0">Data Barang Masuk</h1>
				    </div>
				    <div class="col-auto">
					     <div class="page-utilities">
						    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">    
							<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#basicModal">
							Tambahkan Stock
							</button>      
						    </div><!--//row-->
					    </div><!--//table-utilities-->
				    </div><!--//col-auto-->
			    </div><!--//row-->
				
				<div class="tab-content" id="orders-table-tab-content">
			        <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
					    <div class="app-card app-card-orders-table shadow-sm mb-5">
						    <div class="app-card-body">
							    <div class="table-responsive">
							        <table class="table app-table-hover mb-0 text-left">
										<thead>
											<tr>
												<th class="cell">No</th>
												<th class="cell">Tanggal</th>
												<th class="cell">Nama Barang</th>
												<th class="cell">Stock</th>
												<th class="cell">Aksi</th>
											</tr>
										</thead>
										<tbody>
                                        <?php
                                        $ambildatanya = mysqli_query($conn, "SELECT * FROM barang_masuk");
                                        while($data=mysqli_fetch_array($ambildatanya)){
                                            $tgl_masuk = $data['tgl_masuk'];
                                            $nama_barang = $data['nama_barang'];
                                            $stock = $data['stock'];
                                            $id_masuk = $data['id_masuk'];
                                        ?>
											<tr>
												<td class="cell"><?= $no; ?></td>
												<td class="cell"><?= $tgl_masuk ?></td>
												<td class="cell"><?= $nama_barang ?></td>
												<td class="cell"><?= $stock ?></td>
                                                <td class="cell">
                                                    <!-- <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?= $id_kategori; ?>">
                                                    Edit
                                                    </button> -->
                                                    <a href="proses.php?hapus-stock=<?= $id_masuk; ?>" onclick="return confirm(`yakin menghapus?`)" class="btn btn-danger">Delete</a>
                                                </td>
                                            <tr>
                                              
                                            <?php $no++;
                                            };
                                            ?>
										</tbody>
									</table>
						        </div><!--//table-responsive-->
						       
						    </div><!--//app-card-body-->		
						</div><!--//app-card-->
			        </div><!--//tab-pane-->
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
    
    <!-- Page Specific JS -->
    <script src="assets/js/app.js"></script> 

</body>
   <!-- Tambah Kategori -->
   <div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Tambah Barang Masuk</h5>
                </div>
                <form action="proses.php" method="POST">
                    <div class="modal-body">
                    <div class="row g-2 mb-3">
                        <div class="col mb-0">
                        <h6><label for="emailBasic" class="form-label">Nama Barang</label></h6>
                        <select name="nama_barang" class="form-control" id="nama_barang">
                            <?php foreach($barang as $data){ ?>
                                <option value="<?= $data['nama_barang']?>"><?= $data['nama_barang']?></option>
                            <?php } ?>
                        </select>
                        </div>
                        <div class="col mb-0">
                        <h6><label for="emailBasic" class="form-label">Stock</label></h6>
                        <input type="number" name="stock" class="form-control" placeholder="Masukkan Stock" />
                        </div>
                    </div>
                    <div class="modal-footer mb-3">
                    <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="tambah-stock">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>      
</html> 


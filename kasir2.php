<?php include 'layouts/header.php';?>

<?php 
$barang = mysqli_query($conn, "SELECT * FROM barang");
$jsArray = "var harga_barang = new Array();";
$jsArray1 = "var nama_barang = new Array();";  
?>

    <div class="app-content pt-3">
        <div class="container-xl">

            <div class="col-md-12 mb-2">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="card">
                            <div class="card-body py-4">
                                <form method="POST">
                                    <div class="form-group row mb-0">
                                        <label class="col-sm-4 col-form-label col-form-label-sm"><b>Tgl. Transaksi</b></label>
                                        <div class="col-sm-8 mb-2">
                                            <input type="text" class="form-control form-control-sm" name="tgl_input" value="<?php echo  date("Y-m-d"); ?>" readonly>
                                        </div>
                                        <label class="col-sm-4 col-form-label col-form-label-sm"><b>Nama Barang</b></label>
                                        <div class="col-sm-8 mb-2">
                                            <div class="input-group">
                                                <input type="text" name="nama_barang" class="form-control form-control-sm border-right-0" list="datalist1" onchange="changeValue(this.value)" aria-describedby="basic-addon2" required autocomplete="off">
                                                <datalist id="datalist1">
                                                    <?php if (mysqli_num_rows($barang)) { ?>
                                                        <?php while ($row_brg = mysqli_fetch_array($barang)) { ?>
                                                            <option value="<?php echo $row_brg["nama_barang"] ?>"> <?php echo $row_brg["nama_barang"] ?>
                                                            <?php $jsArray .= "harga_barang['" . $row_brg['nama_barang'] . "'] = {harga_barang:'" . addslashes($row_brg['harga_barang']) . "'};";
                                                        } ?>
                                                        <?php } ?>
                                                </datalist>
                                            </div>
                                        </div>
                                        <label class="col-sm-4 col-form-label col-form-label-sm"><b>Harga</b></label>
                                        <div class="col-sm-8 mb-2">
                                            <input type="number" class="form-control form-control-sm" id="harga_barang" onchange="total()" value="<?php echo $row['harga_barang']; ?>" name="harga_barang" readonly>
                                        </div>
                                        <label class="col-sm-4 col-form-label col-form-label-sm"><b>Quantity</b></label>
                                        <div class="col-sm-8 mb-2">
                                            <input type="number" class="form-control form-control-sm" id="quantity" onchange="total()" name="quantity" placeholder="0" required>
                                        </div>
                                        <label class="col-sm-4 col-form-label col-form-label-sm"><b>Sub-Total</b></label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <input type="text" class="form-control form-control-sm" id="subtotal" name="subtotal" onchange="total()" name="sub_total" readonly>
                                                <div class="input-group-append">
                                                    <button class="btn btn-success btn-sm" name="save" value="simpan" type="submit">
                                                        <i class="fa fa-plus mr-2"></i>Tambah</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <?php
                                if (isset($_POST['save'])) {
                                    $nama = $_POST['nama_barang'];
                                    $harga = $_POST['harga_barang'];
                                    $qty = $_POST['quantity'];
                                    $total = $_POST['subtotal'];
                                    $tgl = $_POST['tgl_input'];

                                    $sql = "INSERT INTO keranjang (nama_barang, harga_barang, quantity, subtotal, tgl_input)
                                    VALUES('$nama','$harga','$qty','$total','$tgl')";
                                    $query = mysqli_query($conn, $sql);

                                    if ($query) {
                                        echo '<script>window.location=""</script>';
                                    } else {
                                        echo "Error :" . $sql . "<br>" . mysqli_error($conn);
                                    }

                                    mysqli_close($conn);
                                } ?>
                                <hr>
                                <?php

                                function format_ribuan($nilai)
                                {
                                    return number_format($nilai, 0, ',', '.');
                                }
                                $tgl = date("Gis");
                                $huruf = "AD";
                                $kodeCart = $huruf . $tgl;
                                ?>
                                <?php
                                $query = mysqli_query($conn, "SELECT * FROM keranjang");
                                $total = 0;
                                $tot_bayar = 0;
                                $no = 1;
                                while ($r = $query->fetch_assoc()) {
                                    $total = $r['harga_barang'] * $r['quantity'];
                                    $tot_bayar += $total;
                                    $bayar = $r['bayar'];
                                    $kembalian = $r['kembalian'];
                                }
                                error_reporting(0);
                                ?>
                                <form method="POST">
                                    <div class="form-group row mb-0">
                                        <input type="hidden" class="form-control" name="no_transaksi" value="<?php echo $kodeCart; ?>" readonly>
                                        <input type="hidden" class="form-control" value="<?php echo $tot_bayar; ?>" id="hargatotal" readonly>
                                        <label class="col-sm-4 col-form-label col-form-label-sm"><b>Bayar</b></label>
                                        <div class="col-sm-8 mb-2">
                                            <input type="number" class="form-control form-control-sm" name="bayar" id="bayarnya" onchange="totalnya()">
                                        </div>
                                        <label class="col-sm-4 col-form-label col-form-label-sm"><b>Kembali</b></label>
                                        <div class="col-sm-8 mb-2">
                                            <input type="number" class="form-control form-control-sm" name="kembalian" id="total1" readonly>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <button class="btn btn-success btn-sm" name="save1" value="simpan" type="submit">
                                            <i class="fa fa-shopping-cart mr-2"></i>Bayar</button>
                                    </div>
                                </form>
                                <?php
                                if (isset($_POST['save1'])) {

                                    $ambil_keranjang = "SELECT * FROM keranjang";
                                    $hasil = mysqli_query($conn, $ambil_keranjang);

                                    if ($hasil) {
                                        while ($data = mysqli_fetch_array($hasil)) {
                                            $nama = $data['nama_barang'];
                                            $harga = $data['harga_barang'];
                                            $qty = $data['quantity'];
                                            $total = $data['subtotal'];
                                            $tgl = $data['tgl_input'];


                                            $keluar = "INSERT INTO barang_keluar (id_keluar, nama_barang, stock, tgl_keluar) 
                                                        VALUES (NUll,'$nama','$qty','$tgl')";
                                            mysqli_query($conn, $keluar);

                                            // var_dump(mysqli_fetch_array($hasil)['nama_barang']);
                                            $update = "UPDATE barang SET stock = stock - $qty WHERE nama_barang = '$nama'";
                                            $query1 = mysqli_query($conn, $update);
                                            // die;

                                        }
                                    }
                                    $notrans = $_POST['no_transaksi'];
                                    $bayar = $_POST['bayar'];
                                    $kembalian = $_POST['kembalian'];
                                    $sql = "UPDATE keranjang SET no_transaksi='$notrans',bayar='$bayar',kembalian='$kembalian' ";
                                    $query = mysqli_query($conn, $sql);;
                                    echo '<script>window.location="kasir2.php"</script>';
                                } ?>
                            </div>
                        </div>
                    </div>
                    <!-- end kasir -->

                    <!-- tes -->
                    <div class="col-md-6">
                        <div class="card" id="print">
                            <div class="card-header bg-white border-0 pb-0 pt-4">
                             
                                    <h5 class='card-tittle mb-3 text-center'><b>TOKO KONCO TANI</b></h5>
                                
                            <div class="row">
                                <div class="col-8 col-sm-9 pr-0">
                                    <ul class="pl-0 small" style="list-style: none;text-transform: uppercase;">
                                        <li>NOTA : <?php 
                                            $notrans = mysqli_query($conn,"SELECT * FROM keranjang ORDER BY no_transaksi ASC LIMIT 1");
                                            while($dat2 = mysqli_fetch_array($notrans)){
                                                $notransaksi = $dat2['no_transaksi'];
                                                echo "$notransaksi";
                                            }
                                        ?></li>
                                        <li>KASIR : Kasir</li>
                                    </ul>
                                </div>
                                <div class="col-4 col-sm-3 pl-0">
                                <ul class="pl-0 small" style="list-style: none;">
                                        <li>TGL : <?php echo  date("j-m-Y");?></li>
                                        <li>JAM : <?php echo  date("G:i:s");?></li>
                                    </ul>
                                </div>
                            </div>
                            </div>
                            <div class="card-body small pt-0">
                                <hr class="mt-0">
                                <div class="row">
                                    <div class="col-5 pr-0">
                                        <span><b>Nama Barang</b></span>
                                    </div>
                                    <div class="col-1 px-0 text-center">
                                        <span><b>Qty</b></span>
                                    </div>
                                    <div class="col-3 px-0 text-right">
                                        <span><b>Harga</b></span>
                                    </div>
                                    <div class="col-3 pl-0 text-right">
                                        <span><b>Subtotal</b></span>
                                    </div>
                                    <div class="col-12">
                                        <hr class="mt-2">
                                    </div>
                                    <?php
                                    $data_barang = mysqli_query($conn, "SELECT * FROM keranjang");
                                    while ($d = mysqli_fetch_array($data_barang)) {
                                    ?>
                                        <div class="col-5 pr-0">
                                            <a href="?id=<?php echo $d['id_keranjang']; ?>" onclick="javascript:return confirm('Hapus Data Barang ?');" style="text-decoration:none;">
                                                <i class="fa fa-times fa-xs text-danger mr-1"></i>
                                                <span class="text-dark"><?php echo $d['nama_barang']; ?></span>
                                            </a>
                                        </div>
                                        <div class="col-1 px-0 text-center">
                                            <span><?php echo $d['quantity']; ?></span>
                                        </div>
                                        <div class="col-3 px-0 text-right">
                                            <span><?php echo rupiah($d['harga_barang']); ?></span>
                                        </div>
                                        <div class="col-3 pl-0 text-right">
                                            <span><?php echo rupiah($d['subtotal']); ?></span>
                                        </div>
                                    <?php } ?>
                                    <div class="col-12">
                                        <hr class="mt-2">
                                        <ul class="list-group border-0">
                                            <li class="list-group-item p-0 border-0 d-flex justify-content-between align-items-center">
                                                <b>Total</b>
                                                <span><b><?php echo rupiah($tot_bayar); ?></b></span>
                                            </li>
                                            <li class="list-group-item p-0 border-0 d-flex justify-content-between align-items-center">
                                                <b>Bayar</b>
                                                <span><b><?php echo rupiah($bayar); ?></b></span>
                                            </li>
                                            <li class="list-group-item p-0 border-0 d-flex justify-content-between align-items-center">
                                                <b>Kembalian</b>
                                                <span><b><?php echo rupiah($kembalian); ?></b></span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-12 mt-3 text-center">
                                        <p>* TERIMA KASIH TELAH BERBELANJA*</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-right mt-3">
                            <form method="POST">
                                <button class="btn btn-success btn-sm" onclick="printContent('print')"><i class="fa fa-check mr-1"></i> Print</button>
                                <button class="btn btn-success btn-sm" name="selesai" type="submit"><i class="fa fa-check mr-1"></i> Selesai</button>
                                <a href="logout.php" class="btn btn-succes btn-sm">Logout</a>
                            </form>
                        </div>
                        <?php
                        if (isset($_POST['selesai'])) {
                            $ambildata = mysqli_query($conn, "INSERT INTO laporanku (no_transaksi,bayar,kembalian,id_keranjang,nama_barang, harga_barang, quantity, subtotal, tgl_input)
                        SELECT no_transaksi,bayar,kembalian,id_keranjang, nama_barang, harga_barang, quantity, subtotal, tgl_input
                        FROM keranjang ") or die(mysqli_connect_error());
                            $hapusdata = mysqli_query($conn, "DELETE FROM keranjang");
                            echo '<script>window.location="kasir2.php"</script>';
                        }
                        ?>
                    </div>
                    <!-- end tes -->

                    <?php
                    include 'config.php';
                    if (!empty($_GET['id'])) {
                        $id = $_GET['id'];
                        $hapus_data = mysqli_query($conn, "DELETE FROM keranjang WHERE id_keranjang ='$id'");
                        echo '<script>window.location="kasir2.php"</script>';
                    }

                    ?>
                </div><!-- end row col-md-9 -->
            </div>
            <script type="text/javascript">
                <?php echo $jsArray; ?>
                <?php echo $jsArray1; ?>

                function changeValue(id_barang) {
                    document.getElementById("harga_barang").value = harga_barang[id_barang].harga_barang;
                };

                function total() {
                    var harga = parseInt(document.getElementById('harga_barang').value);
                    var jumlah_beli = parseInt(document.getElementById('quantity').value);
                    var jumlah_harga = harga * jumlah_beli;
                    document.getElementById('subtotal').value = jumlah_harga;
                }

                function totalnya() {
                    var harga = parseInt(document.getElementById('hargatotal').value);
                    var pembayaran = parseInt(document.getElementById('bayarnya').value);
                    var kembali = pembayaran - harga;
                    document.getElementById('total1').value = kembali;
                }

                function printContent(print) {
                    var restorepage = document.body.innerHTML;
                    var printcontent = document.getElementById(print).innerHTML;
                    document.body.innerHTML = printcontent;
                    window.print();
                    document.body.innerHTML = restorepage;
                }
            </script>
        </div>


    </div><!--//container-fluid-->
    </div><!--//app-content-->

    <?php require_once('layouts/footer.php'); ?>

    </div><!--//app-wrapper-->


    <!-- Javascript -->
    <script src="assets/plugins/popper.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>

    <!-- Charts JS -->
    <script src="assets/plugins/chart.js/chart.min.js"></script>
    <script src="assets/js/kasir2-charts.js"></script>

    <!-- Page Specific JS -->
    <script src="assets/js/app.js"></script>


</body>

</html>
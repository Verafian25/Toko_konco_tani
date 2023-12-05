<?php ob_start(); ?>
<html>
<head>
  <title>Cetak PDF</title>
  <style>
    .table {
      border-collapse:collapse;
      table-layout:fixed;width: 500px;
    }
    .table th {
      padding: 10px;
    }
    .table td {
      word-wrap:break-word;
      width: 30%;
      padding: 5px;
    }
  </style>
</head>
<body>
  <?php
  // Load file koneksi.php
  include "config/koneksi.php";

        $query = mysqli_query($conn, "SELECT * FROM barang_masuk");

        $tgl_awal = @$_GET['tgl_awal']; // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)
        $tgl_akhir = @$_GET['tgl_akhir']; // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)
        if(empty($tgl_awal) or empty($tgl_akhir)){ // Cek jika tgl_awal atau tgl_akhir kosong, maka :
            // Buat query untuk menampilkan semua data transaksi
            $query = "SELECT * FROM barang_masuk";
            $url_cetak = "laporan_masuk.php";
            $label = "Semua Data Transaksi";
        }else{ // Jika terisi
            // Buat query untuk menampilkan data transaksi sesuai periode tanggal
            $query = "SELECT * FROM barang_masuk WHERE (tgl_masuk BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."')";
            $url_cetak = "laporan_masuk.php?tgl_awal=".$tgl_awal."&tgl_akhir=".$tgl_akhir."&filter=true";
            $tgl_awal = date('d-m-Y', strtotime($tgl_awal)); // Ubah format tanggal jadi dd-mm-yyyy
            $tgl_akhir = date('d-m-Y', strtotime($tgl_akhir)); // Ubah format tanggal jadi dd-mm-yyyy
            $label = 'Periode Tanggal '.$tgl_awal.' s/d '.$tgl_akhir;
        }
  ?>
                <h4 style="margin-bottom: 5px;">Data Barang Masuk</h4>
                <?php echo $label ?>
                <table class="table" border="1" width="100%" style="margin-top: 10px;">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Nama Barang</th>
                        <th>Qty</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = mysqli_query($conn, $query); // Eksekusi/Jalankan query dari variabel $query
                    $row = mysqli_num_rows($sql); // Ambil jumlah data dari hasil eksekusi $sql
                    $total = 0;
                    if($row > 0){ // Jika jumlah data lebih dari 0 (Berarti jika data ada)
                        while($data = mysqli_fetch_array($sql)){ // Ambil semua data dari hasil eksekusi $sql
                          $total += $data['stock'];
                            // $tgl = date('d-m-Y', strtotime($data['tgl'])); // Ubah format tanggal jadi dd-mm-yyyy
                            echo "<tr>";
                            // echo "<td>".$tgl."</td>";
                            echo "<td>".$data['tgl_masuk']."</td>";
                            echo "<td>".$data['nama_barang']."</td>";
                            echo "<td>".$data['stock']."</td>";
                            echo "</tr>";
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
</body>
</html>
<?php
$html = ob_get_contents();
ob_end_clean();
require 'libraries/html2pdf/autoload.php';
$pdf = new Spipu\Html2Pdf\Html2Pdf('P','A4','en');
$pdf->WriteHTML($html);
$pdf->Output('Data Transaksi.pdf', 'I');
?>
<?php
$conn = mysqli_connect("localhost", "root", "", "konco_tani");

$toko = 'Toko Konco Tani';
$urlToko = '/konco_tani/';

date_default_timezone_set('Asia/Jakarta');   

function rupiah($angka)
{
    $hasil_rupiah = "Rp " . number_format($angka, 2, ',', '.');
    return $hasil_rupiah;
}
function rupiahNoRp($angka)
{
    $hasil_rupiah = number_format($angka, 0, ',', '.');
    return $hasil_rupiah;
}

?>


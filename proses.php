<?php
require_once 'config/koneksi.php';

// tambah users
if (isset($_POST["tambah-users"])) {
    $nama_toko = $_POST["nama_toko"];
    $username = $_POST["username"];
    $password = md5($_POST["password"]);
    $alamat = $_POST["alamat"];
    $telp = $_POST["telp"];
    $role = $_POST["role"];

    $query = "INSERT INTO users (id_login, nama_toko, username, password, alamat, telp, role)
             VALUES (Null,'$nama_toko','$username','$password','$alamat','$telp','$role')";
    mysqli_query($conn, $query);
    
    echo "<script>alert('Berhasil tambah user');</script>";
    echo "<script>window.location.href = 'users.php';</script>";
}

// edit users
if(isset($_POST['edit-users'])){
    $id_login = $_POST["id_login"];
    $nama_toko = $_POST["nama_toko"];
    $username = $_POST["username"];
    $alamat = $_POST["alamat"];
    $telp = $_POST["telp"];
    $role = $_POST["role"];
    
    $query = "UPDATE users SET
              nama_toko = '$nama_toko',
              username = '$username',
              alamat = '$alamat',
              telp = '$telp',
              role = '$role'
              WHERE id_login = '$id_login'
    ";
    mysqli_query($conn, $query);

    echo "<script>alert('Data user berhasil diubah');</script>";
    echo "<script>window.location.href = 'users.php';</script>";
}

// hapus users
if (isset($_GET['hapus-users'])) {
    $id_login = $_GET['hapus-users'];

    $query = "DELETE FROM users WHERE id_login='$id_login'";
    mysqli_query($conn, $query);
    
    echo "<script>alert('Data user berhasil dihapus');</script>";
    echo "<script>window.location.href = 'users.php';</script>";
}

// tambah Kategori
if (isset($_POST["tambah-kategori"])) {
    $nama_kategori = $_POST["nama_kategori"];

    $query = "INSERT INTO kategori (id_kategori, nama_kategori) VALUES (Null,$nama_kategori)";
    mysqli_query($conn, $query);
    
    echo "<script>alert('Berhasil tambah kategori');</script>";
    echo "<script>window.location.href = 'kategori.php';</script>";
}

// edit kategori
if(isset($_POST['edit-kategori'])){
    $id_kategori = $_POST['id_kategori'];
    $nama_kategori = $_POST["nama_kategori"];
    
    $query = "UPDATE kategori SET
              nama_kategori = '$nama_kategori'
              WHERE id_kategori=$id_kategori
    ";
    mysqli_query($conn, $query);

    echo "<script>alert('Data kategori berhasil diubah');</script>";
    echo "<script>window.location.href = 'kategori.php';</script>";
}

// hapus kategori
if (isset($_GET['hapus-kategori'])) {
    $id_kategori = $_GET['hapus-kategori'];

    $query = "DELETE FROM kategori WHERE id_kategori='$id_kategori'";
    mysqli_query($conn, $query);
    
    echo "<script>alert('Data kategori berhasil dihapus');</script>";
    echo "<script>window.location.href = 'kategori.php';</script>";
}

// tambah satuan
if (isset($_POST["tambah-satuan"])) {
    $nama_satuan = $_POST["nama_satuan"];

    $query = "INSERT INTO satuan (id_satuan, nama_satuan) VALUES (Null,'$nama_satuan')";
    mysqli_query($conn, $query);
    
    echo "<script>alert('Berhasil tambah satuan');</script>";
    echo "<script>window.location.href = 'satuan.php';</script>";
}

// edit kategori
if(isset($_POST['edit-satuan'])){
    $id_satuan = $_POST['id_satuan'];
    $nama_satuan = $_POST["nama_satuan"];
    
    $query = "UPDATE satuan SET
              nama_satuan       = '$nama_satuan'
              WHERE id_satuan   =  $id_satuan
    ";
    mysqli_query($conn, $query);

    echo "<script>alert('Data satuan berhasil diubah');</script>";
    echo "<script>window.location.href = 'satuan.php';</script>";
}

// hapus kategori
if (isset($_GET['hapus-satuan'])) {
    $id_satuan = $_GET['hapus-satuan'];

    $query = "DELETE FROM satuan WHERE id_satuan='$id_satuan'";
    mysqli_query($conn, $query);
    
    echo "<script>alert('Data satuan berhasil dihapus');</script>";
    echo "<script>window.location.href = 'satuan.php';</script>";
}

// tambah barang
if (isset($_POST["tambah-barang"])) {
    $nama_barang = $_POST["nama_barang"];
    $nama_kategori = $_POST["nama_kategori"];
    $stock = '0';
    $nama_satuan = $_POST["nama_satuan"];
    $harga_barang = $_POST["harga_barang"];

    $query = "INSERT INTO barang
        (id_barang, nama_barang, nama_kategori, stock, nama_satuan, harga_barang) 
        VALUES 
        (NULL, '$nama_barang','$nama_kategori', '$stock', '$nama_satuan', '$harga_barang');";

    mysqli_query($conn, $query);
    
    echo "<script>alert('Berhasil tambah barang');</script>";
    echo "<script>window.location.href = 'barang.php';</script>";
}

// edit barang
if(isset($_POST['edit-barang'])){
    $id_barang = $_POST['id_barang'];
    $nama_barang = $_POST["nama_barang"];
    $nama_kategori = $_POST["nama_kategori"];
    $nama_satuan = $_POST["nama_satuan"];
    $harga_barang = $_POST["harga_barang"];
    
    $query = "UPDATE barang SET
              nama_barang = '$nama_barang',
              nama_kategori = '$nama_kategori',
              nama_satuan = '$nama_satuan',
              harga_barang = '$harga_barang'
              WHERE id_barang=$id_barang 
    ";
    mysqli_query($conn, $query);

    echo "<script>alert('Data barang berhasil diubah');</script>";
    echo "<script>window.location.href = 'barang.php';</script>";
}

// hapus barang
if (isset($_GET['hapus-barang'])) {
    $id_barang = $_GET['hapus-barang'];

    $query = "DELETE FROM barang WHERE id_barang='$id_barang'";
    mysqli_query($conn, $query);
    
    echo "<script>alert('Data barang berhasil diubah');</script>";
    echo "<script>window.location.href = 'barang.php';</script>";
}

// tambah barang masuk
if (isset($_POST['tambah-stock'])) {
    $nama_barang = $_POST['nama_barang'];
    $stock = $_POST['stock'];
    $tgl_masuk = date("Y-m-d");

    $b_masuk = "INSERT INTO barang_masuk (id_masuk, nama_barang, stock, tgl_masuk) 
                VALUES  (Null,'$nama_barang','$stock','$tgl_masuk')";
    mysqli_query($conn,$b_masuk);

    $tambahstock = "UPDATE barang SET stock = stock + '$stock' WHERE nama_barang = '$nama_barang'";
    mysqli_query($conn, $tambahstock);
    
    echo "<script>alert('Berhasil tambah stock');</script>";
    header("location: barang_masuk.php");
}

// hapus barang masuk
if (isset($_GET['hapus-stock'])) {
    $id_masuk = $_GET['hapus-stock'];

    $query = "DELETE FROM barang_masuk WHERE id_masuk='$id_masuk'";
    mysqli_query($conn, $query);
    
    echo "<script>alert('Data stock berhasil dihapus');</script>";
    echo "<script>window.location.href = 'barang_masuk.php';</script>";
}

// tambah keranjang
if (isset($_POST['tambah-keranjang'])) {
    $nama_barang = $_POST['nama_barang'];
    $jumlah_beli = $_POST['jumlah'];
    $ambil = "SELECT * FROM barang WHERE nama_barang = '$nama_barang'";
    $hasil = mysqli_query($conn, $ambil);
    $data = mysqli_fetch_array($hasil);
    $harga_barang = $data['harga_barang'];
    //mengambil stock dari tabel barang
    $stock = $data['stock']; 
    $total_harga = $jumlah_beli * $harga_barang;
    $keranjang = "INSERT INTO keranjang (id_keranjang, nama_barang, harga_barang, quantity, subtotal, tgl_input, no_transaksi, bayar, kembalian) 
                    VALUES (Null,'$nama_barang','$harga_barang','$stock','$jumlah_beli','$total_harga')";
    mysqli_query($conn, $keranjang);
    
    header("location: kasir1.php");
}


// tambah barang keluar
if (isset($_POST['tambah-keluar'])) {
    $nama_barang = $_POST['nama_barang'];
    $stock = $_POST['stock'];
    $tgl_keluar = date("Y-m-d");

    // Cek apakah stok yang tersedia cukup
    $check_stock_query = "SELECT stock FROM barang WHERE nama_barang = '$nama_barang'";
    $result = mysqli_query($conn, $check_stock_query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $available_stock = $row['stock'];

        // Cek apakah stok cukup
        if ($stock <= $available_stock) {
            // Lanjutkan dengan operasi penambahan dan pembaruan
            $b_keluar = "INSERT INTO barang_keluar (id_keluar, nama_barang, stock, tgl_keluar) 
                        VALUES (NULL,'$nama_barang','$stock','$tgl_keluar')";
            mysqli_query($conn, $b_keluar);

            $kurangstock = "UPDATE barang SET stock = stock - '$stock' WHERE nama_barang = '$nama_barang'";
            mysqli_query($conn, $kurangstock);

            header("location: barang_keluar.php");
        } else {
            echo' <script>
            alert("Stock saat ini tidak mencukupi");
            window.location.href="barang_keluar.php";
            </script>';
        }
    } else {
        // Atasi kesalahan kueri basis data
        header("location: barang_keluar.php?error=kesalahan_database");
    }
}


// hapus barang keluar
if (isset($_GET['hapus-keluar'])) {
    $id_keluar = $_GET['hapus-keluar'];

    $query = "DELETE FROM barang_keluar WHERE id_keluar='$id_keluar'";
    mysqli_query($conn, $query);
    
    echo "<script>alert('Data barang keluar berhasil dihapus');</script>";
    echo "<script>window.location.href = 'barang_keluar.php';</script>";
}



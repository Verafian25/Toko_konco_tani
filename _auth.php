<?php
require_once 'config/koneksi.php';

// login 
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    // Menjalankan koneksi ke database dan melakukan query untuk memeriksa data pengguna yang sesuai dengan username dan password yang dimasukkan
    $login = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password='$password'");
    
    // Menghitung jumlah baris data yang ditemukan
    $cek = mysqli_num_rows($login);
    $data = mysqli_fetch_assoc($login);

    // Memeriksa apakah username yang dimasukkan adalah 'admin'
    if ($username == 'admin') {
        // Memeriksa apakah password yang dimasukkan adalah hash MD5 dari 'admin'
        if ($password == "21232f297a57a5a743894a0e4a801fc3") {
            // Jika kedua username dan password cocok, maka mulai sesi untuk pengguna admin
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['role'] = 'admin';

            // Menampilkan pesan selamat datang untuk admin dan mengalihkan ke 'index.php'
            echo "<script>alert('Selamat datang admin')</script>";
            echo "<script>document.location.href = 'index.php'</script>";
            die;
        }
        // Jika password tidak cocok, tampilkan pesan kesalahan dan alihkan ke 'login.php'
        echo "<script>alert('Username atau Password salah')</script>";
        echo "<script>document.location.href = 'login.php'</script>";
        die;
    } else if ($data['role'] == "kasir") {
        // Jika peran adalah 'kasir', periksa database untuk username yang dimasukkan
        $query = "SELECT * FROM users WHERE username = '$username'";
        $dataUser = mysqli_query($conn, $query);
        $data = mysqli_fetch_assoc($dataUser);

        // Memeriksa apakah username yang dimasukkan tidak ditemukan dalam database
        if ($data == null) {
            echo "<script>alert('Username tidak ditemukan')</script>";
            echo "<script>document.location.href = 'login.php'</script>";
            die;
        } else if ($data['password'] <> $password) {
            // Jika password yang dimasukkan tidak cocok, tampilkan pesan kesalahan dan alihkan ke 'login.php'
            echo "<script>alert('Password salah')</script>";
            echo "<script>document.location.href = 'login.php'</script>";
            die;
        } else {
            // Jika kedua username dan password cocok, mulai sesi untuk pengguna 'kasir'
            session_start();
            $_SESSION['username'] = $data['username'];
            $_SESSION['role'] = 'kasir';
            $_SESSION['id_login'] = $data['id_login'];

            // Menampilkan pesan keberhasilan dan mengalihkan ke 'kasir2.php'
            echo "<script>alert('Berhasil login')</script>";
            echo "<script>document.location.href = 'kasir2.php'</script>";
            die;
        }
    } else {
        // Jika peran bukan 'admin' atau 'kasir', periksa database untuk username yang dimasukkan
        $query = "SELECT * FROM users WHERE username = '$username'";
        $dataUser = mysqli_query($conn, $query);
        $data = mysqli_fetch_assoc($dataUser);

        // Memeriksa apakah username yang dimasukkan tidak ditemukan dalam database
        if ($data == null) {
            echo "<script>alert('Username tidak ditemukan')</script>";
            echo "<script>document.location.href = 'login.php'</script>";
            die;
        } else if ($data['password'] <> $password) {
            // Jika password yang dimasukkan tidak cocok, tampilkan pesan kesalahan dan alihkan ke 'login.php'
            echo "<script>alert('Password salah')</script>";
            echo "<script>document.location.href = 'login.php'</script>";
            die;
        } else {
            // Jika kedua username dan password cocok, mulai sesi untuk pengguna 'pemilik'
            session_start();
            $_SESSION['username'] = $data['username'];
            $_SESSION['role'] = 'pemilik';
            $_SESSION['id_login'] = $data['id_login'];

            // Menampilkan pesan keberhasilan dan mengalihkan ke 'index.php'
            echo "<script>alert('Berhasil login')</script>";
            echo "<script>document.location.href = 'index.php'</script>";
            die;
        }
    }
}
?>

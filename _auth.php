<?php
require_once 'config/koneksi.php';
// login 
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
        // menyeleksi data users dengan username dan password yang sesuai
        $login = mysqli_query($conn,"SELECT * FROM users WHERE username='$username' AND password='$password'");
        // menghitung jumlah data yang ditemukan
        $cek = mysqli_num_rows($login);
        $data = mysqli_fetch_assoc($login);

    if ($username == 'admin') {
        if ($password == "21232f297a57a5a743894a0e4a801fc3") {
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['role'] = 'admin';

            header("Location: index.php");
        }
    } else if($data['role']=="kasir") {
        $query = "SELECT * FROM users WHERE username = '$username'";
        $dataUser = mysqli_query($conn, $query);
        $data = mysqli_fetch_assoc($dataUser);

        if ($data == null) {
            echo "<script>alert('Username tidak ditemukan')</script>";
            echo "<script>document.location.href = 'login.php'</script>";
            die;
        } else if ($data['password'] <> $password) {
            echo "<script>alert('Password salah')</script>";
            echo "<script>document.location.href = 'login.php'</script>";
            die;
        } else {
            session_start();
            $_SESSION['username'] = $data['username'];
            $_SESSION['role'] = 'kasir';
            $_SESSION['id_login'] = $data['id_login'];

            header("Location: kasir2.php");
        }
    } else {
        $query = "SELECT * FROM users WHERE username = '$username'";
        $dataUser = mysqli_query($conn, $query);
        $data = mysqli_fetch_assoc($dataUser);

        if ($data == null) {
            echo "<script>alert('Username tidak ditemukan')</script>";
            echo "<script>document.location.href = 'login.php'</script>";
            die;
        } else if ($data['password'] <> $password) {
            echo "<script>alert('Password salah')</script>";
            echo "<script>document.location.href = 'login.php'</script>";
            die;
        } else {
            session_start();
            $_SESSION['username'] = $data['username'];
            $_SESSION['role'] = 'pemilik';
            $_SESSION['id_login'] = $data['id_login'];

            header("Location: index.php");
        }
    }
}



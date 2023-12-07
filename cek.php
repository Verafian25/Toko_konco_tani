<?php 
if (!isset($_SESSION['role'])) {
		echo "<script>alert('silahkan login terlebih dahulu')</script>";
		echo "<script>document.location.href = 'login.php'</script>";
	}

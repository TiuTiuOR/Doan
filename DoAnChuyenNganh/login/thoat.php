<?php 
//Khai báo biến nào hủy biến đó để thoát
	session_start();
	unset($_SESSION['admin_user']);
	unset($_SESSION['admin_id']);

	header('location:index.php');

 ?>
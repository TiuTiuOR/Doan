<?php 
//Khai báo biến nào hủy biến đó để thoát
	session_start();
	unset($_SESSION['name_user']);
	unset($_SESSION['name_id']);

	header('location:index.php');

 ?>

<?php 
    include'autoload/autoload.php';
    include'header.php';
   
?>
<div class="col-md-9">
	 <section class="box-main1">
	 	<h3 class="title-main" ><a href=""> Thông báo đơn hàng</a> </h3>
	 <?php if(isset($_SESSION['success'])): ?>
			<!--Thông báo thành công từ đăng ký-->
			<div class="alert alert-success">
				  <strong style="color: green"><?php echo $_SESSION['success'];unset($_SESSION['success']) ?></strong> 
			</div>
		<?php endif ?>
    <?php if(isset($_SESSION['error'])): ?>
        <div class="alert alert-danger">
                  <strong style="color: red"><?php echo $_SESSION['error'];unset($_SESSION['error']) ?></strong> 
            </div>
     <?php endif ?>
		<a href="index.php" class="btn btn-success">Trở về trang chủ</a>
	 </section>
	</div>
	<?php include'footer.php'; ?>
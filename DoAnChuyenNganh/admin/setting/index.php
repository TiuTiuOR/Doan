<?php 
$open="setting";
	include_once'../autoload/autoload.php';
    
    include'setting.php';
    
    include_once'../../layouts/header.php';
    

 ?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
           Cài đặt chung
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i>  <a href="../index.php"> Bảng điều khiển</a>
            </li>
            <li class="active">
                <i class="fa fa-cogs"></i> Cài đặt
            </li>
        </ol>
        <!--Hiển thị danh thông báo session khi thành công hay thất bại-->
        <div class="clearfix"></div>
        <?php if(isset($_SESSION['success'])):?>
        <div class="alert alert-success">
            <?php echo $_SESSION['success'];
                unset($_SESSION['success']) ?>
        </div>
        <?php endif ?>
        <?php if(isset($_SESSION['error'])):?>
        <div class="alert alert-danger">
            <?php echo $_SESSION['error'];
                unset($_SESSION['error']) ?>
        </div>
        <?php endif ?>
    </div>
</div>


<div class="row">
    <div class="col-lg-12" >
        <!--Muốn upload được ảnh phải có enctype-->
        <!--Thêm pannel-->
        <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
        	<!--Pannel-->
        	<div class="col-lg-12" style="margin-top: 10px;">
            <label for="InputEmail1" style="padding-left: 0" class="col-sm-2" ><a href="pannel.php">Danh sách pannel</a></label>



			<!--submit-->
            <div class="form-group">
                <div style="margin-top: 15px;" class="col-sm-offset-2 col-sm-10"> 
                    <button type="submit" class="btn btn-primary">Lưu lại</button>
                </div>
            </div>
        </form>
    </div>
</div>





 <?php include_once'../../layouts/footer.php'?>	
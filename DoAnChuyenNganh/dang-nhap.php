<?php 
    include'autoload/autoload.php';
   
    	if(isset($_SESSION['name_id']))
        {
            echo "<script>alert('Bạn đang đăng nhập, không thể thực hiện thao tác này!!'); location=' index.php'</script> ";
        }
    
    	$data=[
                "name" => postInput("name"),
                "password" => postInput("password")
        ];        
        if($_SERVER["REQUEST_METHOD"]=="POST")
        {
        	//Kiểm tra tên và mk trong csdl users
    		$is_check=$db->fetchOne("users","name='".$data['name']."'AND password ='".md5($data['password'])."'");
    		if($is_check!=Null)
    		{
    			$_SESSION['name_user']	= $is_check['name'];
    			$_SESSION['name_id']	= $is_check['id'];
    			//echo "<script>alert('Đăng nhập thành công'); location=' index.php'</script> ";
    			$_SESSION['success'] = "Đăng nhập thành công";
    			header('location: index.php');
    		}        
    		else
    		{
    			$_SESSION['error']="Bạn đã điền sai tên đăng nhập hoặc mật khẩu vui lòng thử lại";
    		}	
        	
        }
        include'header.php';
       
        ?>
<div class="col-md-9 bor" style="border-radius: 5px;">
    <section class="" style="margin-bottom: 13px; margin-top: 5px;">
        <h3 class="title-main" style="border-bottom: none;" ><a href=""> Đăng nhập</a> </h3>
    </section>
    <?php if(isset($_SESSION['success'])): ?>
    <!--Thông báo thành công từ đăng ký-->
    <div class="alert alert-success">
        <strong style="color: green"><?php echo $_SESSION['success'];unset($_SESSION['success']) ?></strong> 
    </div>
    <?php endif ?>
    <?php if(isset($_SESSION['error'])): ?>
    <!--Thông báo không thành công-->
    <div class="alert alert-danger">
        <strong style="color: red"><?php echo $_SESSION['error'];unset($_SESSION['error']) ?></strong> 
    </div>
    <?php endif ?>
    <form class="form-horizontal" action="" method="POST">
    <div class="form-group" style="margin-top: 20px">
        <label class="control-label col-sm-4" for="name">Tên đăng nhập:</label>
        <div class="col-sm-5" style="padding-left:0px">
            <input type="text" class="form-control" id="name" placeholder="Nhập tên đăng nhập" name="name" value="<?php echo $data['name'] ?>" required="">
            <?php if(isset($error['name'])): ?>
            <p class="text-danger"><?php echo $error['name'];?></p>
            <?php endif ?>
        </div>
    </div>
    <div class="form-group" style="margin-top: 20px">
        <label class="control-label col-sm-4" for="pwd">Mật khẩu:</label>
        <div class="col-sm-5" style="padding-left: 0px">
            <input type="password" class="form-control" id="pwd" placeholder="Nhập mật khẩu" name="password" required="" >
            <?php if(isset($error['password'])): ?>
            <p class="text-danger"><?php echo $error['password'];?></p>
            <?php endif ?>
        </div>
    </div>
    <div class="control-label col-sm-5">
        <a href="quenmk.php">Quên mật khẩu</a>
    </div>
    
    <div class="form-group" style="margin-top: 25px; margin-bottom: 20px;">
        <div class="col-sm-offset-6 col-sm-3">
            <a href="dang-ky.php" class="btn btn-primary">Đăng ký</a>
            <button type="submit" style="margin-left:12px" class="btn btn-primary">Đăng nhập</button>
        </div>
    </div>
</div>
<?php include'footer.php'; ?>
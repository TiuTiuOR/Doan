<?php 
    $open="admin";
    //include_once'../../libraries/connect.php';
    include_once'../../autoload/autoload.php';
    
    $id=intval(getInput('id'));
    
    //Lấy id trong bảng qua hàm fetchID
    $editadmin = $db->fetchID("admin",$id);
    if(empty($editadmin))//nếu edit trống thực thi lệnh
    {
        $_SESSION['error']="Dữ liệu không tồn tại";
                redirectAdmin("admin");//redirecAdmin chuyển về các trang
    }
    if($_SERVER['REQUEST_METHOD'] == "POST")

    {   //Khai báo mảng data từ dtbase.php hàm insert
     $data=
        [
            "name" => postInput("name"),
            "email" => postInput("email"),
            "phone" => postInput("phone"),
            "address" => postInput("address"),
            "level" => postInput("level"),
            "account" => postInput("account")
        ];   
        $error = [];//khởi tạo mảng lỗi
        if(postInput('password') != NULL && postInput('re_password')!=NULL)
        {
            $data['password'] = MD5(postInput("password"));
            if(postInput("password")!=postInput("re_password"))
            {
                $error['password']="Mật khẩu không khớp";
            }
        }
        if(postInput('name')=='')
        {
            $error['name']="Mời bạn nhập tên";
        
        }
        if(postInput('phone')=='')
        {
            $error['phone']="Mời bạn nhập số điện thoại";
        }
        if(postInput('account')=='')
        {
            $error['account']="Bạn chưa nhập họ tên";
        }
        if(postInput('email')=='')
        {
            $error['email']= "Bạn chưa nhập địa chỉ Email";
        }
        else
        {
            if(postInput('email')!=$editadmin['email'])
            {
                $is_check=$db->fetchOne("admin","email ='".$data['email']."' ");
            if($is_check != NULL)
            {
                $error['email']= "Email đã tồn tại";
                
            }   
            }
        }
        
        if(postInput('address')=='')
        {
            $error['address']= "Bạn chưa nhập địa chỉ";
        }
        
        
        //nếu lỗi trống thực thi lệnh
        if(empty($error))
        {   //câu lênh cho upload file            
    
        //kiểm tra trùng tên
            
            //insert dữ liệu
            $id_update = $db->update("admin",$data,array('id' =>$id ));
        if($id_update>0)
        {
            move_uploaded_file($file_tmp,$part.$file_name);
                $_SESSION['success']="Cập nhật thành công";
                redirectAdmin("admin");//redirecAdmin chuyển về các trang
        }
        else
        {
            $_SESSION['error']="Dữ liệu không thay đổi";
                redirectAdmin("admin");
        }
         
        }
    }
    
    ?>
<?php include_once'../../../layouts/header.php'?>
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Tạo tài khoản
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i>  <a href="index.php">Danh sách tài khoản</a>
            </li>
            <li class="active">
                <i class="fa fa-file"></i> Thêm mới tài khoản
            </li>
        </ol>
        <div class="clearfix"></div>
        <?php include_once'../../../partials/notification.php'; ?>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <!--Muốn upload được ảnh phải có enctype-->
        <form class="form-horizontal" action="" method="POST">
            <div class="form-group">
                <label for="InputEmail1" class="col-sm-2"> Tài khoản </label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nhập tên sản phẩm" name="name" value="<?php echo $editadmin['name'] ?>">
                    <!--nếu tồn tại mảng lỗi error in lỗi tại vị trí-->
                    <?php if(isset($error['name'])): ?>
                    <p class="text-danger"><?php echo $error['name'];?></p>
                    <?php endif?>
                </div>
            </div>
            <div class="form-group">
                <label for="InputEmail1" class="col-sm-2"> Họ và tên </label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nhập họ tên" name="account" value="<?php echo $editadmin['account'] ?>">
                    <!--nếu tồn tại mảng lỗi error in lỗi tại vị trí-->
                    <?php if(isset($error['account'])): ?>
                    <p class="text-danger"><?php echo $error['account'];?></p>
                    <?php endif?>
                </div>
            </div>
            <div class="form-group">
                <label for="InputEmail1" class="col-sm-2"> Email</label>
                <div class="col-sm-8">
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nhập Email" name="email" value="<?php echo $editadmin['email'] ?>">
                    <!--nếu tồn tại mảng lỗi error in lỗi tại vị trí-->
                    <?php if(isset($error['email'])): ?>
                    <p class="text-danger"><?php echo $error['email'];?></p>
                    <?php endif?>
                </div>
            </div>
            <div class="form-group">
                <label for="InputEmail1" class="col-sm-2">Phone</label>
                <div class="col-sm-8">
                    <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="+84" name="phone" value="<?php echo $editadmin['phone'] ?>">
                    <!--nếu tồn tại mảng lỗi error in lỗi tại vị trí-->
                    <?php if(isset($error['phone'])): ?>
                    <p class="text-danger"><?php echo $error['phone'];?></p>
                    <?php endif?>
                </div>
            </div>
            <div class="form-group">
                <label for="InputEmail1" class="col-sm-2">Password</label>
                <div class="col-sm-8">
                    <input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="**********" name="password">
                    <!--nếu tồn tại mảng lỗi error in lỗi tại vị trí-->
                    <?php if(isset($error['password'])): ?>
                    <p class="text-danger"><?php echo $error['password'];?></p>
                    <?php endif?>
                </div>
            </div>
            <div class="form-group">
                <label for="InputEmail1" class="col-sm-2">Nhập lại password</label>
                <div class="col-sm-8">
                    <input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="**********" name="re_password">
                    <!--nếu tồn tại mảng lỗi error in lỗi tại vị trí-->
                    <?php if(isset($error['re_password'])): ?>
                    <p class="text-danger"><?php echo $error['re_password'];?></p>
                    <?php endif?>
                </div>
            </div>
            <div class="form-group">
                <label for="InputEmail1" class="col-sm-2"> Địa chỉ </label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nhập địa chỉ" name="address" value="<?php echo $editadmin['address'] ?>">
                    <!--nếu tồn tại mảng lỗi error in lỗi tại vị trí-->
                    <?php if(isset($error['address'])): ?>
                    <p class="text-danger"><?php echo $error['address'];?></p>
                    <?php endif?>
                </div>
            </div>
            <div class="form-group">
                <label for="InputEmail1" class="col-sm-2"> Level </label>
                <div class="col-sm-8">
                    <select class="form-control" name="level">
                        <option value="1"<?php echo isset($editadmin['level']) && $editadmin['level']==1?"selected='selected'":'' ?>>CTV</option>
                        <option value="2"<?php echo isset($editadmin['level']) && $editadmin['level']==2?"selected='selected'":'' ?>>Admin</option>
                    </select>
                    <!--nếu tồn tại mảng lỗi error in lỗi tại vị trí-->
                    <?php if(isset($error['level'])): ?>
                    <p class="text-danger"><?php echo $error['level'];?></p>
                    <?php endif?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10"> 
                    <button type="submit" class="btn btn-primary">Cập nhật tài khoản</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- /.row -->
<?php include_once'../../../layouts/footer.php'?>
<?php 
    include'autoload/autoload.php';
    
    $id = intval($_SESSION['name_id']);
    
    
    $edituser = $db->fetchID("users", $id);
    if(empty($edituser))//nếu edit trống thực thi lệnh
    {
        $_SESSION['error']="Dữ liệu không tồn tại";
                header('location:users.php');//redirecAdmin chuyển về các trang
    }

    
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        $data=[
            "name" => postInput("name"),
            "email" => postInput("email"),
            "phone" => postInput("phone"),

            "address" => postInput("address"),
            "account" => postInput("account")
    ];
    
       $error = [];//khởi tạo mảng lỗi
        if(postInput('name')=='')
        {
            $error['name']="Bạn chưa nhập tên đăng nhập";
        }
        else
        {
            if(postInput('name')!=$edituser['name'])
            {
                $is_check=$db->fetchOne("users","name ='".$data['name']."' ");
            if($is_check != NULL)
            {
                $error['name']= "Tên đăng nhập đã tồn tại";
                
            }   
            }
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
        else{
            if(postInput('email')!=$edituser['email'])
            {
                $is_check=$db->fetchOne("users","email ='".$data['email']."' ");
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
        if(postInput('password')!=NULL && postInput('re_password')!=NULL)
        {
            $data['password'] = MD5(postInput("password"));
            if($data['password'] != MD5(postInput("re_password")))
                {
                    $error['password']= "Password không khớp";
                }
        }
        //nếu lỗi trống thực thi lệnh
        if(empty($error))
        {   //câu lênh cho upload file            
    
        //kiểm tra trùng tên
            
            //insert dữ liệu
            $id_update = $db->update("users",$data,array('id' =>$id ));
        if($id_update>0)
        {
            move_uploaded_file($file_tmp,$part.$file_name);
               $_SESSION['success']="Cập nhật thành công";
                 header('location:index.php');//redirecAdmin chuyển về các trang
                
        }
        else
        {
            $_SESSION['error']="Dữ liệu không thay đổi";
                 header('location:index.php');
        }
         
        }
         
        }
    
    
    ?>
<?php include'header.php'; ?>
<div class="col-md-9 bor" style="border-radius: 5px;">
    <section class="" style="margin-bottom: 13px; margin-top: 5px;">
        <h3 class="title-main" style="border-bottom: none;" ><a href=""> Thông tin thành viên</a> </h3>
    </section>
    <form class="form-horizontal" action="" method="POST">
        <div class="form-group" style="margin-top: 5px">
            <label class="control-label col-sm-2" for="name">Tên đăng nhập:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" placeholder="Nhập tên đăng nhập" name="name" value="<?php echo $edituser['name'] ?>">
                <?php if(isset($error['name'])): ?>
                <p class="text-danger"><?php echo $error['name'];?></p>
                <?php endif ?>
            </div>
        </div>
        <div class="form-group" style="margin-top: 5px">
            <label class="control-label col-sm-2" for="name">Họ tên khách hàng:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="account" placeholder="Nhập tên đăng nhập" name="account" value="<?php echo $edituser['account'] ?>">
                <?php if(isset($error['account'])): ?>
                <p class="text-danger"><?php echo $error['account'];?></p>
                <?php endif ?>
            </div>
        </div>
        <div class="form-group" style="margin-top: 5px">
            <label class="control-label col-sm-2" for="pwd">Đổi mật khẩu:</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="pwd" placeholder="Nhập mật khẩu" name="password"  >
                <?php if(isset($error['password'])): ?>
                <p class="text-danger"><?php echo $error['password'];?></p>
                <?php endif ?>
            </div>
        </div>
        <div class="form-group" style="margin-top: 5px;">
            <label class="control-label col-sm-2" for="pwd" style="padding-top: 0;">Nhập lại mật khẩu:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="pwd" placeholder="Nhập lại mật khẩu" name="re_password">
                <?php if(isset($error['re_password'])): ?>
                <p class="text-danger"><?php echo $error['re_password'];?></p>
                <?php endif ?>
            </div>
        </div>
        <div class="form-group" style="margin-top: -10px">
            <label class="control-label col-sm-2" for="email">Email:</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" id="email" placeholder="Nhập email" name="email"value="<?php echo $edituser['email'] ?>">
                <?php if(isset($error['email'])): ?>
                <p class="text-danger"><?php echo $error['email'];?></p>
                <?php endif ?>
            </div>
        </div>
        <div class="form-group" style="margin-top: 5px">
            <label class="control-label col-sm-2" for="phone">Số điện thoại:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="phone" placeholder="Nhập số điện thoại" name="phone" value="<?php echo $edituser['phone'] ?>">
                <?php if(isset($error['phone'])): ?>
                <p class="text-danger"><?php echo $error['phone'];?></p>
                <?php endif ?>
            </div>
        </div>
        <div class="form-group" style="margin-top: 5px">
            <label class="control-label col-sm-2" for="address">Địa chỉ:</label>
            <div class="col-sm-10">
                <input type="address" class="form-control" id="address" placeholder="Nhận địa chỉ" name="address"value="<?php echo $edituser['address'] ?>">
                <?php if(isset($error['address'])): ?>
                <p class="text-danger"><?php echo $error['address'];?></p>
                <?php endif ?>
            </div>
        </div>
        <div class="form-group" style="margin-top: 5px; margin-bottom: 10px;">
            <div class="col-sm-offset-10 col-sm-3">
                <button type="submit" class="btn btn-primary">Cập nhật</button>
            </div>
        </div>
    </form>
</div>
<?php include'footer.php'; ?>
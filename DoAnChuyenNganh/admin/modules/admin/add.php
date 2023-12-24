<?php 
    $open="admin";
    //include_once'../../libraries/connect.php';
    include_once'../../autoload/autoload.php';
    $data=
        [
            "name" => postInput("name"),
            "email" => postInput("email"),
            "phone" => postInput("phone"),
            "address" => postInput("address"),
            "password" => MD5(postInput("password")),
            "level" => postInput("level"),
            "account" => postInput("account") 
        ];
    if($_SERVER['REQUEST_METHOD'] == "POST")

    {   //Khai báo mảng data từ dtbase.php hàm insert
        
        $error = [];//khởi tạo mảng lỗi
        if(postInput('name')=='')
        {
            $error['name']="Mời bạn nhập tên tài khoản";
        }
        else
        {
            $isset = $db->fetchOne("admin","name = '".$data['name']."' " );
            if(count($isset) !=NULL)
            {
                $error['name'] = "Tên tài khoản đã tồn tại";
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
            $is_check=$db->fetchOne("admin","email ='".$data['email']."' ");
            if($is_check != NULL)
            {
                $error['email']= "Email đã tồn tại";
            }
        }
        if(postInput('address')=='')
        {
            $error['address']= "Bạn chưa nhập địa chỉ";
        }
         if(postInput('password')=='')
        {
             $error['password']= "Bạn chưa nhập password";
        }
        if($data['password'] != MD5(postInput("re_password")))
        {
            $error['password']= "Password không khớp";
        }
        //nếu lỗi trống thực thi lệnh
        if(empty($error))
        {   //câu lênh cho upload file            
    
        //kiểm tra trùng tên
            
            //insert dữ liệu
            $id_insert =$db->insert("admin",$data);
            if($id_insert > 0 )
            {   //đưa dữ liệu đường dẫn file uploads
                $_SESSION['success']="Thêm mới thành công";
                redirectAdmin("admin");//redirecAdmin chuyển về các trang
            }
            else
            {
                //THêm thất bại
    
                $_SESSION['error']="Thêm mới thất bại";
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
                <i class="fa fa-dashboard"></i>  <a href="index.html">Danh sách tài khoản</a>
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
        <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="InputEmail1" class="col-sm-2"> Tài khoản </label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nhập tên tài khoản" name="name" value="<?php echo $data['name'] ?>">
                    <!--nếu tồn tại mảng lỗi error in lỗi tại vị trí-->
                    <?php if(isset($error['name'])): ?>
                    <p class="text-danger"><?php echo $error['name'];?></p>
                    <?php endif?>
                </div>
            </div>
            <div class="form-group">
                <label for="InputEmail1" class="col-sm-2"> Họ và tên </label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nhập họ tên của bạn" name="account" value="<?php echo $data['account'] ?>">
                    <!--nếu tồn tại mảng lỗi error in lỗi tại vị trí-->
                    <?php if(isset($error['account'])): ?>
                    <p class="text-danger"><?php echo $error['account'];?></p>
                    <?php endif?>
                </div>
            </div>
            <div class="form-group">
                <label for="InputEmail1" class="col-sm-2"> Email</label>
                <div class="col-sm-8">
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nhập Email" name="email" value="<?php echo $data['email'] ?>">
                    <!--nếu tồn tại mảng lỗi error in lỗi tại vị trí-->
                    <?php if(isset($error['email'])): ?>
                    <p class="text-danger"><?php echo $error['email'];?></p>
                    <?php endif?>
                </div>
            </div>
            <div class="form-group">
                <label for="InputEmail1" class="col-sm-2">Số điện thoại</label>
                <div class="col-sm-8">
                    <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="+84" name="phone" value="<?php echo $data['phone'] ?>">
                    <!--nếu tồn tại mảng lỗi error in lỗi tại vị trí-->
                    <?php if(isset($error['phone'])): ?>
                    <p class="text-danger"><?php echo $error['phone'];?></p>
                    <?php endif?>
                </div>
            </div>
            <div class="form-group">
                <label for="InputEmail1" class="col-sm-2">Password</label>
                <div class="col-sm-8">
                    <input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="**********" name="password" required="">
                    <!--nếu tồn tại mảng lỗi error in lỗi tại vị trí-->
                    <?php if(isset($error['password'])): ?>
                    <p class="text-danger"><?php echo $error['password'];?></p>
                    <?php endif?>
                </div>
            </div>
            <div class="form-group">
                <label for="InputEmail1" class="col-sm-2">Nhập lại password</label>
                <div class="col-sm-8">
                    <input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="**********" name="re_password" required="">
                    <!--nếu tồn tại mảng lỗi error in lỗi tại vị trí-->
                    <?php if(isset($error['re_password'])): ?>
                    <p class="text-danger"><?php echo $error['re_password'];?></p>
                    <?php endif?>
                </div>
            </div>
            <div class="form-group">
                <label for="InputEmail1" class="col-sm-2"> Địa chỉ </label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nhập địa chỉ" name="address" value="<?php echo $data['address'] ?>">
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
                        <option value="1"<?php echo isset($data['level']) && $data['level']==1?"selected='selected'":'' ?>>CTV</option>
                        <option value="2"<?php echo isset($data['level']) && $data['level']==2?"selected='selected'":'' ?>>Admin</option>
                    </select>
                    <!--nếu tồn tại mảng lỗi error in lỗi tại vị trí-->
                    <?php if(isset($error['level'])): ?>
                    <p class="text-danger"><?php echo $error['level'];?></p>
                    <?php endif?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10"> 
                    <button type="submit" class="btn btn-primary">Tạo tài khoản</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- /.row -->
<?php include_once'../../../layouts/footer.php'?>
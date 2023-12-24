<?php 
    include'autoload/autoload.php';
    include('PHPMailer/class.smtp.php');//gọi thư viện gửi mail
    include "PHPMailer/class.phpmailer.php";//gọi thư viện gửi mail

    //$a = "SELECT * FROM devvn_tinhthanhpho WHERE matp = "
    if(isset($_SESSION['name_id']))
    {
        echo "<script>alert('Bạn đang đăng nhập, thoát khỏi tài khoản để được đăng ký mới !!'); location=' index.php'</script> ";
    }
    
    
    $data=[
            "name" => postInput("name"),
            "email" => postInput("email"),
            "phone" => postInput("phone"),
            "address" => postInput("address"),
            "password" => MD5(postInput("password")),
            "account" => postInput("account")
    ];
    
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
       $error = [];//khởi tạo mảng lỗi
        
        if(postInput('name')=='')
        {
            $error['name']="Bạn chưa nhập tên đăng nhập";
        }
        else
        {
            $isset = $db->fetchOne("users","name = '".$data['name']."' " );
            if($isset !=NULL)
            {
                $error['name'] = "Tên tài khoản đã tồn tại";
            }
        }
        

        if(postInput('password')=='')
        {
             $error['password']= "Bạn chưa nhập password";
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
            $is_check=$db->fetchOne("users","email ='".$data['email']."' ");
            if($is_check != NULL)
            {
                $error['email']= "Email đã tồn tại";
            }
        }
        if(postInput('address')=='')
        {
            $error['address']= "Bạn chưa nhập địa chỉ";
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
            $id_insert =$db->insert("users",$data);

            if($id_insert > 0 )
            {   //Đăng ký
                $_SESSION['success']="Đăng ký thành công, mời bạn đăng nhập !!!";
                 //Gửi mail đơn hàng thành công 
                $title = 'Xác nhận đăng ký';
                $content = 'Xin chào khách hàng '.$data['name'].'.Bạn đã đăng ký thành công!';
                $nTo = $data['name'];
                $mTo =  $data['email'];
                $diachicc =  $data['email'];
                //sendMail từ lớp function
                $mail = sendMail($title, $content, $nTo, $mTo,$diachicc='');
                if($mail!=1)
                header('location: dang-nhap.php');//redirecAdmin chuyển về các trang
                else echo 'Cảm ơn bạn đã đăng kí sử dụng website của chúng tôi!';
                
            }
            else
            {
                //THêm thất bại
    
                $_SESSION['error']="Đăng ký thất bại";
            }
         
        }
    }
    
    ?>
<?php include'header.php'; ?>
<div class="col-md-9 bor" style="border-radius: 5px;">
    <section class="" style="margin-bottom: 13px; margin-top: 5px;">
        <h3 class="title-main" style="border-bottom: none;" ><a href=""> Đăng ký thành viên</a> </h3>
    </section>
    <form class="form-horizontal" action="" method="POST">
        <div class="form-group" style="margin-top: 20px">
            <label class="control-label col-sm-2" for="name">Họ Tên:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="account" placeholder="Nhập họ tên khách hàng" name="account" value="<?php echo $data['account'] ?>">
                <?php if(isset($error['account'])): ?>
                <p class="text-danger"><?php echo $error['account'];?></p>
                <?php endif ?>
            </div>
        </div>
        <div class="form-group" style="margin-top: 20px">
            <label class="control-label col-sm-2" for="name">Tên đăng nhập:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" placeholder="Nhập tên đăng nhập" name="name" value="<?php echo $data['name'] ?>">
                <?php if(isset($error['name'])): ?>
                <p class="text-danger"><?php echo $error['name'];?></p>
                <?php endif ?>
            </div>
        </div>
        <div class="form-group" style="margin-top: 20px">
            <label class="control-label col-sm-2" for="pwd">Mật khẩu:</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="pwd" placeholder="Nhập mật khẩu" name="password" required="" >
                <?php if(isset($error['password'])): ?>
                <p class="text-danger"><?php echo $error['password'];?></p>
                <?php endif ?>
            </div>
        </div>
        <div class="form-group" style="margin-top: 20px;">
            <label class="control-label col-sm-2" for="pwd" style="padding-top: 0;">Nhập lại mật khẩu:</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="pwd" placeholder="Nhập lại mật khẩu" name="re_password" required="">
                <?php if(isset($error['re_password'])): ?>
                <p class="text-danger"><?php echo $error['re_password'];?></p>
                <?php endif ?>
            </div>
        </div>
        <div class="form-group" style="margin-top: 20px">
            <label class="control-label col-sm-2" for="email">Email:</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" id="email" placeholder="Nhập email" name="email"value="<?php echo $data['email'] ?>">
                <?php if(isset($error['email'])): ?>
                <p class="text-danger"><?php echo $error['email'];?></p>
                <?php endif ?>
            </div>
        </div>
        <div class="form-group" style="margin-top: 20px">
            <label class="control-label col-sm-2" for="phone">Số điện thoại:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="phone" placeholder="Nhập số điện thoại" name="phone" value="<?php echo $data['phone'] ?>">
                <?php if(isset($error['phone'])): ?>
                <p class="text-danger"><?php echo $error['phone'];?></p>
                <?php endif ?>
            </div>
        </div>
        <div class="form-group" style="margin-top: 20px">
            <label class="control-label col-sm-2" for="address">Địa chỉ:</label>
            <div class="col-sm-10">
                <input type="address" class="form-control" id="address" placeholder="Nhận địa chỉ" name="address"value="<?php echo $data['address'] ?>">
                <?php if(isset($error['address'])): ?>
                <p class="text-danger"><?php echo $error['address'];?></p>
                <?php endif ?>
            </div>
            
        </div>
        <div class="form-group" style="margin-top: 30px; margin-bottom: 20px;">
            <div class="col-sm-offset-10 col-sm-3">
                <button type="submit" class="btn btn-primary">Đăng ký</button>
            </div>
        </div>
    </form>
</div>
<?php include'footer.php'; ?>
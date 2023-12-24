<?php 
include'autoload/autoload.php';
// include('PHPMailer-5.2.26/class.smtp.php');//gọi thư viện gửi mail
// include "PHPMailer-5.2.26/class.phpmailer.php";//gọi thư viện gửi mail
$em = $db->fetchAll("users");


$data['email'] = postInput('email');
$data['token'] = rand_string( 10 );
if($_SERVER["REQUEST_METHOD"]=="POST")
        {
        	$error=[];
        	$is_check=$db->fetchOne("users","email ='".$data['email']."' ");
            if($is_check != NULL)
            {
                
               $title = 'Yêu cầu mật khẩu';
                $content = 'Xin chào, yêu cầu lấy lại mật khẩu đã được thực hiện. Coppy mã này vào để được đổi mật khẩu!'. $data['token'];
                $nTo = $data['email'];
                $mTo =  $data['email'];
                $diachicc =  $data['email'];
                //sendMail từ lớp function
                $mail = sendMail($title, $content, $nTo, $mTo,$diachicc='');
                if($mail!=1)
                
                echo 'Co loi!';
            }

            else
	        {
	            $error['email']="Email không tồn tại";
	        }
	        //update dữ liệu
	        $id_update = $db->update("users",$data,array('email' =>$data['email'] ));
	        if($id_update!=NULL)
	        {
	            
	                $_SESSION['success']="Email đã được gửi, vui lòng kiểm tra hộp thư đến";
	                header('location: check-token.php');//redirecAdmin chuyển về các trang
	        }
	        else
	        {
	            $_SESSION['error']="Thất bại";
	                header('location: dang-nhap.php');
	        }
        }
        
       



include'header.php';

 ?>

<div class="col-md-9 bor" style="border-radius: 5px;padding-bottom: 40px;">
    <section class="" style="margin-bottom: 13px; margin-top: 5px;">
        <h3 class="title-main" style="border-bottom: none;" ><a href=""> Quên mật khẩu</a> </h3>
    </section>
    
    <form class="form-horizontal" action="" method="POST">
    <div class="form-group" style="margin-top: 20px">
        <label class="control-label col-sm-4" for="email">Địa chỉ email: </label>
        <div class="col-sm-5" style="padding-left:0px">
            <input type="email" class="form-control" id="email" placeholder="Nhập địa chỉ email của bạn" name="email" >
            <?php if(isset($error['email'])): ?>
            <p class="text-danger"><?php echo $error['email'];?></p>
            <?php endif ?>
        </div>
    </div>
    <div class="form-group" style="margin-top: 25px; margin-bottom: 20px;">
        <div class="col-sm-offset-7 col-sm-3">
            <button type="submit" class="btn btn-primary">Xác nhận</button>
        </div>
    </div>
</div>

 <?php include'footer.php'; ?>
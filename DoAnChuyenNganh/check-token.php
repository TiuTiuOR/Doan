<?php 
include'autoload/autoload.php';
include('PHPMailer-5.2.26/class.smtp.php');//gọi thư viện gửi mail
include "PHPMailer-5.2.26/class.phpmailer.php";//gọi thư viện gửi mail
$a = $db->fetchAll("users");

$data['token'] = postInput('token');
if($_SERVER["REQUEST_METHOD"]=="POST")
        {
            $error=[];
            if(postInput('token')=='')
                {
                    $error['token']="Bạn chưa nhập mã xác nhận";
                }
            else{
                $is_check=$db->fetchOne("users","token ='".$data['token']."' ");
               
                if($is_check != NULL)
                {
                     header('location: doimk.php?id='.$is_check['id']);
                }

                else
                {
                    $error['token']="Token không tồi tại";
                }
                //update dữ liệu
                }
        }
        
     include 'header.php';  
 ?>

<div class="col-md-9 bor" style="border-radius: 5px;padding-bottom: 40px;">
    <section class="" style="margin-bottom: 13px; margin-top: 5px;">
        <h3 class="title-main" style="border-bottom: none;" ><a href=""> Quá trình kiểm tra</a> </h3>
    </section>
    
    <form class="form-horizontal" action="" method="POST">
    <div class="form-group" style="margin-top: 20px">
        <label class="control-label col-sm-4" for="token">Nhập mã xác nhận: </label>
        <div class="col-sm-5" style="padding-left:0px">
            <input type="text" class="form-control" id="token" placeholder="Nhập mã xác nhận email của bạn" name="token" >
            <?php if(isset($error['token'])): ?>
            <p class="text-danger"><?php echo $error['token'];?></p>
            <?php endif ?>
        </div>
    </div>
    <div class="form-group" style="margin-top: 25px; margin-bottom: 20px;">
        <div class="col-sm-offset-7 col-sm-3">
            <button type="submit" class="btn btn-primary">Xác nhận</button>
        </div>
    </div>
    </form>
</div>

<?php include'footer.php'; ?>
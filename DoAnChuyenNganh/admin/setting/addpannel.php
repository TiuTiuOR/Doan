<?php 
$open="setting";
    include_once'../autoload/autoload.php';
if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        $data=
        [
            
            "panel"=>postInput("panel")
            
        ];

        if(isset($_FILES['panel']))
            {
                $file_name = $_FILES['panel']['name'];
                $file_tmp = $_FILES['panel']['tmp_name'];
                $file_type = $_FILES['panel']['type'];
                $file_erro = $_FILES['panel']['error'];
    
                if($file_erro==0)
                {
                    $part = ROOT."product/";
                    $data['panel']=$file_name;
                }
            }

            $insert = $db->insert("panel",$data,array('id' =>$id ));
            if($insert>0)
            {
            move_uploaded_file($file_tmp,$part.$file_name);
                $_SESSION['success']="Cập nhật thành công";
                redirectTrans("setting/pannel.php");//redirecAdmin chuyển về các trang
            }
            else
            {
            $_SESSION['error']="Cập nhật thất bại";
                redirectTrans("setting/pannel.php");
            }
    }
include_once'../../layouts/header.php';
?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
           Thêm pannel
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-cogs"></i> <a href="pannel.php">pannel</a>
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
            <div class="col-lg-12"style="margin-top: 10px">
            <label for="InputEmail1" style="padding-left: 0" class="col-sm-2" >Thêm pannel</label>
                <div class="col-sm-4">
                  <input type='file'  class='form-control' id='exampleInputEmail1' name='panel' >
                    <!--nếu tồn tại mảng lỗi error in lỗi tại vị trí-->
                    <?php if(isset($error['panel'])): ?>
                    <p class="text-danger"><?php echo $error['panel1'];?></p>
                    <?php endif?>
                </div>
               </div>
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
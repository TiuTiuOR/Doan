<?php
include'../autoload/autoload.php';
$open="setting";


$id = intval(getInput('id'));
$editpannel = $db->fetchID('panel', $id);


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
            $update = $db->update("panel",$data,array('id' =>$id ));
            if($update>0)
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
    

include'../../layouts/header.php';
?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
           Chỉnh sửa pannel
        </h1>
        <ol class="breadcrumb">
            <li>
               <i class="fa fa-cogs"></i> <a href="pannel.php">pannel</a>
            </li>
            <li class="active">
                <i class="fa fa-cogs"></i> chỉnh sửa pannel
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
                    <img style="margin-top: 10px" src="<?php echo uploads() ?>product/<?php echo $editpannel['panel'] ?>"width='80px' height="80px"></td>
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
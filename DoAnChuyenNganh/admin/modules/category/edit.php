<?php 
    $open="category";
    include_once'../../autoload/autoload.php';
    $product=$db->fetchAll('page');
    $id=intval(getInput('id'));
    
    //Lấy id trong bảng qua hàm fetchID
    $editCategory = $db->fetchID("category",$id);
    if(empty($editCategory))//nếu edit trống thực thi lệnh
    {
        $_SESSION['error']="Dữ liệu không tồn tại";
                redirectAdmin("category");//redirecAdmin chuyển về các trang
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
      //Khai báo mảng data từ dtbase.php hàm insert
        $data=
        [
            "name" => postInput("name"),
            "slug" => to_slug(postInput("name")),
            "page_id" => postInput("page_id")
        ];
        $error = [];//khởi tạo mảng lỗi
        if(postInput('name')=='')
        {
            $error['name']="Mời bạn nhập tên danh mục";
        }
        //nếu lỗi trống thực thi lệnh
        if(empty($error))
        {   //kiểm tra tên của cái edit mà không trùng với tên đăng ký thì thực thi
            if($editCategory['name']!=$data['name']) 
            {
                    $isset=$db->fetchOne("category","name='".$data['name']."' ");
                if(count($isset) > 0)
                {
                    $_SESSION['error'] = "Tên danh mục đã tồn tại";
                }
                else
                {
                //update dữ liệu
                    $id_update =$db->update("category",$data,array("id"=>$id));
                    if($id_update > 0 )
                    {
                        $_SESSION['success']="Cập nhật thành công";
                        redirectAdmin("category");//redirecAdmin chuyển về các trang
                    }
                    else
                    {
                        //THêm thất bại
                        $_SESSION['error']="Dữ liệu không thay đổi";
                        redirectAdmin("category");
                    }
                }
            }
            else
            {//cập nhật dữ liệu
                $id_update =$db->update("category",$data,array("id"=>$id));
                    if($id_update > 0 )
                    {
                        $_SESSION['success']="Cập nhật thành công";
                        redirectAdmin("category");//redirecAdmin chuyển về các trang
                    }
                    else
                    {
                        //THêm thất bại
                        $_SESSION['error']="Dữ liệu không thay đổi";
                        redirectAdmin("category");
                    }
            }
            
        }
    
    }
    
    
        ?>
<?php include_once'../../../layouts/header.php'?> 
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Chỉnh sửa danh mục
        </h1>
        <?php if(isset($name)){ echo $name;}?>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i>  <a href="index.html">Danh mục</a>
            </li>
            <li class="active">
                <i class="fa fa-file"></i> Chỉnh sửa
            </li>
        </ol>
        <div class="clearfix"></div>
        <?php include_once'../../../partials/notification.php'; ?>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <form class="form-horizontal" action="" method="POST"enctype="multipart/form-data">
            <div class="form-group">
                <label for="InputEmail1" class="col-sm-2"> Trang</label>
                <div class="col-sm-8">
                    <select class="form-control col-sm-8" name="page_id">
                        <option value="">- Mời bạn trang -</option>
                        <?php //duyệt qua các phần tử trong mảng category để in ra các danh sách
                            foreach ($product as $num):?>
                        <option value="<?php echo $num['id']  ?>" <?php echo $editCategory['page_id']==$num['id']?"selected = 'selected'" : '' ?>><?php echo $num['name']?></option>
                        <?php endforeach                        
                            ?>
                    </select>
                    <!--nếu tồn tại mảng lỗi error in lỗi tại vị trí-->
                    <?php if(isset($error['page_id'])): ?>
                    <p class="text-danger"><?php echo $error['page_id'];?></p>
                    <?php endif?>
                </div>
            </div>
            <div class="form-group">
                <label for="InputEmail1" class="col-sm-2"> Tên danh mục</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nhập tên danh mục" name="name" value="<?php echo $editCategory['name'] ?>">
                    <!--nếu tồn tại mảng lỗi error in lỗi tại vị trí-->
                    <?php if(isset($error['name'])): ?>
                    <p class="text-danger"><?php echo $error['name'];?></p>
                    <?php endif?>
                </div>
            </div>
            <div class="form-group">
                <label for="InputEmail1" class="col-sm-2"> Hình ảnh</label>
                <div class="col-sm-3">
                    <input type="file" class="form-control" id="exampleInputEmail1" name="images" >
                    <!--nếu tồn tại mảng lỗi error in lỗi tại vị trí-->
                    <?php if(isset($error['images'])): ?>
                    <p class="text-danger"><?php echo $error['images'];?></p>
                    <?php endif?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- /.row -->
<?php include_once'../../../layouts/footer.php'?>
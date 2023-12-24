<?php 
    $open="category";
    //include_once'../../libraries/connect.php';
    include_once'../../autoload/autoload.php';
    $product=$db->fetchAll('page');//khai báo page
    $data=
        [
            "name" => postInput("name"),
            "slug" => to_slug(postInput("name")),
             "page_id" => postInput("page_id")

        ];
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {   //Khai báo mảng data từ dtbase.php hàm insert
        
        $error = [];//khởi tạo mảng lỗi
        if(postInput('name')=='')
        {
            $error['name']="Mời bạn nhập tên danh mục";
        }
        if(!isset($_FILES['images']))
        {
             $error['images']= "Bạn chưa upload file ảnh";
        }
        //nếu lỗi trống thực thi lệnh
        if(empty($error))
        {//kiểm tra trùng tên
            if(isset($_FILES['images']))
            {
                $file_name = $_FILES['images']['name'];
                $file_tmp = $_FILES['images']['tmp_name'];
                $file_type = $_FILES['images']['type'];
                $file_erro = $_FILES['images']['error'];
    
                if($file_erro==0)
                {
                    $part = ROOT."product/";
                    $data['images']=$file_name;
                }
                
            }
            $isset = $db->fetchOne("category","name = '".$data['name']."' " );
            if(count($isset) > 0)
            {
                $_SESSION['error'] = "Tên danh mục đã tồn tại";
            }
         else
         {
            //insert dữ liệu
            $id_insert =$db->insert("category",$data);
            if($id_insert > 0 )
            {
                move_uploaded_file($file_tmp,$part.$file_name);
                $_SESSION['success']="Thêm mới thành công";
                redirectAdmin("category");//redirecAdmin chuyển về các trang
            }
            else
            {
                //THêm thất bại
                $_SESSION['error']="Thêm mới thất bại";
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
            Thêm mới danh mục
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i>  <a href="index.html">Danh mục</a>
            </li>
            <li class="active">
                <i class="fa fa-file"></i> Thêm mới
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
                        <option value="">- Mời bạn chọn trang -</option>
                        <?php //duyệt qua các phần tử trong mảng category để in ra các danh sách
                            foreach ($product as $num):?>
                        <option value="<?php echo $num['id']  ?>"><?php echo $num['name']?></option>
                        <?php endforeach                        
                            ?>
                    </select>
                    <!--nếu tồn tại mảng lỗi error in lỗi tại vị trí-->
                    <?php if(isset($error['category_id'])): ?>
                    <p class="text-danger"><?php echo $error['category_id'];?></p>
                    <?php endif?>
                </div>
            </div>
            <div class="form-group">
                <label for="InputEmail1" class="col-sm-2"> Tên danh mục</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nhập tên danh mục" name="name">
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
                    <button type="submit" class="btn btn-primary">Thêm mới</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- /.row -->
<?php include_once'../../../layouts/footer.php'?>
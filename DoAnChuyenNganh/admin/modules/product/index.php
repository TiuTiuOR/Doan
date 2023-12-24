<?php include_once'../../autoload/autoload.php'; 
    $open="product";
    $product = $db->fetchAll("product");
    //$sql=" SELECT * FROM product ORDER BY id DESC ";
    ?>
    
<?php 
    if(isset($_GET['page']))
        {
            $p=$_GET['page'];
        }
        else{
            $p=1;
        }
    
        //Truy vấn lấy tên danh mục
        $sql = "SELECT product.*,category.name as namecate FROM product LEFT JOIN category on product.category_id = category.id ORDER BY id DESC";
        $product = $db->fetchJone('product',$sql,$p,5,true);
        if(isset($product['page']))
        {
            $sotrang=$product['page'];
            unset($product['page']);
        }
     ?>
<?php include_once'../../../layouts/header.php'?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Danh sách sản phẩm <a href="add.php" class="btn btn-info">Thêm mới</a>
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i>  <a href="../../index.php"> Bảng điều khiển</a>
            </li>
            <li class="active">
                <i class="fa fa-file"></i> Sản phẩm
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
<!-- /.row -->

<div class="col-sm-8">
    <form class="navbar-form navbar-right" action="../search/index.php" method="GET">
        <div class="input-group" style="width: 660px;">
        <input type="text" class="form-control" style="border-radius: 5px" name="search" placeholder="Tìm kiếm sản phẩm">
        <div class="input-group-btn" style ="width:40px">
            <button class="btn btn-default" style="background: #80ac7b; padding-bottom: 3px; padding-left: 20px" type="submit">
            <i class="glyphicon glyphicon-search" style="padding-right: 10px; color: #fff "></i>
            </button>
        </div>
        </div>
    </form>
</div>

<div class="row">
    <div class="col-md-12">
        <h2>Bảng sản phẩm</h2>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên sản phẩm</th>
                        <th>Danh mục</th>
                        <th>Slug</th>
                        <th>Hình ảnh</th>
                        <th>Mô tả</th>
                        <th>Tình trạng</th>
                        <th>Chỉnh sửa</th>
                        <th>Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    <?php //in danh sách 
                        foreach ($product as $row) { 
                           
                           ?>
                    <tr>
                        <td><?php echo $row['id'];?></td>
                        <td><?php echo $row['name'];?></td>
                        <td><?php echo $row['namecate'];?></td>
                        <td><?php echo $row['slug'];?></td>
                        <td><img src="<?php echo uploads() ?>product/<?php echo $row['thumbal'] ?>"width='80px' height="80px"></td>
                        <td><?php echo $row['content'];?></td>
                        <td>
                            <ul>
                                <li>Giá: <?php echo formatprice($row['price']);?></li>
                                <li>Số lượng: <?php echo $row['number'];?></li>
                                <li>Giảm giá: <?php echo $row['sale'];?>%</li>
                                <li>Giá đã giảm: <?php echo saleprice($row['price'],$row['sale']) ?></li>
                            </ul>
                        </td>
                        <td align="center";><a href="edit.php?id=<?php echo $row['id'];?>"><img width="20" src="../../../image/update.png"></a></td>
                        <td align="center";>
                            <a href="delete.php?id=<?php echo $row['id'];?>" onclick="return confirm('Bạn thực sự muốn xóa nó?');">
                                <img width="20" src="../../../image/Delete.png">
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <div class="pull-right">
                <nav aria-label="page navigation">
                    <ul class="pagination">
                        <li class="page-item">
                            <!--Phân trang-->
                            <a class="page-link" href="?page=<?php echo $p-1==0? 1:$p-1 ?>" tabindex="-1">Previous</a>
                        </li>
                        <?php for ($i=1; $i <= $sotrang ; $i++):?>
                        <li class="<?php echo ($i==$p) ? $active :'' ?>"><a href="?page=<?php echo $i;?>"><?php echo $i;?></a></li>
                        <?php endfor ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?php echo $p+1<$i?$p+1:$p ?>">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
<?php include_once'../../../layouts/footer.php'?>
<?php include_once'../autoload/autoload.php'; 
$open="manager";
    
$num=1;
    if(isset($_GET['page']))
        {
            $p=$_GET['page'];
        }
        else{
            $p=1;
        }
    
       //truy vấn lấy dữ liệu sản phẩm
       $sql = "SELECT * FROM product WHERE number <10 ORDER BY id DESC";
       $product = $db->fetchsql($sql);
       $total = count($db->fetchsql($sql));
        $product = $db->fetchJones('product',$sql,$total,$p,3,true);
        if(isset($product['page']))
        {
            $sotrang=$product['page'];
            unset($product['page']);
        }

?>
<?php include_once'../../layouts/header.php'?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Danh sách sản phẩm sắp hết
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i>  <a href="../../index.php"> Bảng điều khiển</a>
            </li>
            <li class="active">
                <i class="fa fa-file"></i> Quản lý kho
            </li>
            <li class="active">
                <i class="fa fa-file"></i> Sản phẩm sắp hết
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
<div class="row">
    <div class="col-md-12">
        <h3>Số lượng: <?php echo $total ?> sản phẩm</h3>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên sản phẩm</th>
                        <th>Danh mục</th>
                        <th>Hình ảnh</th>
                        <th>Mô tả</th>
                        <th>Tình trạng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php //in danh sách 
                        foreach ($product as $row):?>
                            <?php
                            //lấy id danh mục 
                            $id = intval($row['category_id']);
                            //lấy dữ liệu từ danh mục
                            $getdl=$db->fetchID("category",$id);
                             ?>
                    <tr>
                        <td><?php echo $num;?></td>
                        <td><?php echo $row['name'];?></td>
                        <td><?php echo $getdl['name'];?></td>
                        <td><img src="<?php echo uploads() ?>product/<?php echo $row['thumbal'] ?>"width='80px' height="80px"></td>
                       <td>
                            <ul>
                                <li><b>Chế độ bảo hành:</b> 12 tháng</li>
                                <li><b>Khuyến mãi:</b> </li>
                                <li><b>Giảm giá:</b> <?php echo $row['sale'];?>%</li>
                                <li><b>Trạng thái:</b> <span class="label  <?php echo $row[$number] > 0 ? 'label-primary' : 'label-danger' ?>"><?php echo $row['number'] > 0 ? 'Còn hàng' : 'Hết hàng'; ?></span></li>
                            </ul>
                        </td>
                        <td>
                            <ul>
                                <li><b>Giá bán:</b> <?php echo formatprice($row['price']);?></li>
                                <li><b>Số lượng ban đầu:</b> <?php echo $row['number'] + $row['pay'];?> sản phẩm</li>
                                <li><b>Đã bán:</b> <?php echo $row['pay'];?> sản phẩm</li>
                                <li><b>Sản phẩm còn:</b><span class="label label-danger"><?php echo $row['number'] ?> sản phẩm</span></li>
                            </ul>
                        </td>
                        <?php $num++ ?>
                    </tr>
                <?php endforeach ?>
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
            <li class="<?php echo ($i==$p) ? 'active' :'' ?>"><a href="?page=<?php echo $i;?>"><?php echo $i;?></a></li>
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








<?php include_once'../../layouts/footer.php'?>
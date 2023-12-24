<?php include_once'../../autoload/autoload.php'; 
    $open="comment";
    $comment = $db->fetchAll("comment");
    //lấy dữ liệu của comment theo id
    $sql=" SELECT * FROM comment ORDER BY id DESC ";
    
    if(isset($_GET['page']))
    {
        $p=$_GET['page'];
    }
    else{
        $p=1;
    }
    
    $comment=$db->fetchJone('comment',$sql,$p,5,true);
    $sotrang = $comment['page'];
    unset($comment['page']);
    
    
    ?>
<?php include_once'../../../layouts/header.php'?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Danh sách comment <a href="add.php" class="btn btn-info">Thêm mới</a>
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i>  <a href="../../index.php"> Bảng điều khiển</a>
            </li>
            <li class="active">
                <i class="fa fa-file"></i> Bình luận
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
        <h2>Bảng thông tin</h2>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Mã bình luận</th>
                        <th>Nội dung</th>
                        <th>Mã users</th>
                        <th>Mã sản phẩm</th>
                 
                        <th>Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    <?php //in danh sách 
                        foreach ($comment as $row) { 
                           
                           ?>
                    <tr>
                        <td><?php echo $row['id'];?></td>
                        <td><?php echo $row['content'];?></td>
                        <td><?php echo $row['users_id'];?></td>
                        <td><?php echo $row['product_id'];?></td>
 
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
            <!--phân trang-->
            <a class="page-link" href="?page=<?php echo $p-1==0?1:$p-1 ?>" tabindex="-1">Previous</a>
            </li>
            <?php for ($i=1; $i <=$sotrang ; $i++):  ?>
            <li class="<?php ($p==$i)?$active:'' ?>"><a class="" href="?page=<?php echo $i ?>"><?php echo $i ?></a></li>
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
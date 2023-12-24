<?php include_once'../../autoload/autoload.php'; 
    $open="admin";
    $admin = $db->fetchAll("admin");
    //lấy dữ liệu của admin theo id
    $sql=" SELECT * FROM admin ORDER BY id DESC ";
    
    if(isset($_GET['page']))
    {
        $p=$_GET['page'];
    }
    else{
        $p=1;
    }

    $admin=$db->fetchJone('admin',$sql,$p,5,true);
    $sotrang = $admin['page'];
    unset($admin['page']);
    
    
    ?>
<?php include_once'../../../layouts/header.php'?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Danh sách Admin <a href="add.php" class="btn btn-info">Thêm mới</a>
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i>  <a href="../../../admin/"> Bảng điều khiển</a>
            </li> 
            <li class="active">
                <i class="fa fa-file"></i> Admin
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
                        <th>STT</th>
                        <th>Tài khoản</th>
                        <th>Họ tên</th>
                        <th>Email</th>
                        <th>Địa chỉ</th>
                        <th>Password</th>
                        <th>Phone</th>
                        <th>Level</th>
                        <th>Chỉnh sửa</th>
                        <th>Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    <?php //in danh sách 
                        foreach ($admin as $row) { 
                           
                           ?>
                    <tr>
                        <td><?php echo $row['id'];?></td>
                        <td><?php echo $row['name'];?></td>
                        <td><?php echo $row['account'];?></td>
                        <td><?php echo $row['email'];?></td>
                        <td><?php echo $row['address'];?></td>
                        <td><?php echo $row['password'];?></td>
                        <td><?php echo $row['phone'];?></td>
                        <td><?php echo $row['level'];?></td>
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
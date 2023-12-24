<?php 
include'../autoload/autoload.php';
$open="setting";
$a =1;
$pannel = $db->fetchAll("panel");
    
$sql=" SELECT * FROM panel ";

if(isset($_GET['page']))
    {
        $p=$_GET['page'];
    }
    else{
        $p=1;
    }
    
    $pannel=$db->fetchJone('panel',$sql,$p,5,true);
    $sotrang = $pannel['page'];
    unset($pannel['page']);
 ?>
 <?php include_once'../../layouts/header.php'?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Danh sách Pannel <a href="addpannel.php" class="btn btn-info">Thêm mới</a>
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i>  <a href="../index.php">Bảng điều khiển</a>
            </li>
            <li class="active">
                <i class="fa fa-file"></i> Cài đặt
            </li>
            <li class="active">
                <i class="fa fa-file"></i> Pannel
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
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Tên pannel</th>
                        <th>Ảnh</th>
                        <th>Tên ảnh</th>
                        <th>Sửa</th>
                        <th>Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    <?php //in danh sách 
                        foreach ($pannel as $row) { 
                           
                           ?>
                    <tr>
                        <td>Pannel <?php echo $a;?></td>
                        <td><img src="<?php echo uploads() ?>product/<?php echo $row['panel'] ?>"width='40px' height="40px"></td>
                        <td>Pannel <?php echo $row['panel'];?></td>
                        <td>             
                            <a href="editpannel.php?id=<?php echo $row['id'];?>" class="btn btn-xs btn-info" href="edit.php?id=<?php echo $row['id'];?>"><i class="fa fa-refresh" style="color: #fff;"></i>Chỉnh sửa</a>
                        </td>
                        <td>
                        	<a class="btn btn-xs btn-danger <?php echo $row['sum']==1?"disabled":'' ?>" href="dellpannel.php?id=<?php echo $row['id'];?>"><i class="fa fa-remove" style="color: #fff;"></i> Xóa</a>
                        </td>
                    </tr>

                    <?php $a++; } ?>
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


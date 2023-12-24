<?php include_once'../autoload/autoload.php'; 
    $open="transaction";
    $admin = $db->fetchAll("transaction");
    
    //truy vấn từ bảng transaction qua user để lấy thông tin người dùng
    $sql=" SELECT * FROM transaction WHERE status = 0 AND huy = 0 ORDER BY id DESC";
    $don = $db->fetchsql($sql);
    $totala = count($don);
    //phân trang
    if(isset($_GET['page']))
    {
        $p=$_GET['page'];
    }
    else{
        $p=1;
    }
    
    $don=$db->fetchJones('transaction',$sql,$totala,$p,5,true);
    if(isset($don['page']))
        {
            $sotrang=$don['page'];
            unset($don['page']);
        }
    
    $num =($p-1)*5+1;
    ?>
<?php include_once'../../layouts/header.php'?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Danh sách đơn hàng chưa xử lý
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i>  <a href="../index.php"> Bảng điều khiển</a>
            </li>
            <li>
                <i class="fa fa-file"></i> Đơn hàng
            </li>
            <li class="active">
                <i class="fa fa-file"></i> Đơn hàng chưa xử lý
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
                        <th>Khách hàng</th>
                        <th>Trạng thái</th>
                        <th>Thông tin liên hệ</th>
                        <th>Ghi chú</th>
                        <th>Giảm giá 5%</th>
                        <th>Tổng đơn hàng</th>

                        <th>Hủy đơn</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                <?php //in danh sách 
                        foreach($don as $row):?>
                            <?php 
                            $id = intval($row['users_id']);
                            $users = $db->fetchID("users",$id);
                             ?>
                    <tr>
                        <td><?php echo $num;?></td>
                        <td><?php echo $users['name'];?></td>
                        <td>
                            <?php if($row['done'] == 0): ?>
                            <a href="status.php?id=<?php echo $row['id'] ?>" class="btn btn-xs <?php echo $row['status']==0? 'btn-danger': 'btn-info' ?>"><?php echo $row['status'] == 0 ? 'Chưa xử lý':'Đã xử lý'; ?></a>
                            <?php else: ?>
                            <a href="status.php?id=<?php echo $row['id'] ?>" class="btn btn-xs <?php echo $row['status']==0? 'btn-danger disabled': 'btn-info' ?>"><?php echo $row['status'] == 0 ? 'Chưa xử lý':'Đã xử lý'; ?></a>
                            <?php endif ?>
                        </td>
                        <td>
                            <ul>
                                <li>Mã đơn: <?php echo $row['id'];?></li>
                                 <li>Họ tên: <?php echo $users['account'];?></li>
                                <li>Địa chỉ: <?php echo $users['address'];?></li>
                                <li>Số điện thoại: <?php echo $users['phone'];?></li>
                                <li>Email: <?php echo $users['email'];?></li>
                                <li>Thời gian: <?php echo $row['update_at'];?></li>
                            </ul>
                        </td>
                        <td><?php echo $row['note'];?></td>
                        <td><b><?php echo formatprice(($row['amount']/95*100)/20) ?></b></td>
                        <td><b style="color:red"><?php echo formatprice($row['amount']);?></b>
                            <p><?php echo $row['tructuyen']==1 ? 'Thanh toán trực tuyến':'' ?></p>
                        </td>
                        
                        <td>
                            <?php if($row['huy']==1) :?>
                            <a href="done.php?id=<?php echo $row['id'] ?>" class="btn btn-xs <?php echo $row['done']==0? 'btn-warning':'btn-primary'?>"><?php echo $row['done'] == 0? 'Người dùng hủy đơn':'Đã xác nhận'; ?></a>
                            <?php endif ?>
                        </td>
                        <td>
                            <a style="margin-top: 5px;" href="donhang.php?id=<?php echo $row['id'] ?>" class="btn btn-xs btn-info"><i class="fa fa-refresh" style="color: #fff;"></i> Chi tiết</a>
                            <a style="margin-top: 5px;" href="edit.php?id=<?php echo $row['id'] ?>" class="btn btn-xs btn-success"><i class="fa fa-refresh" style="color: #fff;"></i> Chỉnh sửa</a>
                            <a style="margin-top: 5px;" href="in.php?id=<?php echo $row['id'] ?>" class="btn btn-xs btn-success"><i class="fa fa-refresh" style="color: #fff;"></i> In hóa đơn</a>
                            <a style="margin-top: 5px;" class="btn btn-xs btn-danger" href="delete.php?id=<?php echo $row['id'];?>" onclick="return confirm('Bạn thực sự muốn xóa nó?');"><i class="fa fa-remove" style="color: #fff;"></i> Xóa</a>
                        </td>
                    </tr>
                    <?php $num++; endforeach ?>
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
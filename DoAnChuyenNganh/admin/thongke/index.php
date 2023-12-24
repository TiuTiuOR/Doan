<?php include_once'../autoload/autoload.php'; 
$open="thongke";
$admin = $db->fetchAll("transaction");

 
$sum = 0;
$don=0;
    //phân trang
    if(isset($_GET['page']))
    {
        $p=$_GET['page'];
    }
    else{
        $p=1;
    }
    //truy vấn dữ liệu với điều kiện status
    $sql = "SELECT * FROM transaction WHERE status = 1 ORDER BY id DESC";
    $sqli = "SELECT * FROM transaction WHERE  huy = 1 ORDER BY id DESC";
    //tổng số sản phẩm
    $total = count($db->fetchsql($sql));

    $tinhtong = $db->fetchsql($sql);
    $stt = count($db->fetchsql($sqli));
    // phân trang với điều kiện total
    $transaction=$db->fetchJones('transaction',$sql,$total,$p,5,true);
    
       $don = $total - $stt;

    $sotrang = $transaction['page'];
    //Hủy trang dư
    unset($transaction['page']); 
    $path = $_SERVER['SCRIPT_NAME']; //lấy tên server name hiện tại






?>


<?php include_once'../../layouts/header.php'?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Danh sách thanh toán
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i>  <a href="../index.php">Bảng điều khiển</a>
            </li>
            <li class="active">
                <i class="fa fa-file"></i> Danh sách thanh toán
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
<div class="col-lg-12">
    <div>
        <div class="">
            <h2><i class="fa fa-money fa-fw"></i> Thống kê thanh toán</h2>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Mã đơn</th>
                            <th>Tên khách hàng</th>
                            <th>Ngày</th>
                            <th>Chi tiết</th>
                            <th>Tổng tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            //duyệt dữ liệu transac
                             foreach ($transaction as $row):?>
                        <?php if(($row['status']==1 && $row['huy']==0)) : ?>
                        <?php
                            //lấy id user
                            $a = intval($row['users_id']);
                            //truy vấn dữ liệu user
                            $user =$db->fetchID("users",$a);
                            
                             ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $user['account'] ?></td>
                            <td><?php echo $row['update_at']  ?></td>
                            <td><a href="../transaction/dhdaxuly.php?id=<?php echo $row['id'] ?>" class="btn btn-xs btn-primary"><i class="fa fa-refresh" style="color: #fff;"></i> Chi tiết</a></td>
                            <td><?php echo formatprice($row['amount']) ?></td>
                        </tr>  
                        <?php endif ?>   
                        <?php endforeach ?> 
                    </tbody>   
                </table>   
            </div>     
            <table class="table table-bordered">
                <thead>
                    <tr >
                         <th style="text-align: right">Tổng đơn hàng:

                            <?php    echo $don ?>
                          
                        </th>

                        <th style="text-align: right">Tổng cộng:
                            <?php foreach ($tinhtong as $value):?>

                            <?php $sum =$sum+ $value['amount']?>
                            <?php endforeach ?>
                            <?php echo formatprice($sum) ?>
                        </th>
                    </tr>
                </thead>
            </table>
            <div class="pull-right">
                <nav aria-label="page navigation">
                    <ul class="pagination">
                        <li class="page-item">
                            <!--phân trang-->
                            <a class="page-link" href="<?php echo $path ?>?page=<?php echo $p-1==0?1:$p-1 ?>" tabindex="-1">Previous</a>
                        </li>
                        <?php for ($i=1; $i <=$sotrang ; $i++):  ?>
                        <li class="<?php ($p==$i)?$active:'' ?>"><a class="" href="<?php echo $path ?>?page=<?php echo $i ?>"><?php echo $i ?></a></li>
                        <?php endfor ?>
                        <li class="page-item">
                            <a class="page-link" href="<?php echo $path ?>?page=<?php echo $p+1<$i?$p+1:$p ?>">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
</div>








<?php include_once'../../layouts/footer.php'?>
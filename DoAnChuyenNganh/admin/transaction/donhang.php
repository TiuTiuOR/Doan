<?php include_once'../autoload/autoload.php'; 
    $open="transaction";
    //lấy id của đơn hàng
    $id=intval(getInput('id'));
    
    //phân trang
    $product = $db->fetchAll("orders");
    if(isset($_GET['p']))
        {
            $p=$_GET['p'];
        }
        else{
            $p=1; 
        }
    //phân trang
    $sql = "SELECT * FROM orders WHERE transaction_id = $id";
    $transhome = $db->fetchsql($sql);
    $total = count($db->fetchsql($sql));
    //tổng số sản phẩm
        //truy vấn dữ liệu trong bảng thông qua $sql phân trang
        $transhome = $db->fetchJones('orders',$sql,$total,$p,5,true);
        $sotrang = $transhome['page'];
        unset($transhome['page']);//hủy trang bị thừa
        $path = $_SERVER['SCRIPT_NAME'];//lấy tên server name hiện tại
        
    
    $sum = 0;
        
    ?>
<?php include_once'../../layouts/header.php'?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Đơn hàng
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i>  <a href="index.php">Transaction</a>
            </li>
            <li class="active">
                <i class="fa fa-file"></i> Đơn hàng
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
            <table style="text-align: center;" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Mã sản phẩm</th>
                        <th>Hình ảnh</th>
                        <th>Sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Giá tiền</th>
                        <th>Tổng tiền sản phẩm (giảm 5%)</th>
                    </tr>
                </thead>
                <tbody>
                    <!--Duyệt qua dữ liệu của danh sách để lấy id của sản phẩm-->
                    <?php foreach ($transhome as $item):
                        ?>
                    <?php 
                        $pd=intval($item['product_id']);
                        //lấy thông tin của sản phẩm dựa trên id   
                        $sql = "SELECT * FROM product WHERE id = $pd";
                        //truy vấn dữ liệu
                        $editpd = $db->fetchsql($sql); 
                        
                        ?>
                    <?php foreach ($editpd as $value):
                        $number = intval($value['price']);
                        $sale = intval($value['sale']); 
                        ?>
                    <tr>
                        <td><?php echo $value['id'];?></td>
                        <td><img src="<?php echo uploads() ?>product/<?php echo $value['thumbal'] ?>"width='80px' height="80px"></td>
                        <td><?php echo $value['name'];?></td>
                        <td><?php echo $item['qty']; ?></td>
                        <td>
                            <?php if($sale>0):
                                ?>
                            <?php
                                $num=($number*(100-$sale)/100);
                                echo formatprice($num);
                                
                                 ?>
                            <?php else: ?>
                            <p><?php echo formatprice($number); ?>   </p>
                            <?php endif ?>
                        </td>
                        <td style="color: red">
                            <b> <?php if($sale>0):
                                ?>
                            <?php
                                $total = $num * $item ['qty'];
                                echo formatprice($total); ?>
                            <?php else: ?>
                            <?php
                                $total=$number * $item['qty']*95/100 ;
                                 echo formatprice($total);?>
                            <?php endif ?></b>
                        </td>
                    </tr>
                    <?php endforeach ?>
                    <?php endforeach ?>
                </tbody>
            </table>
            <div class="pull-right">
                <nav class="text-center">
                    <ul class="pagination">
                        <li class="page-item">
                            <!--phân trang-->
                            <a class="page-link" href="<?php echo $path ?>?id=<?php echo $id ?>&&p=<?php echo $p-1==0?1:$p-1 ?>" tabindex="-1">Previous</a>
                        </li>
                        <?php for ($i=1; $i <= $sotrang ; $i++):?>
                        <!--Phân trang-->
                        <li class="<?php $p==$i?$active:'' ?>"><a href="<?php echo $path ?>?id=<?php echo $id ?>&&p=<?php echo $i ?>"><?php echo $i;?></a></li>
                        <?php endfor ?>
                        <li class="page-item">
                            <a class="page-link" href="<?php echo $path ?>?id=<?php echo $id ?>&&p=<?php echo $p+1<$i?$p+1:$p ?>">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
<?php include_once'../../layouts/footer.php'?>
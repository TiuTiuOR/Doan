<?php 
    include'autoload/autoload.php';
    //lấy id của đơn hàng
    $ids=intval(getInput('id'));
    
    //phân trang
    if(isset($_GET['p']))
    {
        $p=$_GET['p'];
    }
    else{
        $p=1;
    }
    //phân trang
    $sql = "SELECT * FROM orders WHERE transaction_id = $ids";
    $transhom = $db->fetchsql($sql);
    $total = count($db->fetchsql($sql));
    //tổng số sản phẩm
    //truy vấn dữ liệu trong bảng thông qua $sql phân trang
    $transhom = $db->fetchJones('orders',$sql,$total,$p,5,true);
    $sotrang = $transhom['page'];
    unset($transhom['page']);//hủy trang bị thừa
    $path = $_SERVER['SCRIPT_NAME'];//lấy tên server name hiện tại
    
    
    
    $sum = 0;
    
    
    
    ?>
<?php include'header.php' ?>
<div class="col-md-9">
    <section class="box-main1">
        <h3 class="title-main" ><a href=""> Chi tiết sản phẩm </a> </h3>
    </section>
    <div class="table-responsive">
        <table style="text-align: center;font-weight: 900" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Mã sản phẩm</th>
                    <th>Hình ảnh</th>
                    <th>Sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Giá tiền sản phẩm</th>
                    <th>Tổng tiền sau khi giảm giá(5%)</th>
                </tr>
            </thead>
            <tbody>
                <!--Duyệt qua dữ liệu của danh sách để lấy id của sản phẩm-->
                <?php foreach ($transhom as $item): ?>
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
                            $total=$number * $item['qty']*95/100;
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
                      <li class="page-link">
                        <!--phân trang-->
                        
                        <a href="kt-don-hang.php" >Quay lại</a>
                    </li>

                    <li class="page-item">
                        <!--phân trang-->

                        <a class="page-link" href="<?php echo $path ?>?id=<?php echo $ids ?>&&p=<?php echo $p-1==0?1:$p-1 ?>" tabindex="-1">Previous</a>
                    </li>
                    <?php for ($i=1; $i <= $sotrang ; $i++):?>
                    <!--Phân trang-->
                    <li class="<?php $p==$i?$active:'' ?>"><a href="<?php echo $path ?>?id=<?php echo $ids ?>&&p=<?php echo $i ?>"><?php echo $i;?></a></li>
                    <?php endfor ?>
                    <li class="page-item">
                        <a class="page-link" href="<?php echo $path ?>?id=<?php echo $ids ?>&&p=<?php echo $p+1<$i?$p+1:$p ?>">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>
</div>
<?php include'footer.php'; ?>
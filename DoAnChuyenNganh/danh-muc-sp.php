<?php 
    include 'autoload/autoload.php';
    //lấy id ép kiểu về số nguyên
    $ids=intval(getInput('id'));
        //lấy dữ liệu từ bảng category thông qua id được lấy từ $id
    $editCategory = $db->fetchID("category",$ids);
   
    if(isset($_GET['p']))
    {
        $p=$_GET['p'];
    }
    else{
        $p=1;
    }
    //truy vấn câu lệnh lấy sản phẩm thông qua id
    $sql = "SELECT * FROM product WHERE category_id = $ids";
    $total = count($db->fetchsql($sql));
   
    //truy vấn dữ liệu trong bảng thông qua $sql phân trang
    $product = $db->fetchJones('product',$sql,$total,$p,4,true);
    $sotrang = $product['page'];
    
    unset($product['page']);//hủy trang bị thừa
    $path = $_SERVER['SCRIPT_NAME'];//lấy tên server name hiện tại
    
    include 'header.php'
    ?>
<div class="col-md-9 bor">
    <section class="box-main1">
        <!--Muốn lấy được tên danh mục phải gọi biến $editcategory-->
        <h3 class="title-main"><a href=""> <?php echo $editCategory['name'] ?></a> </h3>
        <div class="showitem clearfix">
            <?php foreach($product as $item): ?>
            <div class="col-md-3 item-product bor">
                <a href="chi-tiet-sp.php?id=<?php echo $item['id'] ?>">
                <img src="<?php echo uploads()?>/product/<?php echo $item['thumbal'] ?>" class="" width="100%" height="180">
                </a>
                <div class="info-item">
                    <a href="chi-tiet-sp.php?id=<?php echo $item['id'] ?>"><?php echo $item['name'] ?></a>
                    <?php if($item['sale']>0): ?>
                    <p><strike class="sale"><?php echo formatprice($item['price']); ?>đ</strike> 
                        <b class="price"><?php echo saleprice($item['price'],$item['sale']); ?></b>
                    </p>
                    <?php else : ?>
                    <p><b class="price"><?php echo saleprice($item['price'],$item['sale']); ?></b></p>
                    <?php endif ?>
                </div>
                <div class="hidenitem" >
                   <!-- <p><a href=""><i class="fa fa-search"></i></a></p>
                    <p><a href=""><i class="fa fa-heart"></i></a></p>-->
                    
                </div>
                <div style="margin-left: 55px;">
              <a style= "background: #f42e2e; color: #ffffff;"href="giohang/addcart.php?id=<?php echo $item['id'] ?>" class="btn btn-default"> Mua hàng</a>
            </div>
            </div>
            <?php endforeach; ?>
        </div>
        <nav class="text-center">
            <ul class="pagination">
                <?php for ($i=1; $i <= $sotrang ; $i++):?>
                <!--Phân trang-->
                <li class="<?php $p==$i?$active:'' ?>"><a href="<?php echo $path ?>?id=<?php echo $ids ?>&&p=<?php echo $i ?>"><?php echo $i;?></a></li>
                <?php endfor ?>
            </ul>
        </nav>
    </section>
</div>
<?php include'footer.php'; ?>
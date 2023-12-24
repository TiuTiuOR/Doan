<?php 
    include'autoload/autoload.php';
    include'header.php';
    $id = intval(getInput('id'));
    //lấy tất cả dữ liệu trong bảng thông qua id
    $input = $db->fetchID("page",$id);
    //chọn tên và id từ bảng với điều kiện page_id=$id
    $sqlhomecate = "SELECT name, id FROM category WHERE page_id=$id";
    //Lấy tất cả dữ liệu có trong bảng qua câu lệnh 
    $Categoryhome = $db->fetchsql($sqlhomecate);
    
    $data=[];
    foreach($Categoryhome as $item)
    {
    $idcate = intval($item['id']);
    $sql = "SELECT * FROM product WHERE category_id = $idcate";
    $productHome = $db->fetchsql($sql);
    $data[$item['name']] = $productHome;
    }
?>
<div class="col-md-9 bor">
    <section class="box-main1">
        <?php foreach($data as $key=>$value): ?>
        <h3 class="title-main" ><a href=""> <?php echo $key;?> </a> </h3>
        <div class="showitem clearfix">
            <?php foreach($value as $item):?>
            <!--Ảnh-->
            <div class="col-md-3 item-product ">
                <a href="chi-tiet-sp.php?id=<?php echo $item['id'] ?>">
                <img src="<?php echo uploads()?>/product/<?php echo $item['thumbal'] ?>" class="" width="100%" height="180" >
                </a>
                <!--Tên sp-->
                <div class="info-item">
                    <a href="chi-tiet-sp.php?id=<?php echo $item['id'] ?>"><?php echo $item['name']?></a>
                    <?php if($item['sale']>0): ?>
                    <!--Giá-->
                    <p><strike class="sale"><?php echo formatprice($item['price']); ?></strike>  <b class="price"><?php echo saleprice($item['price'],$item['sale']); ?></b>     
                    </p>
                    <?php else: ?>
                    <p><b class="price"><?php echo saleprice($item['price'],$item['sale']); ?></b>    </p>
                    <?php endif ?>
                    <a style= "background: #f42e2e; color: #ffffff;"href="giohang/addcart.php?id=<?php echo $item['id'] ?>" class="btn btn-default"> Mua hàng</a>
                </div>
                <!--Chi tiết sp-->
                <div class="modal fade" id="<?php echo $item['id'] ?>" role="dialog">
                    <div class="modal-dialog">
                     
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title"><?php echo $item['name'] ?></h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-5">
                                    <img src="<?php echo uploads() ?>/product/<?php echo $item['thumbal'] ?>" class="" width="100%" height="200" >
                                </div>
                                <div class="col-md-7">
                                    <p><b style="font-size: 16px">Chi tiết sản phẩm:</b></p>
                                    <p><b>Giảm giá:</b><b style="font-size: 16px; color: red"><?php echo $item['sale'] > 0 ? " $item[sale]" : '' ?>%</b></p>
                                    <p><b>Giá: </b><?php if ($item['sale'] > 0): ?>
                                    <strike class="sale" style="font-size: 18px"><?php echo formatprice($item['price']); ?></strike>  <b class="price" style="font-size: 18px"><?php echo saleprice($item['price'], $item['sale']); ?></b>                                                                            
                                    <b style="font-size: 18px" class="price"><?php echo saleprice($item['price'], $item['sale']); ?></b>  
                                    <?php
                                      endif ?></p>
                                    <p><b>Tình trạng: </b><span class="label  <?php echo $item[$number] > 0 ? 'label-primary' : 'label-warning' ?>"><?php echo $item['number'] > 0 ? 'Còn hàng' : 'Hết hàng'; ?></span></p>
                                    <p><b> Số lượng sản phẩm:</b> <span class="  label <?php echo $item['number'] >0? "label-primary":"label-danger"?>">
                                    <?php  echo $item['number']; ?> </span></p>
                                    <p><b>Mô tả:</b><?php echo $item['content'] ?></p>
                                </div>
                                
                            </div>
                          
                        </div>
                        <div class="modal-footer">
                          <p>
                            <button type="button" class="btn btn-danger btn-lg"><a style="color:#fff" href="giohang/addcart.php?id=<?php echo $item['id'] ?>"><i style="color: #fff;justify-content: center;" class="fa fa-shopping-basket"></i> Mua hàng</a></button>
                          </p>
                        </div>
                      </div>
                      
                    </div>
                </div>
                <div class="hidenitem">
                    <span data-toggle="modal" data-target="#<?php echo $item['id'] ?>"><i class="fa fa-info"></i></span>
                    <span><a href="giohang/addcart.php?id=<?php echo $item['id'] ?>"><i class="fa fa-shopping-basket"></i></a></span>
                </div>
            </div>
            <?php endforeach?>
        </div>
        <?php endforeach?>
    </section>
</div>
<?php include'footer.php'; ?>
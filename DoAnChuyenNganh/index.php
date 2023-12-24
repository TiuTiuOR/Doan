<?php
include 'autoload/autoload.php';

$sqlhomecate = "SELECT name, id FROM category WHERE home = 1 ORDER BY update_at";

$Categoryhome = $db->fetchsql($sqlhomecate);
$data = [];
foreach ($Categoryhome as $item) {
    $cateID = intval($item['id']); 
   
    $sql = "SELECT * FROM product WHERE category_id = $cateID ORDER BY ID DESC LIMIT 4";
    $productHome = $db->fetchsql($sql); 
    $data[$item['name']] = $productHome;
}
$pannel = $db->fetchAll("panel");
$count = count($db->fetchAll("panel"));

$a=1;

?>
<?php include 'header.php'?>
<div class="col-md-9">
    <?php if (isset($_SESSION['success'])): ?>
   
    <div class="alert alert-success">
        <strong style="color: green"><?php echo $_SESSION['success'];
    unset($_SESSION['success']) ?></strong> 
    </div>
    <?php endif ?>
    <?php if (isset($_SESSION['error'])): ?>
    
    <div class="alert alert-danger">
        <strong style="color: red"><?php echo $_SESSION['error'];
    unset($_SESSION['error']) ?></strong> 
    </div>
    <?php endif ?>
  
    <section style=" margin-bottom: 2px;" id="slide" class="text-center" >
     
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
    
 
      <ol class="carousel-indicators">
          <?php foreach ($pannel as $value): ?>
        <li data-target="#myCarousel" data-slide-to="<?php echo($value['sum']==1?0:$a++) ?>" class="<?php echo($value['sum']==1?'active':'') ?>"></li>
        <?php endforeach ?>
      </ol>
    
      <div class="carousel-inner">
      <?php foreach ($pannel as $value): ?>
          <div class="item <?php echo($value['sum']==1?$active:'') ?>">

          <img  src="<?php echo uploads() ?>/product/<?php echo $value['panel'] ?>"style="width:100%;height: 395px; " >
        </div>    
        <?php endforeach ?>  
      </div>

      <a class="left carousel-control" href="#myCarousel" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" style="color:#fff"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#myCarousel" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" style="color:#fff"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
        
    </section>
    <section class="box-main1">
        <?php foreach ($data as $key => $value): ?>
        <h3 class="title-main" >
          <a> <?php echo $key; ?> </a> </h3>
        <div class="showitem clearfix">
            <?php foreach ($value as $item): ?>
        
            <div class="col-md-3 item-product ">
                <p><span style="float: left;" class="label  <?php echo $item[$number] > 0 ? 'label-primary' : 'label-warning' ?>"><?php echo $item['number'] > 0 ? 'Còn hàng' : 'Hết hàng'; ?></span>
                    <span class="label label-danger" style="float: right;">Lượt xem: <?php echo $item['view'] ?></span>
                </p>
                <a href="chi-tiet-sp.php?id=<?php echo $item['id'] ?>">
                <img src="<?php echo uploads() ?>/product/<?php echo $item['thumbal'] ?>" class="" width="100%" height="180" >
                </a>
                
                <div class="info-item">
                    <a href="chi-tiet-sp.php?id=<?php echo $item['id'] ?>"><?php echo $item['name'] ?></a>
                    <?php if ($item['sale'] > 0): ?>
                    
                    <p><strike class="sale"><?php echo formatprice($item['price']); ?></strike>  <b class="price"><?php echo saleprice($item['price'], $item['sale']); ?></b>     
                    </p>
                    <?php
        else: ?>
                    <p><b class="price"><?php echo saleprice($item['price'], $item['sale']); ?></b>    </p>
                    <?php
        endif ?>
  
                </div>
              
                  <div style="margin-left: 55px;">
                  <button type="button" class="btn btn-danger btn-lg"><a style="color:#fff" href="giohang/addcart.php?id=<?php echo $item['id'] ?>"><i style="color: #fff" class="fa fa-shopping-basket"></i> Mua hàng</a></button>

                      

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
                                    <p style="text-align:center"><b >CHI TIẾT SẢN PHẨM</b></p>
                                    <p><b>Giảm giá:</b><b style="font-size: 16px; color: red"><?php echo $item['sale'] > 0 ? " $item[sale]" : '' ?>%</b></p>

                                    
                                    <p><b>Giá: </b><?php if ($item['sale'] > 0): ?>
                                    
                                    <strike class="sale" style="font-size: 18px"><?php echo formatprice($item['price']); ?></strike>  <b class="price" style="font-size: 18px"><?php echo saleprice($item['price'], $item['sale']); ?></b>     
                                    
                                    <?php
                                        else: 
                                        ?>
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
                </div>
  
  
            
                <div class="hidenitem" style="margin-top: 15px">
                    <span data-toggle="modal" data-target="#<?php echo $item['id'] ?>"><i class="fa fa-info"></i></span>
                    <span><a href="giohang/addcart.php?id=<?php echo $item['id'] ?>"><i class="fa fa-shopping-basket"></i></a></span>
                </div>

            </div>
            <?php  endforeach ?>
        </div>
        <?php endforeach ?>
    </section>
</div>


<?php include 'footer.php' ?>
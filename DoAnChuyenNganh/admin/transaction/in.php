<?php include'../autoload/autoload.php';

    //lấy id của đơn hàng
    $ids=intval(getInput('id'));
    //lấy dữ liệu trong cate
    $trans=$db->fetchID("transaction",$ids);
    //từ cate lấy user_id để kết nối vào bảng users
    $i = intval($trans['users_id']);
    //lấy dữ liệu của bảng users thông qua id
    $user = $db->fetchID("users",$i);
    
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
    $date = getdate();




 ?>
 <style type="text/css">
 	body {
    margin: 0;
    padding: 0;
    background-color: #FAFAFA;
    font: 12pt "Tohoma";
}
* {
    box-sizing: border-box;
    -moz-box-sizing: border-box;
}
.page {
    width: 21cm;
    overflow:hidden;
    min-height:297mm;
    padding: 2.5cm;
    margin-left:auto;
    margin-right:auto;
    background: white;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
}
.subpage {
    padding: 1cm;
    border: 5px red solid;
    height: 237mm;
    outline: 2cm #FFEAEA solid;
}
 @page {
 size: A4;
 margin: 0;
}
button {
    width:100px;
    height: 24px;
}
.header {
    overflow:hidden;
}
.logo {
    background-color:#FFFFFF;
    text-align:left;
    float:left;
}
.company {
    padding-top:24px;
    text-transform:uppercase;
    background-color:#FFFFFF;
    text-align:right;
    float:right;
    font-size:16px;
}
.title {
    text-align:center;
    position:relative;
    color:#0000FF;
    font-size: 20px;
    top:1px;
}
.footer-left {
    text-align:center;
    text-transform:uppercase;
    padding-top:24px;
    position:relative;
    height: 150px;
    width:50%;
    color:#000;
    float:left;
    font-size: 12px;
    bottom:1px;
}
.footer-right {
    text-align:center;
    text-transform:uppercase;
    padding-top:24px;
    position:relative;
    height: 150px;
    width:50%;
    color:#000;
    font-size: 12px;
    float:right;
    bottom:1px;
}
.TableData {
    background:#ffffff;
    font: 11px;
    width:100%;
    border-collapse:collapse;
    font-family:Verdana, Arial, Helvetica, sans-serif;
    font-size:12px;
    border:thin solid #d3d3d3;
}
.TableData TH {
    background: rgba(0,0,255,0.1);
    text-align: center;
    font-weight: bold;
    color: #000;
    border: solid 1px #ccc;
    height: 24px;
}
.TableData TR {
    height: 24px;
    border:thin solid #d3d3d3;
}

table ,td,th{
    border: 1px solid black;
    border-collapse: collapse;

}
.TableData TR TD {
   
    border:thin solid #d3d3d3;

}
.TableData TR:hover {
    background: rgba(0,0,0,0.05);
}
.TableData .cotSTT {
    text-align:center;
    width: 10%;
}
.TableData .cotTenSanPham {
    text-align:left;
    width: 40%;
}
.TableData .cotHangSanXuat {
    text-align:left;
    width: 20%;
}
.TableData .cotGia {
    text-align:right;
    width: 120px;
}
.TableData .cotSoLuong {
    text-align: center;
    width: 50px;
}
.TableData .cotSo {
    text-align: right;
    width: 120px;
}
.TableData .tong {
    text-align: right;
    font-weight:bold;
    text-transform:uppercase;
    padding-right: 4px;
}
.TableData .cotSoLuong input {
    text-align: center;
}
@media print {
 @page {
 margin: 0;
 border: initial;
 border-radius: initial;
 width: initial;
 min-height: initial;
 box-shadow: initial;
 background: initial;
 page-break-after: always;
}
}
 </style>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="public/frontend/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="public/frontend/css/bootstrap.min.css">
        <link rel="icon" href="../../public/frontend/images/logo_header1.png" type="image/x-icon">
        <script  src="public/frontend/js/jquery-3.2.1.min.js"></script>
        <script  src="public/frontend/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="public/frontend/css/slick.css"/>
        <link rel="stylesheet" type="text/css" href="public/frontend/css/slick-theme.css"/>
        <!--slide-->
        <link rel="stylesheet" type="text/css" href="public/frontend/css/style.css">
        <link rel="stylesheet" type="text/css" href="public/frontend/css/notify.js">
</head>
<body onload="window.print();">
<div id="page" class="page">
    <div class="header">
        <div ><img width="15%" height="12%" src="../../public/frontend/images/logo_header.png" alt=""></div>
        <div class="company">
        	<p><b>Mã hóa đơn: <?php echo $trans['id']; ?></b> </p>
        </div>
    </div>
  <br/>
  <div class="title">
        HÓA ĐƠN THANH TOÁN
        <br/>
        -------oOo-------
  </div>
  <br>
  <p><b>Khách hàng: <?php echo $user['account'] ?></b></p>
  <p><b>Giao về: <?php echo $user['address'] ?></b></p>
  <p><b>Số điện thoại: <?php echo $user['phone'] ?></b></p>

  <div class="table-responsive">
        <table style="text-align: center;" class="table table-bordered table-hover">

            <thead>
                <tr>
                    <th>Mã sản phẩm</th>
                    <th>Tên sản phẩm</th>
                    <th style="width: 20%;">Ghi chú</th>
                    <th>Giá sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Tổng tiền (đã giảm 5%)</th>
                </tr>
                
            </thead>
            <tbody>
                
                	<?php //in danh sách 
                
                    foreach ($transhom as $item):?>
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
                    <td><?php echo $value['name'];?></td>
                    <td><?php echo $trans['note']; ?></td>
                    <td>
                        <?php if($sale>0):
                            ?>
                        <?php
                            $num=($number*$item['qty']);

                            echo formatprice($num);
                            
                             ?>
                        <?php else: ?>
                        <p><?php echo formatprice($number); ?>   </p>
                        <?php endif ?>
                    </td>
                    <td ><?php echo $item['qty']; ?></td>
                    <td><?php echo formatprice($number* $item['qty']*95/100) ?></td>
                </tr>
                <?php endforeach ?>
                <?php endforeach ?>
              
            </tbody>
            <tfoot>
                <tr>
                    <th>TỔNG TIỀN ĐƠN HÀNG</th>
                    <th colspan="6"><?php echo formatprice($trans['amount']); ?></th>
                    
                </tr>
            </tfoot>
        </table>
        
    </div>
  <div class="footer-left"><b> <?php echo "..., ngày ".$date['mday']." tháng ".$date['mon']. " năm ".$date['year'] ?> <br/><br>
    Khách hàng <br/>(Ký và ghi rõ họ tên)
</div>
  <div class="footer-right"> <?php echo "TP.HCM, ngày ".$date['mday']." tháng ".$date['mon']. " năm ".$date['year'] ?> <br/><br>
    Chủ cửa hàng <br/>(Chữ ký)  <p style="font-size: 16px;"><b><br><br><?php  echo "Tiêu Quang Trường"; ?></b></p>
</div>
   
</div>
<script  src="public/frontend/js/slick.min.js"></script>
</body>
</html>
<script type="text/javascript">
    $(function() {
        $hidenitem = $(".hidenitem");
        $itemproduct = $(".item-product");
        $itemproduct.hover(function(){
            $(this).children(".hidenitem").show(100);
        },function(){
            $hidenitem.hide(500);
        })
    })
</script>
<?php 

$open="thongke";
$admin = count($db->fetchAll("transaction"));

$sum = 0;
    
    //phân trang
    if(isset($_GET['page']))
    {
        $p=$_GET['page'];
    }
    else{
        $p=1;
    }
    //truy vấn dữ liệu với điều kiện status
    $sql = "SELECT * FROM transaction WHERE status = 0 AND huy = 0 ORDER BY id DESC";
    //tổng số sản phẩm
    $total = count($db->fetchsql($sql));
    // phân trang với điều kiện total
    $transaction=$db->fetchJones('transaction',$sql,$total,$p,5,true);
    
    $sotrang = $transaction['page'];
    //Hủy trang dư
    unset($transaction['page']); 
    $path = $_SERVER['SCRIPT_NAME']; //lấy tên server name hiện tại
    //tổng sp
    $sumproduct=count($db->fetchAll("product"));
    //tổng thành viên
    $summember = count($db->fetchAll("users"));
    //tổng số các sp
    $pro = $db->fetchAll("product");

    foreach ($pro as $value) {
        $a = intval($value['number']);
        $sum += $a;
    }
    //sp sắp hết
    $sqla = "SELECT * FROM product WHERE number <10 ORDER BY id DESC";
       $saphet = count($db->fetchsql($sqla));
    $sqlhuy = "SELECT * FROM transaction WHERE HUY = 1 ORDER BY id DESC";
    $huy = count($db->fetchsql($sqlhuy));
    
    $dxl = "SELECT * FROM transaction WHERE  status = 1 AND huy = 0  ORDER BY id DESC";
    $daxl = count($db->fetchsql($dxl));
?>


                

                    
           










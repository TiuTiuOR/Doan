    <?php 
    $open="transaction";
    include_once'../autoload/autoload.php';

    $id=intval(getInput('id'));
  
    //Lấy dữ liệu trong bảng qua hàm fetchID
    $edittrans = $db->fetchID("transaction",$id);
  
    if(empty($edittrans))//nếu edit trống thực thi lệnh
    {
        $_SESSION['error']="Dữ liệu không tồn tại";
                redirectTrans("transaction");//redirecAdmin chuyển về các trang
    }
    //ép kiểu của transaction_id
    $idde = intval($edittrans['id']);
    $sql = "SELECT * FROM orders WHERE transaction_id=$idde";
    
    $is_products=$db->fetchsql($sql);
   

             foreach ($is_products as $item) {
                  $a = intval($item['id']);
                  $num1 = $db->delete("orders",$a);
                  
             }
         $num = $db->delete("transaction",$id);
            
            if($num1>0)
            {
                $_SESSION['success']="Xóa thành công";
                        redirectTrans("transaction");//redirecAdmin chuyển về các trang

            }
            else
            {
                $_SESSION['error']="Xóa thất bại";
                        redirectTrans("transaction");//redirecAdmin chuyển về các trang

            }
    
    
    ?>
<?php 
    $open="transaction";
        include_once'../autoload/autoload.php';
        //lấy id
        $id=intval(getInput('id'));
            
         //Lấy id trong bảng qua hàm fetchID
        $edittran = $db->fetchID("transaction",$id);
        if(empty($edittran))//nếu edit trống thực thi lệnh
        {
            $_SESSION['error']="Dữ liệu không tồn tại";
                   redirectTrans('transaction');//redirecAdmin chuyển về các trang
        }

        $home = $edittran['status']==0 ? 1:0;
        $update = $db->update("transaction",array('status' => $home ), array('id' => $id ));
        $_SESSION['success']="Cập nhật thành công";
                //truy vấn dữ liệu trong bảng orders
                $sql = "SELECT product_id,qty FROM orders WHERE transaction_id = $id";
                //lấy toàn bộ dữ dữ liệu trong điều kiện được lấy ở $sql
                $order = $db->fetchsql($sql);
        //cập nhật dữ liệu
        if($update > 0 && $home==1 )
            {
                    foreach ($order as $item) {
                    $idproduct = intval($item['product_id']);
                    //lấy dữ liệu qua fetchid
                    $products = $db->fetchID("product",$idproduct);
                    $number = $products['number'] - $item['qty'];
                    //cập nhật số lượng còn lại trong mysql
                    $up_pro = $db->update("product",array('number' => $number,'pay'=>$products['pay']+1), array('id' => $idproduct ));
                }
    
                redirectTrans('transaction');//redirecAdmin chuyển về các trang
            }
        elseif($update > 0 && $home==0)
            {
                foreach ($order as $item) {
                    $idproduct = intval($item['product_id']);
                    //lấy dữ liệu qua fetchid
                    $products = $db->fetchID("product",$idproduct);
                    $number = $products['number'] + $item['qty'];
                    //cập nhật số lượng còn lại trong mysql
                    $up_pro = $db->update("product",array('number' => $number,'pay'=>$products['pay']-1), array('id' => $idproduct ));
                }
    
                redirectTrans('transaction');//redirecAdmin chuyển về các trang
                            //THêm thất bại
            }
            else {
               $_SESSION['error']="Cập nhật thất bại";
                redirectTrans('transaction');
            }
    ?>
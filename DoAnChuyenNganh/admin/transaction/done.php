<?php 
    include_once'../autoload/autoload.php';
    //lấy id
    $id=intval(getInput('id'));
        
     //Lấy id trong bảng qua hàm fetchID
    $editCategory = $db->fetchID("transaction",$id);
    if(empty($editCategory))//nếu edit trống thực thi lệnh
    {
        $_SESSION['error']="Dữ liệu không tồn tại";
                redirectTrans('transaction');
    }

    $home = $editCategory['done']==0 ? 1:0;
    $update = $db->update("transaction",array('done' => $home ), array('id' => $id ));
    //cập nhật dữ liệu
    if($update > 0 )
        {
            $_SESSION['success']="Cập nhật thành công";
           redirectTrans('transaction');
        }
    else
        {
                        //THêm thất bại
            $_SESSION['error']="Cập nhật thất bại";
            redirectTrans('transaction');
        }
?>
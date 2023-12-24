<?php 
    include_once'../autoload/autoload.php';
    //lấy id
    $id=intval(getInput('id'));
        
     //Lấy id trong bảng qua hàm fetchID
    $editCategory = $db->fetchID("transaction",$id);
    if(empty($editCategory))//nếu edit trống thực thi lệnh
    {
        $_SESSION['error']="Dữ liệu không tồn tại";
                header('location:../kt-don-hang.php');
    }
    $home = $editCategory['huy']==0 ? 1:0;
    $update = $db->update("transaction",array('huy' => $home ), array('id' => $id ));
    //cập nhật dữ liệu
    if($update > 0 )
        {
            $_SESSION['success']="Cập nhật thành công";
           header('location:../kt-don-hang.php');
        }
    else
        {
                        //THêm thất bại
            $_SESSION['error']="Cập nhật thất bại";
            header('location:../kt-don-hang.php');
        }
?>
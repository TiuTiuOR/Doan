<?php 
    $open="admin";
    include_once'../../autoload/autoload.php';
    
    $id=intval(getInput('id'));
    
    //Lấy id trong bảng qua hàm fetchID
    $editCategory = $db->fetchID("admin",$id);
    if(empty($editCategory))//nếu edit trống thực thi lệnh
    {
        $_SESSION['error']="Dữ liệu không tồn tại";
                redirectAdmin("admin");//redirecAdmin chuyển về các trang
    }

    $num = $db->delete("admin",$id);
    if($num>0)
    {
        $_SESSION['success']="Xóa thành công";
                redirectAdmin("admin");//redirecAdmin chuyển về các trang
    
    }
    else
    {
        $_SESSION['error']="Xóa thất bại";
                redirectAdmin("admin");//redirecAdmin chuyển về các trang
    
    }
    ?>
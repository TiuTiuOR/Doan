<?php 
    include_once'../autoload/autoload.php';
    
    $id=intval(getInput('id'));
    
    //Lấy id trong bảng qua hàm fetchID
    $editCategory = $db->fetchID("panel",$id);
    if(empty($editCategory))//nếu edit trống thực thi lệnh
    {
        $_SESSION['error']="Dữ liệu không tồn tại";
                redirectAdmin("panel");//redirecAdmin chuyển về các trang
    }
    
    $num = $db->delete("panel",$id);
    if($num>0)
    {
        $_SESSION['success']="Xóa thành công";
                redirectTrans("setting/pannel.php");//redirecAdmin chuyển về các trang
    
    }
    else
    {
        $_SESSION['error']="Xóa thất bại";
                redirectTrans("setting/pannel.php");//redirecAdmin chuyển về các trang
    
    }
    ?>
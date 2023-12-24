<?php 
    $open="page";
    include_once'../../autoload/autoload.php';
    
    $id=intval(getInput('id'));
    
    //Lấy id trong bảng qua hàm fetchID
    $editCategory = $db->fetchID("page",$id);
    if(empty($editCategory))//nếu edit trống thực thi lệnh
    {
        $_SESSION['error']="Dữ liệu không tồn tại";
                redirectAdmin("page");//redirecAdmin chuyển về các trang
    }

    $is_product=$db->fetchOne("category"," page_id = $id ");
    if($is_product == NULL)
    {
                $num = $db->delete("page",$id);
            if($num>0)
            {
                $_SESSION['success']="Xóa thành công";
                        redirectAdmin("page");//redirecAdmin chuyển về các trang
    
            }
            else
            {
                $_SESSION['error']="Xóa thất bại";
                        redirectAdmin("page");//redirecAdmin chuyển về các trang
    
            }
    }
    else
    {
        $_SESSION['error']="Trang có danh mục sản phẩm, bạn không thể xóa..!!";
                        redirectAdmin("page");//redirecAdmin chuyển về các trang
    }
    
    
    ?>
<?php 
    $open="category";
    include_once'../../autoload/autoload.php';
    
    $id=intval(getInput('id'));
    
    //Lấy id trong bảng qua hàm fetchID
    $editCategory = $db->fetchID("category",$id);
    if(empty($editCategory))//nếu edit trống thực thi lệnh
    {
        $_SESSION['error']="Dữ liệu không tồn tại";
                redirectAdmin("category");//redirecAdmin chuyển về các trang
    }

    $is_product=$db->fetchOne("product"," category_id = $id ");
    if($is_product == NULL)
    {
                $num = $db->delete("category",$id);
            if($num>0)
            {
                $_SESSION['success']="Xóa thành công";
                        redirectAdmin("category");//redirecAdmin chuyển về các trang
    
            }
            else
            {
                $_SESSION['error']="Xóa thất bại";
                        redirectAdmin("category");//redirecAdmin chuyển về các trang
    
            }
    }
    else
    {
        $_SESSION['error']="Danh mục có sản phẩm, bạn không thể xóa được nó..!!";
                        redirectAdmin("category");//redirecAdmin chuyển về các trang
    }
    
    
    ?>
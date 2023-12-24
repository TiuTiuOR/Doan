 <?php 
    $open="users";
    include_once'../../autoload/autoload.php';

    $id=intval(getInput('id'));
    
    //Lấy id trong bảng qua hàm fetchID
    $editCategory = $db->fetchID("users",$id);
    if(empty($editCategory))//nếu edit trống thực thi lệnh
    {
        $_SESSION['error']="Dữ liệu không tồn tại";
                redirectAdmin("users");//redirecAdmin chuyển về các trang
    }
$is_product=$db->fetchOne("transaction"," users_id = $id ");
if($is_product == NULL)
    {
    $num = $db->delete("users",$id);
    if($num>0)
    {
        $_SESSION['success']="Xóa thành công";
                redirectAdmin("users");//redirecAdmin chuyển về các trang
    }
    else
    {
        $_SESSION['error']="Xóa thất bại";
                redirectAdmin("users");//redirecAdmin chuyển về các trang

    }
}
 else
    {
        $_SESSION['error']="Danh mục có sản phẩm, bạn không thể xóa được nó..!!";
                        redirectAdmin("users");//redirecAdmin chuyển về các trang
    }
    ?>
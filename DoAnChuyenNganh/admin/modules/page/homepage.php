<?php 
    $open="page";
        include_once'../../autoload/autoload.php';
        //lấy id
        $id=intval(getInput('id'));
            
         //Lấy id trong bảng qua hàm fetchID
        $editCategory = $db->fetchID("page",$id);
        if(empty($editCategory))//nếu edit trống thực thi lệnh
        {
            $_SESSION['error']="Dữ liệu không tồn tại";
                    redirectAdmin("page");//redirecAdmin chuyển về các trang
        }

        $home = $editCategory['homepage']==0 ? 1:0;
        $update = $db->update("page",array('homepage' => $home ), array('id' => $id ));
        //cập nhật dữ liệu
        if($update > 0 )
            {
                $_SESSION['success']="Cập nhật thành công";
                redirectAdmin("page");//redirecAdmin chuyển về các trang
            }
        else
            {
                            //THêm thất bại
                $_SESSION['error']="Cập nhật thất bại";
                redirectAdmin("page");
            }
    ?>
<?php  

    if(isset($_SESSION['name_id'])){
    
    $data =[
        "content" => postInput("content"),
        "users_id" => $_SESSION['name_id'],
        "product_id"=>$product['id'],
       
    ];}
    else if(isset($_SESSION['admin_id'])){
         $data =[
        "content" => postInput("content"),
        
        "product_id"=>$product['id'],
        "admin_id" => $_SESSION['admin_id']
    ];
    }
    else
        $data=[];

    if(isset($_POST['ok']))
    {
        $error = [];//khởi tạo mảng lỗi
        if(postInput('content')=='')
        {
            $error['content']="Bạn chưa nhập nội dung";
        }
    
        if(empty($error))
        {   //câu lênh cho upload file            
    
        //kiểm tra trùng tên
            
            //insert dữ liệu
            $id_insert =$db->insert("comment",$data);
            
            if($id_insert > 0 )
            {   //Đăng ký
                $_SESSION['success']="Đăng thành công !!!";
                //redirecAdmin chuyển về các trang
                header('location: chi-tiet-sp.php?id='.$id);
                
            }
            else
            {
                //THêm thất bại
    
                $_SESSION['error']="Đăng ký thất bại";
               header('location: chi-tiet-sp.php');
            }

         }

        }
    


     ?>




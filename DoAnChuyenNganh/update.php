
<?php
include 'autoload/autoload.php';


  
   //session_start();
    //var_dump($_POST['id1']);
    //  die;
    if(isset($_POST["id"])){
        $qty= $_POST["qty"];
        $id= $_POST["id"];
       

         
    }

 
 $editcart = $db->fetchID('product',$id); 
    $action=(isset($_POST["action"]));

    $action=(isset($_POST["action"]));
    $qty=(isset($_POST["qty"]) ? $_POST["qty"] : 1  );
    if($qty<=0){
      
        $qty=0;
    }

    if($action =='update'){
       if($qty > $editcart['number']){
        {
           $_SESSION['success'] = 'Sản phẩm đã hết, vui lòng lựa chọn sản phẩm khác';   
            $_SESSION['cart'][$id]['qty'] = $editcart['number'];}
           }
        else{      
        $_SESSION['cart'][$id]['qty'] = $qty;
     }

        }

    header('location:gio-hang.php'); 
      
?>

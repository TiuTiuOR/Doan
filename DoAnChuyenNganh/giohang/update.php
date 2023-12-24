
    <?php 
        include'../autoload/autoload.php';


    session_start();
        if(isset($_POST["id"])&& isset($_POST["qty"])){
            $qty= $_POST["qty"];
            $id= $_POST["id"];
            $cart= $_SESSION["cart"];
            
            printf($qty);
        }
    header('location: ../gio-hang.php');       
    ?>
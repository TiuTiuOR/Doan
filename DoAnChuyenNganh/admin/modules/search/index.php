<?php include_once'../../autoload/autoload.php'; 
    include_once'../../autoload/connect.php';
     $open="product";
    $product = $db->fetchAll("product");
    $admin = $db->fetchAll("admin");
    $category = $db->fetchAll("category");
    $users = $db->fetchAll("users");
    $page = $db->fetchAll("page");
    $trans = $db->fetchAll("transaction");

       
?>


<?php include_once'../../../layouts/header.php'?>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Kết quả tìm kiếm
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i>  <a href="../../index.php"> Bảng điều khiển</a>
            </li>
            <li class="active">
                <i class="fa fa-file"></i> Kết quả tìm kiếm
            </li>
        </ol>
        <div class="col-sm-8">
            <form class="navbar-form navbar-right" action="../search/index.php" method="GET">
                <div class="input-group" style="width: 660px;">
                <input type="text" class="form-control" style="border-radius: 5px" name="search" placeholder="Tìm kiếm sản phẩm">
                <div class="input-group-btn" style ="width:40px">
                    <button class="btn btn-default" style="background: #80ac7b; padding-bottom: 3px; padding-left: 20px" type="submit">
                    <i class="glyphicon glyphicon-search" style="padding-right: 10px; color: #fff "></i>
                    </button>
                </div>
                </div>
            </form>
        </div>

        <!--Hiển thị danh thông báo session khi thành công hay thất bại-->
         <?php if(isset($_GET['search']))
        {   $search = $_GET['search'];
            if(empty($search))
            {
                echo "<p>Yêu cầu nhập dữ liệu</p>";
            }
            else
            {
                $product = $db->fetchAll("category");
                  $sql = "SELECT product.*,category.name as dmuc FROM product LEFT JOIN category on product.category_id = category.id ORDER BY id DESC";


                $query = "SELECT * FROM product WHERE name LIKE '%$search%' ";
                $result = mysqli_query( $conn,$query);
                $a = count($db->fetchsql($query));
                ?>
                <?php if(empty($a == 0)): ?>


                 <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên sản phẩm</th>
                         <th>Danh mục</th>
                        <th>Slug</th>
                        <th>Hình ảnh</th>
                        <th>Mô tả</th>
                        <th>Tình trạng</th>
                        <th>Chỉnh sửa</th>
                        <th>Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    <?php //in danh sách 

                        
                        foreach ($result as $row) { 
                          $id = (intval($row['category_id']));
                            
                           $sqli = "SELECT name FROM category WHERE id=$id";
                           $category_id=$db->fetchsql($sqli);
                         
                           foreach ($category_id as $item):  
                           ?>
                    <tr>
                        <td><?php echo $row['id'];?></td>
                        <td><?php echo $row['name'];?></td>
                     <td><?php echo $item['name'];?></td>
                        <td><?php echo $row['slug'];?></td>
                        <td><img src="<?php echo uploads() ?>product/<?php echo $row['thumbal'] ?>"width='80px' height="80px"></td>
                        <td><?php echo $row['content'];?></td>
                        <td>
                            <ul>
                                <li>Giá: <?php echo formatprice($row['price']);?></li>
                                <li>Số lượng: <?php echo $row['number'];?></li>
                                <li>Giảm giá: <?php echo $row['sale'];?>%</li>
                                <li>Giá đã giảm: <?php echo saleprice($row['price'],$row['sale']) ?></li>
                            </ul>
                        </td>
                        <td align="center";><a href="../../modules/product/edit.php?id=<?php echo $row['id'];?>"><img width="20" src="../../../image/update.png"></a></td>
                        <td align="center";>
                            <a href="../../modules/product/delete.php?id=<?php echo $row['id'];?>" onclick="return confirm('Bạn thực sự muốn xóa nó?');">
                                <img width="20" src="../../../image/Delete.png">
                        </td>
                    </tr>

                     <?php endforeach ?> 
                      
                    <?php }   ?>
                </tbody>
            </table> 
            <?php else: ?> 
                <?php echo"Sản phẩm không tồn tại" ?>
            <?php endif ?>
            
                <?php 
            }

        }
 ?> 
    </div>
</div>



<?php include_once'../../../layouts/footer.php'?>
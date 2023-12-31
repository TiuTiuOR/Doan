<?php
include 'autoload/autoload.php';
include 'header.php';
include 'autoload/connect.php';
$product = $db->fetchAll("product");
$stt = 0;
?>

<div class="col-md-9">
    <section class="box-main1">
        <h3 class="title-main"><a href=""> Kết quả tìm kiếm</a> </h3>
    </section><br>
    <?php
if (isset($_GET['search'])) {
    // $search = $_GET['search'];
    $search = mysqli_real_escape_string($conn, $_GET['search']);
    if (empty($search)) {
        echo "<p>Yêu cầu nhập dữ liệu</p>";
    } else {
        // Escape single quotes by doubling them for safe SQL usage
        //  $escaped_search = str_replace("'", "''", $search);
        //  $query = "SELECT * FROM product WHERE name LIKE '%$search%' ESCAPE '|'";
        $query = "SELECT * FROM product WHERE name LIKE '%$search%'"; 
        $result = mysqli_query($conn, $query);
        $a = count($db->fetchsql($query));  
?>
            <?php if (!empty($a)) : ?> 
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên sản phẩm</th>
                            <th>Hình ảnh</th>
                            <th>Danh mục</th>
                            <th>Giá gốc</th>
                            <th>Mua hàng</th>
                            <th>Tình trạng</th>
                            <th>Giá đã giảm</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        foreach ($result as $row) {
                            $id = (intval($row['category_id']));


                            //  $sqli = "SELECT name FROM category WHERE id='\'$id\''";
                            $sqli = "SELECT name FROM category WHERE id = $id";
                            $category_id = $db->fetchsql($sqli);
                            $stt++;
                            foreach ($category_id as $item) : ?>
                                <tr>
                                    <td><?php echo $stt; ?></td>
                                    <td><a href="chi-tiet-sp.php?id=<?php echo $row['id'] ?>"><?php echo $row['name']; ?></a></td>
                                    <td><img src="<?php echo uploads() ?>product/<?php echo $row['thumbal'] ?>" width='80px' height="80px"></td>
                                    <td><?php echo $item['name']; ?></td>
                                    <td><?php echo formatprice($row['price']); ?></td>
                                    <td>
                                        <a style="margin-top: 5px;" href="giohang/addcart.php?id=<?php echo $row['id'] ?>" class="btn btn-danger btn-sm">Thêm vào <i style="color: #fff" class="fa fa-shopping-basket"></i></a>
                                    </td>
                                    <td><span style="margin-top: 5px; center" class="label label-primary"><?php echo $row['number'] > 0 ? 'Còn hàng' : 'Hết hàng'; ?></span></td>
                                    <td>
                                        <?php echo saleprice($row['price'], $row['sale']) ?>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        <?php
                        } ?>

                    </tbody>

                </table>
            <?php else : ?>
                <?php echo "Sản phẩm không tồn tại" ?>
            <?php endif ?>
    <?php
        }
    }
    ?>
</div>
<?php include 'footer.php'; ?>

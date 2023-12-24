<?php
include 'autoload/autoload.php';

$sqlhomecate = "SELECT name, id FROM category WHERE home = 1 ORDER BY update_at";


$Categoryhome = $db->fetchsql($sqlhomecate);
$data = [];
foreach ($Categoryhome as $item) {
    $cateID = intval($item['id']); 
    
    $sql = "SELECT * FROM product WHERE category_id = $cateID ORDER BY ID DESC LIMIT 4";
    $productHome = $db->fetchsql($sql); 
    $data[$item['name']] = $productHome;
}
$pannel = $db->fetchAll("panel");
$count = count($db->fetchAll("panel"));

$a=1;
?>
<?php include 'header.php'?>
<a style="font-size: 24px; color: black"> Mọi thắc mắc hay đánh giá chất lượng dịch vụ vui lòng liên hệ trực tiếp <br><b style="font-size: 24px; color: red">Hotline: 0976374407</b></br>
<b style="font-size: 24px; color: red">Email: DH52001832@student.stu.edu.vn</b> </a>   
<p><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.947708973559!2d106.67644101462223!3d10.73851369234727!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752fad0293140b%3A0xc0ea7ec1763d80b6!2zMTgwIMSQLiBDYW8gTOG7lywgUGjGsOG7nW5nIDQsIFF14bqtbiA4LCBUaMOgbmggcGjhu5EgSOG7kyBDaMOtIE1pbmgsIFZp4buHdCBOYW0!5e0!3m2!1svi!2s!4v1667377414581!5m2!1svi!2s" width="870" height="600" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></p>
<?php include 'footer.php' ?>
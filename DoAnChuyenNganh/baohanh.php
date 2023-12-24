<?php
include 'autoload/autoload.php';
//unset($_SESSION['cart']);
//truy vấn chọn trong bảng home có giá trị =1 hiển thị ngoài menu
$sqlhomecate = "SELECT name, id FROM category WHERE home = 1 ORDER BY update_at";

//Truy vấn dữ liệu trong bảng
$Categoryhome = $db->fetchsql($sqlhomecate);
$data = [];
foreach ($Categoryhome as $item) {
    $cateID = intval($item['id']); //ép kiểu về kiểu int để lọc các id
    //Chọn tất cả dữ liệu trong bảng product để gán vào mục sản phẩm
    $sql = "SELECT * FROM product WHERE category_id = $cateID ORDER BY ID DESC LIMIT 4";
    $productHome = $db->fetchsql($sql); //truy vấn vô csdl
    $data[$item['name']] = $productHome;
}
$pannel = $db->fetchAll("panel");
$count = count($db->fetchAll("panel"));

$a=1;
?>
<?php include 'header.php'?>

<h2 id="mcetoc_1e4i9liht0">TiuTiuSHOP    Khẳng định Bảo hành, ưu đãi tốt nhất:</h2>
<br>
<p>1. Thời gian BH chỉ 3-5 ngày (BHV).</p>
<p>2. Bảo hành lần 3 đổi máy khác (Duy nhất tại VN).</p>
<p>3. Khách hàng có thể BH tại mọi chi nhánh (Duy nhất tại VN).</p>
<p>4. Hỗ trợ phần mềm từ xa: 8h30 đến 20h30 (Duy nhất tại VN).</p>
<p>5. Gói bảo hành mua thêm (BHV) RẺ nhất.</p>
<p>6. Tất cả các cửa hàng đều có số điện thoại phản ánh chất lượng dịch vụ.</p>
<p>Quý khách sẽ được tặng ngay 1 triệu, nếu nhân viên phục vụ không tốt, không làm đúng quy định BH.</p>
<br>
<h3 id="mcetoc_1e4i9qnbs0"> 1. Thời gian đổi máy, bao test, chờ BH:</h3>
<p><strong>BH thường</strong>:</p>
<p>Quý khách được đổi máy (Nếu có lỗi của nhà sản xuất):  <span style="color: #ff0000;">15 ngày</span> .</p>
<p>Tặng thêm <span style="color: #ff0000;">15 ngày</span> BH đối với máy ship xa. Thời gian chờ BH máy là <span style="color: #ff0000;">5-7 ngày</span> làm việc.</p>
<p>Đổi máy khác nếu bảo hành phần cứng lần 3. Không hỗ trợ nhập lại máy.</p>
<p><strong>BH Vàng</strong>:</p>
<p>Quý khách được đổi máy (Nếu có lỗi của nhà sản xuất):  <span style="color: #ff0000;">30 ngày</span> .</p>
<p>Tặng thêm <span style="color: #ff0000;">30 ngày</span> BH đối với máy ship xa. Thời gian chờ BH máy là <span style="color: #ff0000;">3-5 ngày</span> làm việc.</p>
<p>Đổi máy khác nếu bảo hành phần cứng lần 3. Hỗ trợ nhập lại máy với giá cao.</p>
<br>
<h3 id="mcetoc_1e4ia5e7r1">2. Nội dung được BH:</h3>
<p><strong>BH thường</strong>:</p>
<p>Bảo hành 12 tháng phần cứng (<span style="color: #ff0000;"></span>).</p>
<p>Hỗ trợ giá thay thế, sửa chữa linh kiện tối đa bằng công thay thế, sửa chữa <span style="color: #ff0000;">(50-150K)</span></p>
<p><strong>BH Vàng</strong>:</p>
<p>Bảo hành 12 tháng phần cứng, <span style="color: #ff0000;">.</p>
<p>Hỗ trợ giá thay thế, sửa chữa linh kiện lên đến <span style="color: #ff0000;">1.000.000</span> cụ thể như sau:</p>
<p>- Hỗ trợ khách 100% số tiền BHV (Tối đa bằng giá sửa chữa, thay thế) nếu máy lỗi do người dùng trong 1 tháng đầu.</p>
<p>- Hỗ trợ khách 50% số tiền BHV (Tối đa bằng giá sửa chữa, thay thế) nếu máy do người dùng trong 2 tháng đầu(BHV 6 tháng) và 3 tháng đầu(BHV 12 tháng).</p>
<p>- Hỗ trợ khách 25% số tiền BHV (Tối đa bằng giá sửa chữa, thay thế) nếu máy do người dùng trong 3 tháng đầu(BHV 6 tháng) và 6 tháng đầu(BHV 12 tháng).</p>
<br>
<h3 id="mcetoc_1e4ialc1i2">3. Quà tặng:</h3>
<p><strong>BH thường</strong>:</p>
<p>Tặng nguồn .</p>
<p><strong>BH Vàng</strong>:</p>
<p>Tặng nguồn chuột, phím cơ.</p>
<p>Tặng tai nghe gameming khi mua máy mới. Nếu đã sở hữu phujkieenj quý khách sẽ đc đổi sang phụ kiện khác tương đương .</p> <br />
<p style="text-align: center;"><span style="color: #ff0000;"><strong>Cảm ơn Quý khách đã tin tưởng và ủng hộ 47SHOP . </strong></span></p>
<p style="text-align: center;"><span style="color: #ff0000;"><strong>Rất mong quý khách lựa chọn gói BHV như một hình thức bảo hiểm máy. </strong></span></p>
<p style="text-align: center;"><span style="color: #ff0000;"><strong>47SHOP  sẽ rất biết ơn khi chúng tôi có thể phục vụ khách hàng với những ưu đãi, hậu mãi tốt nhất!</strong></span></p>
<p style="text-align: center;"> </p><br />

<h3 id="mcetoc_1f2gm5q2i2">Những điểm nối bật của trung tâm sửa chữa </h3>
<p>1. Trung tâm  là hệ thống sửa chữa duy nhất ở Việt Nam có mặt song song cùng với hệ thống bán hàng.  có mặt tại tất cả các chi nhánh của 47SHOP  . Đặc biệt tất cả các mức độ sửa chữa  đầu có: Bảo hành, Phầm mềm, Unbrick, Thay thế, Sửa Main ...</p>
<p>2.  có trung tâm đào tạo học viên sửa chữa tại cả 3 miền: Bắc, Trung, Nam. Đây là điều kiện thuận lợi để chúng tôi có được đội ngũ nhân viên kỹ thuật lành nghề, có kinh nghiệm nhiều năm.</p>
<p>3. Duy nhất tại Việt Nam,  thực hiện đầy đủ quy trình: nhận test máy, sửa chữa thay thế, test máy kỹ sau khi sửa và trước khi gửi lại khách hàng.</p>
<p>4. Thông tin bảo hành và sửa máy được quản lý online. Quý khách dễ dàng cập nhật thông tin và kiểm tra lại sau này ở đường link sau: <a href="https://localhost/DoAnChuyenNganh">https://localhost/DoAnChuyenNganh</a></p>
<p>5. Tất cả các trung tâm đều có số Hotline phản ảnh chất lượng dịch vụ. Trực tiếp tổng công ty sẽ tiếp nhận và giải đáp mọi thắc mắc của Quý khách. Quý khách sẽ yên tâm tuyệt đối khi bảo hành, sửa chữa tại cửa hàng của chúng tôi.</p>
<br>
<p>Nếu còn bất cứ thắc mắc nào về dịch vụ hay bạn có gặp phải bất kỳ hư hỏng gì với thiết bị của mình, hãy liên hệ ngay với chúng tôi để được hỗ trợ tốt nhất. Hân hạnh phục vụ quý khách! <p>
<br>
<strong>Hệ thống sửa chữa  <span style="color: #ff6600;">TiuTiuSHOP   </span></strong></p>
<p><span style="color: #0000ff;">Tại TP.HCM</span></p>
Địa chỉ: 180 Cao Lỗ, phường 4, quận 8, TP.HCM <br />
Hotline: 0976374407
<?php include 'footer.php' ?>
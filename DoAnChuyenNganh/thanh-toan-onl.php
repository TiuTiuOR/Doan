<?php 
    include'autoload/autoload.php';
  //  include('PHPMailer-5.2.26/class.smtp.php');//gọi thư viện gửi mail
  // include "PHPMailer-5.2.26/class.phpmailer.php";//gọi thư viện gửi mail
    
    if(!isset($_SESSION['name_id'])){
        $_SESSION['success'] = "Bạn phải đăng nhập mới được thanh toán";
        header('location: dang-nhap.php');
        //echo "<script>alert('Đăng nhập thành viên để được thanh toán'); location=' index.php'</script> ";
    }
    else{
        $user = $db->fetchID("users",intval($_SESSION['name_id']));
    
    //kiểm tra giỏ hàng có tồn tại sản phẩm không
    if(isset($_SESSION['cart'])!= NULL && count($_SESSION['cart']) !=0){
    $data = [
                'amount' => $_SESSION['amount'],
                'users_id' => $_SESSION['name_id'],
                'order_id' => postInput('order_id'),
                'bank_code' => postInput('bank_code'),
                'note' => postInput('note')
        ];
        if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        
        //insert dữ liệu số sản phẩm
        $id_tran=$db->insert("transaction", $data);
        if($id_tran>0)
            {
            //lấy dữ liệu của giỏ hàng 
            foreach ($_SESSION['cart'] as $key => $value) {
                $data2=[
                    'transaction_id' =>$id_tran,
                    'product_id' => $key,
                    'qty' => $value['qty'],
                    'price' => $value['price']
                ];
    
                $id_insert2 = $db->insert("orders", $data2);
            }
            unset($_SESSION['cart']);
            unset($_SESSION['amount']);
            //Gửi mail đơn hàng thành công 
           $_SESSION['success'] = "Đơn đặt hàng sản phẩm thành công..!! Mọi chi tiết phản hồi xin liên hệ chúng tôi qua đường dây nóng 0985042190 hoặc email dub1710106@student.ctu.edu.vn";

           if($editcart['number']<=0)
          $_SESSION['error'] = "Sản phẩm đã hết, vui lòng lựa chọn sản phẩm khác..!";

                        ($_SESSION['tructuyen']=1);
    
          header('location:/DoAnChuyenNganh/vnpay_php/');
           //header('location:./vnpay_php/');
           
        }
    }
    }
    else
    {
   $_SESSION['error'] = "Bạn chưa có sản phẩm nên không thể thanh toán";
 header('location:./vnpay_php/');
    
    }
    }
    //Lấy thông tin của $_SESSion['name_id'] vì có lưu thông tin thành viên
    
    
    
    include'header.php';
    
    ?>
<div class="col-md-9 bor">
    <section class="box-main1">
        <h3 class="title-main" ><a href=""> Chọn ngân hàng cần thanh toán </a> </h3>
    </section>
    <form action="xulithanhtoan.php" id="create_form" method="post">

                      <div class="form-group" style="margin-top: 20px">
                        <label class="control-label col-sm-2" for="order_type">Loại thanh toán:</label>
                       <div class="col-sm-10">
                        <select name="order_type" id="order_type" class="form-control">
                            <option value="billpayment">Thanh toán hóa đơn</option>
                        </select>
                    </div>

                    </div> <br>
                  <div class="form-group" style="margin-top: 30px; display:none;">
                        <label class="control-label col-sm-2" for="order_id">Mã hóa đơn: </label>
                          <div class="col-sm-10">
                    <input class="form-control" id="order_id" readonly="" name="order_id" type="text" value="<?php echo date("YmdHis") ?>" />
                    </div>
                    </div>     <br>

                    <div class="form-group" style="margin-top: 10px;"> 
                     <label class="control-label col-sm-2"  for="amount">Số tiền: </label>        
            
                 <div class="col-sm-10"> 
                   
                <input type="amount" readonly="" class="form-control" id="amount" name="amount" value="
             <?php
            $_SESSION['amount'] = $_SESSION['tongtien'] *95/100;
            $tong = $_SESSION['amount']; 
            echo  number_format($tong, 0, '.', '.') ?> VNĐ  ">
              
             </div>  
        </div> <br>

             <div class="form-group" style="margin-top: 0px">
            <label  for="amount"> <p hidden> số tiền cần thanh toán: </p> </label>
            <div class="col-sm-20">    
                <input type="hidden" class="form-control" id="amount"
                name="amount" type="number" placeholder="số tiền cần viết liền không dấu" value="<?php  
             echo $_SESSION['amount'] ?>"/>
            </div>         
        </div>
        
            <div class="form-group" style="margin-top: -10px">
            <label class="control-label col-sm-2" for="">Nội dung:</label>
             <div class="col-sm-10">
                        <textarea class="form-control" id="order_desc" name="order_desc" rows="1">Thanh toán đơn hàng đã đặt mua...</textarea>
                    </div>
            </div> <br>

                   <div class="form-group" style="margin-top: 30px">
                        <label class="control-label col-sm-2" for="bank_code">Ngân hàng</label>
                         <div class="col-sm-10">
                        <select name="bank_code" id="bank_code" class="form-control">
                            <option value="">Không chọn</option>
                            <option value="NCB" selected> Ngân hàng NCB</option>
                            <option value="AGRIBANK"> Ngân hàng Agribank</option>
                            <option value="SACOMBANK">Ngân hàng SacomBank</option>
                            <option value="VIETINBANK">Ngân hàng Vietinbank</option>
                            <option value="HDBANK">Ngân hàng HDBank</option>
                            <option value="BIDV"> Ngân hàng BIDV</option>
                            <option value="TECHCOMBANK"> Ngân hàng Techcombank</option>

                        </select>
                    </div>
                 </div>
                  <div class="form-group" style="display: none">
                        <label for="language">Ngôn ngữ</label>
                        <select name="language" id="language" class="form-control">
                            <option value="vn">Tiếng Việt</option>
                            <option value="en">English</option>
                        </select>
                    </div>
                <div class="row" style="display: none">
                        <div class="form-group">
                            <label>Thời hạn thanh toán</label>
                            <input class="form-control" id="txtexpire" name="txtexpire" type="text" value="<?php echo $expire; ?>" />
                        </div>
                        <div class="form-group">
                            <h3>Thông tin hóa đơn (Billing)</h3>
                        </div>
                        <div class="form-group">
                            <label>Họ tên (*)</label>
                            <input class="form-control" id="txt_billing_fullname" name="txt_billing_fullname" type="text" value="NGUYEN VAN XO" />
                        </div>
                        <div class="form-group">
                            <label>Email (*)</label>
                            <input class="form-control" id="txt_billing_email" name="txt_billing_email" type="text" value="xonv@vnpay.vn" />
                        </div>
                        <div class="form-group">
                            <label>Số điện thoại (*)</label>
                            <input class="form-control" id="txt_billing_mobile" name="txt_billing_mobile" type="text" value="0934998386" />
                        </div>
                        <div class="form-group">
                            <label>Địa chỉ (*)</label>
                            <input class="form-control" id="txt_billing_addr1" name="txt_billing_addr1" type="text" value="22 Lang Ha" />
                        </div>
                        <div class="form-group">
                            <label>Mã bưu điện (*)</label>
                            <input class="form-control" id="txt_postalcode" name="txt_postalcode" type="text" value="100000" />
                        </div>
                        <div class="form-group">
                            <label>Tỉnh/TP (*)</label>
                            <input class="form-control" id="txt_bill_city" name="txt_bill_city" type="text" value="Hà Nội" />
                        </div>
                        <div class="form-group">
                            <label>Bang (Áp dụng cho US,CA)</label>
                            <input class="form-control" id="txt_bill_state" name="txt_bill_state" type="text" value="" />
                        </div>
                        <div class="form-group">
                            <label>Quốc gia (*)</label>
                            <input class="form-control" id="txt_bill_country" name="txt_bill_country" type="text" value="VN" />
                        </div>
                        <div class="form-group">
                            <h3>Thông tin giao hàng (Shipping)</h3>
                        </div>
                        <div class="form-group">
                            <label>Họ tên (*)</label>
                            <input class="form-control" id="txt_ship_fullname" name="txt_ship_fullname" type="text" value="Nguyễn Thế Vinh" />
                        </div>
                        <div class="form-group">
                            <label>Email (*)</label>
                            <input class="form-control" id="txt_ship_email" name="txt_ship_email" type="text" value="vinhnt@vnpay.vn" />
                        </div>
                        <div class="form-group">
                            <label>Số điện thoại (*)</label>
                            <input class="form-control" id="txt_ship_mobile" name="txt_ship_mobile" type="text" value="0123456789" />
                        </div>
                        <div class="form-group">
                            <label>Địa chỉ (*)</label>
                            <input class="form-control" id="txt_ship_addr1" name="txt_ship_addr1" type="text" value="Phòng 315, Công ty VNPAY, Tòa nhà TĐL, 22 Láng Hạ, Đống Đa, Hà Nội" />
                        </div>
                        <div class="form-group">
                            <label>Mã bưu điện (*)</label>
                            <input class="form-control" id="txt_ship_postalcode" name="txt_ship_postalcode" type="text" value="1000000" />
                        </div>
                        <div class="form-group">
                            <label>Tỉnh/TP (*)</label>
                            <input class="form-control" id="txt_ship_city" name="txt_ship_city" type="text" value="Hà Nội" />
                        </div>
                        <div class="form-group">
                            <label>Bang (Áp dụng cho US,CA)</label>
                            <input class="form-control" id="txt_ship_state" name="txt_ship_state" type="text" value="" />
                        </div>
                        <div class="form-group">
                            <label>Quốc gia (*)</label>
                            <input class="form-control" id="txt_ship_country" name="txt_ship_country" type="text" value="VN" />
                        </div>
                        <div class="form-group">
                            <h3>Thông tin gửi Hóa đơn điện tử (Invoice)</h3>
                        </div>
                        <div class="form-group">
                            <label>Tên khách hàng</label>
                            <input class="form-control" id="txt_inv_customer" name="txt_inv_customer" type="text" value="Lê Văn Phổ" />
                        </div>
                        <div class="form-group">
                            <label>Công ty</label>
                            <input class="form-control" id="txt_inv_company" name="txt_inv_company" type="text" value="Công ty Cổ phần giải pháp Thanh toán Việt Nam" />
                        </div>
                        <div class="form-group">
                            <label>Địa chỉ</label>
                            <input class="form-control" id="txt_inv_addr1" name="txt_inv_addr1" type="text" value="22 Láng Hạ, Phường Láng Hạ, Quận Đống Đa, TP Hà Nội" />
                        </div>
                        <div class="form-group">
                            <label>Mã số thuế</label>
                            <input class="form-control" id="txt_inv_taxcode" name="txt_inv_taxcode" type="text" value="0102182292" />
                        </div>
                        <div class="form-group">
                            <label>Loại hóa đơn</label>
                            <select name="cbo_inv_type" id="cbo_inv_type" class="form-control">
                                <option value="I">Cá Nhân</option>
                                <option value="O">Công ty/Tổ chức</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input class="form-control" id="txt_inv_email" name="txt_inv_email" type="text" value="pholv@vnpay.vn" />
                        </div>
                        <div class="form-group">
                            <label>Điện thoại</label>
                            <input class="form-control" id="txt_inv_mobile" name="txt_inv_mobile" type="text" value="02437764668" />
                        </div>
                   
                    </div> <br>

                            
                    <div class="form-group" style="margin-top: 30px; margin-bottom: 20px;">
                  
                        <div class="row ">
                           
                           <div class="col-sm-offset-9 col-sm-3">
                     <button type="submit" name='redirect' id='redirect' class="btn btn-primary text-right" > Xác nhận </button>

                            </div>
                        </div>
                    </div>
</form>

</div>
<?php include'footer.php'; ?>
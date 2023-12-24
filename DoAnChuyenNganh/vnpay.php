<?php
//session_start();

   include 'autoload/autoload.php';
  
  $id = intval(getInput('id'));

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
                'note' => postInput('note'),
                'diachi' => postInput('diachi'),
                'sdt' => postInput('sdt'),
                 'email' => postInput('email'),
                  'bank_code' => postInput('bank_code'),
                  'ten' => postInput('ten'),
                'tructuyen' => 1
        ];

         $data1 = [
                'amount' => $_SESSION['amount'],
                'users_id' => $_SESSION['name_id'],
                'note' => postInput('note'),
                'diachi' => postInput('diachi'),
                'sdt' => postInput('sdt'),
                 'email' => postInput('email'),
                  'bank_code' => postInput('bank_code'),
                  'ten' => postInput('ten'),
                
        ];

        if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        
        //insert dữ liệu số sản phẩm
        $id_tran=$db->insert("transaction", $data);
        $vnpay= $db-> insert("vnpay", $data1);
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
            
              ($_SESSION['tructuyen']=1);
    
           // $_SESSION['success'] = "Lưu đơn hàng thành công ..!";
           header('location: ./kt-don-hang.php');
         
            unset($_SESSION['cart']);
            unset($_SESSION['amount']);
        }
    }
    }
        else
    {
     $_SESSION['error'] = "Bạn chưa có sản phẩm nên không thể thanh toán";
    header('location:/DoAnChuyenNganh/gio-hang.php');
    
    }
    }
    
   // include'header.php';
    
    ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>Tạo mới đơn hàng</title>
    <!-- Bootstrap core CSS -->
    <link href="/vnpay_php/assets/bootstrap.min.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="/vnpay_php/assets/jumbotron-narrow.css" rel="stylesheet">
    <script src="/vnpay_php/assets/jquery-1.11.3.min.js"></script>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

<body>
    <?php  require_once("config_vnpay.php");
  
   
   
    
    $amount = isset($_POST['price']) ? $_POST['price'] : '';
    $hienthi = isset($_POST['price']) ? $_POST['price'] : '';
  
    $account = isset($_POST['account']) ? $_POST['account'] : '';
    //
  //  $sql = "select * from khachhang where kh_trangthai='1'";
  //$result = mysqli_query($conn, $sql);
  // $rowtt = mysqli_fetch_array($result, MYSQLI_ASSOC);


    ?>
    <!-- start header -->
    <nav style="background-color: royalblue;height: 30px;" class="navbar navbar-expand-lg navbar-dark ">
        <div class="container">
           
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
           
        </div>
    </nav>

    <!-- header -->
    
  
        <div class="row">
            <div class="col-md-5" style="margin-left: 100px;">
                <div class="panel panel-default">
                    <!-- panel panel-default Begin -->
                    <div class="panel-body">
                        <!-- panel-body Begin -->
                        <div class="header clearfix">
                         <h3 class="text-muted text-center"> Thông tin khách hàng</h3>
                        </div>
                    
 <form class="form-horizontal" action="" method="POST">
            <div class="form-group" style="margin-left: 50px;margin-top: -20px;"  >
                <label class="control-label col-sm-4" style="text-align: left" for="ten">Tên khách hàng</label>
            
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="ten" placeholder="Tên khách hàng" name="ten" value="<?php echo $user['account'] ?>">
                </div> 
            </div>  
            <br>

            <div class="form-group" style="margin-top: -20px;margin-left: 50px;">           
                <label class="control-label col-sm-3" style="text-align: left" for="sdt">Số điện thoại:</label> 
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="sdt" placeholder="Nhập số điện thoại" name="sdt" value="<?php echo $user['phone'] ?>">
                </div> 
            </div> 
            <br>

            <div class="form-group" style="margin-top: -20px;margin-left: 50px;"> 
                <label class="control-label col-sm-3" style="text-align: left"  for="email">Email:</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="email" placeholder="Nhập email" name="email"value="<?php echo $user['email'] ?>">
                </div>
            </div>
            <br>

            <div class="form-group" style="margin-top:-20px;margin-left: 50px;"> 
                <label class="control-label col-sm-3" style="text-align: left" for="diachi">Địa chỉ:</label>
                <div class="col-sm-10">
                    <input type="diachi" class="form-control" id="diachi" placeholder="Nhập địa chỉ" name="diachi"value="<?php echo $user['address'] ?>">
                </div>
                    </div>


                    </div>

                </div>
            </div>


            <div class="col-md-5 ">
                <div >  
                    <h3 class="text-muted text-center">Thanh toán VNPAY</h3>
                </div>
                <form action="" id="create_form" method="post">

                    <div class="form-group" style="margin-top:20px;">
                        <label for="language"><b> Loại thanh toán </b> </label>
                        <select name="order_type" id="order_type" class="form-control">
                            <option value="billpayment">Thanh toán hóa đơn</option>
                         
                        </select>
                    </div>
                    <div class="form-group" style="display: none">
                        <label for="order_id"> Mã hóa đơn</label>
                        <input  class="form-control" id="order_id" readonly="" name="order_id" type="text" value="<?php echo date("YmdHis") ?>" />
                      
                    </div>     

                    <div class="form-group" style="margin-top: 15px;margin-left: -15px;"> 
     <label class="control-label col-sm-5" style="text-align: left"  for="amount" >Số tiền cần thanh toán: </label>        
            
            <div class="col-sm-5"> 
                <span class="badge">
                   
                <input type="amount" readonly="" class="form-control" id="amount" name="amount" value="
             <?php
            $_SESSION['amount'] = $_SESSION['tongtien'] *95/100;
            $tong = $_SESSION['amount']; 
            echo  number_format($tong, 0, '.', '.') ?> VNĐ">
              </span>
             </div>  
        </div>

  <div class="form-group" >
            <label  for="amount"> <p hidden> Số tiền cần thanh toán: </p> </label>
            <div class="col-sm-20">    
                <input type="hidden" class="form-control" id="amount"
                name="amount" type="number" placeholder="số tiền cần viết liền không dấu" value="<?php  
             echo $_SESSION['amount'] ?>"/>
            </div>         
        </div>
        

                    <div class="form-group">
                        <label for="order_desc">Nội dung thanh toán</label>
                        <textarea class="form-control" cols="20" id="order_desc" name="order_desc" rows="2">Thanh toán đơn hàng đã đặt mua</textarea>
                    </div>


                    <div class="form-group">
                        <label for="bank_code">Ngân hàng</label>
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

                            

                    <div class="form-group">
                        <div class="row ">
                            <div class="col-md-9"></div>
                            <div class="col-md-3">
                     <button type="submit" name='redirect' id='redirect' class="btn btn-primary text-right" > Xác nhận </button>

                            </div>
                        </div>
                    </div>
</form>

                </form>
            
            <hr class="muted-text">
        </strong>
        <!-- ---------------------------------------------->

    </div>
    <!-- footer-start -->
    <div class="container">
        <?php
      //  include_once __DIR__ . '/../layout/partials/footer.php';
        ?>
    </div>
    <!-- footer-end-->




</body>

</html>
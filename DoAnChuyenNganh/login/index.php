<?php 
    //Ở đây không sử dụng autoload bởi vì khi gọi đến sẽ bị lặp lại vô hạn
    session_start();//Khai báo session, nếu không khai báo thì session không hoạt động
    include_once'../admin/autoload/dtbase.php';
    include_once'../admin/autoload/ftion.php';
    $db = new Database;
    // khai báo mảng data
    $data=[
            'name' => postInput('name'),
            'password' => postInput('password')
        ];
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
    
        // bắt lỗi
        $error =[];
        if(postInput('name')=='')
        {
            $error['name'] = "Bạn cần nhập tên đăng nhập";
        }
        if(postInput('password')=='')
        {
            $error['password'] = "Bạn chưa nhập mật khẩu";
        }
        //Nếu tồn tại mảng error
        if(empty($error))
        {   
            
            $check_admin = $db->fetchOne("admin","name='".$data['name']."'AND password ='".md5($data['password'])."'");
            if ($check_admin != null) {
            $_SESSION['admin_user']  = $check_admin['name'];
                $_SESSION['admin_id']    = $check_admin['id'];
                header('location:../admin/');
                
    
            }   
            else
            {
                $_SESSION['error']="Sai tên tài khoản hoặc mật khẩu";
            }   
        }
    
    }
    
     ?>
<link rel="icon" href="../public/frontend/images/logo_header1.png" type="image/x-icon">
<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<style type="text/css">
    /*    --------------------------------------------------
    :: Login Section
    -------------------------------------------------- */
    #login {
    padding-top: 50px
    }
    #login .form-wrap {
    width: 30%;
    margin: 0 auto;
    }
    #login h1 {
    color: #1fa67b;
    font-size: 18px;
    text-align: center;
    font-weight: bold;
    padding-bottom: 20px;
    }
    #login .form-group {
    margin-bottom: 25px;
    }
    #login .checkbox {
    margin-bottom: 20px;
    position: relative;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    -o-user-select: none;
    user-select: none;
    }
    #login .checkbox.show:before {
    content: '\e013';
    color: #1fa67b;
    font-size: 17px;
    margin: 1px 0 0 3px;
    position: absolute;
    pointer-events: none;
    font-family: 'Glyphicons Halflings';
    }
    #login .checkbox .character-checkbox {
    width: 25px;
    height: 25px;
    cursor: pointer;
    border-radius: 3px;
    border: 1px solid #ccc;
    vertical-align: middle;
    display: inline-block;
    }
    #login .checkbox .label {
    color: #6d6d6d;
    font-size: 13px;
    font-weight: normal;
    }
    #login .btn.btn-custom {
    font-size: 14px;
    margin-bottom: 20px;
    }
    #login .forget {
    font-size: 13px;
    text-align: center;
    display: block;
    }
    /*    --------------------------------------------------
    :: Inputs & Buttons
    -------------------------------------------------- */
    .form-control {
    color: #212121;
    }
    .btn-custom {
    color: #fff;
    background-color: #1fa67b;
    }
    .btn-custom:hover,
    .btn-custom:focus {
    color: #fff;
    }
    /*    --------------------------------------------------
    :: Footer
    -------------------------------------------------- */
    #footer {
    color: #6d6d6d;
    font-size: 12px;
    text-align: center;
    }
    #footer p {
    margin-bottom: 0;
    }
    #footer a {
    color: inherit;
    }
</style>
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="form-wrap">
                    <h1>Đăng nhập vào tài khoản Admin</h1>
                    <?php if(isset($_SESSION['success'])): ?>
                    <!--Thông báo thành công từ đăng ký-->
                    <div class="alert alert-success">
                        <strong style="color: green"><?php echo $_SESSION['success'];unset($_SESSION['success']) ?></strong> 
                    </div>
                    <?php endif ?>
                    <?php if(isset($_SESSION['error'])): ?>
                    <!--Thông báo không thành công-->
                    <div class="alert alert-danger">
                        <strong style="color: red"><?php echo $_SESSION['error'];unset($_SESSION['error']) ?></strong> 
                    </div>
                    <?php endif ?>
                    <form role="form" action="" method="POST" id="login-form" autocomplete="off">
                        <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="text" class="form-control" id="name" placeholder="Nhập tên đăng nhập" name="name" value="<?php echo $data['name'] ?>" required="">
                            <?php if(isset($error['name'])): ?>
                            <p class="text-danger"><?php echo $error['name'];?></p>
                            <?php endif ?>
                        </div>
                        <div class="form-group">
                            <label for="key" class="sr-only">Password</label>
                            <input type="password" class="form-control" id="pwd" placeholder="Nhập mật khẩu" name="password" required="" >
                            <?php if(isset($error['password'])): ?>
                            <p class="text-danger"><?php echo $error['password'];?></p>
                            <?php endif ?>
                        </div>
                        
                        <input type="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Đăng nhập">
                    </form>
                    <a href="javascript:;" class="forget" data-toggle="modal" data-target=".forget-modal"></a>
                    <hr>
                </div>
            </div>
            <!-- /.col-xs-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</section>
<div class="modal fade forget-modal" tabindex="-1" role="dialog" aria-labelledby="myForgetModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                <span aria-hidden="true">×</span>
                <span class="sr-only">Đóng</span>
                </button>
                <h4 class="modal-title">Khôi phục mật khẩu</h4>
            </div>
            <div class="modal-body">
                <p>Nhập tài khoản email của bạn</p>
                <input type="email" name="recovery-email" id="recovery-email" class="form-control" autocomplete="off">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-custom">Khôi phục</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<footer id="footer">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                
            </div>
        </div>
    </div>
</footer>
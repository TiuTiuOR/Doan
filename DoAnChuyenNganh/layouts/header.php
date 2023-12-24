
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="../public/frontend/images/—Pngtree—wolf logo_2306634.png" type="image/x-icon">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Trang Admin</title>
        <!-- Bootstrap Core CSS -->
        <link href="<?php echo base_url()?>public/admin/css/bootstrap.min.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="<?php echo base_url()?>public/admin/css/sb-admin.css" rel="stylesheet">
        <!-- Custom Fonts -->
        <link href="<?php echo base_url()?>public/admin/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!-- [if lt IE 9]> -->
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <!-- <![endif] -->
    </head>
    <body>
        <div id="wrapper">
            <!-- Navigation -->
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header col-sm-6">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    </button>
                    <a  class="navbar-brand" href="http://localhost/DoAnChuyenNganh/index.php" target="_blank">VỀ TRANG MUA HÀNG</a>
                </div>
                <!-- Top Menu Items -->
                <ul class="nav navbar-right top-nav">
                    <li class="">
                        <a href="#" class="" data-toggle=""> <b class=""></b></a>
                        <ul class="dropdown-menu message-dropdown">
                            <li class="">
                                <a href="#">
                                    <div class="media">
                                        <span class="pull-left">
                                        <img class="media-object" src="http://placehold.it/50x50" alt="">
                                        </span>
                                        <div class="">
                                            
                                        </div>
                                    </div>
                                </a>
                            </li>
                            
                            <li class="message-footer">
                                <a href="#"></a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class=""></i> <b class=""></b></a>
                        <ul class="dropdown-menu alert-dropdown">
                            <li>
                               
                            <li class="divider"></li>
                            <li>
                                <a href="#"></a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $_SESSION['admin_user'] ?> <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="<?php echo base_url() ?>login/thoat.php"><i class="fa fa-fw fa-power-off"></i> Thoát</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav side-nav">
                        <li>
                            <a href="/DoAnChuyenNganh/admin"><i class="fa fa-fw fa-dashboard"></i> Bảng điều khiển</a>
                        </li>
                        <li class="<?php echo isset($open) && $open=='page'? 'active': '' ?>">
                            
                        </li>
                        <!--active mục-->
                        <li class="<?php echo isset($open) && $open=='category'? 'active': '' ?>">
                            <a href="<?php echo modules('category')?>"><span class="glyphicon glyphicon-tasks"></span> Danh sách danh mục</a>
                        </li>
                        <li class="<?php echo isset($open) && $open=='product'? 'active': '' ?>">
                            <a href="<?php echo modules('product')?>"><span class="glyphicon glyphicon-align-justify"></span> Sản phẩm</a>
                        </li>
                        <li class="<?php echo isset($open) && $open=='admin'? 'active': '' ?>">
                            <a href="<?php echo modules('admin')?>"><i class="fa fa-user"></i> Admin</a>
                        </li>

                        <li class="<?php echo isset($open) && $open=='users'? 'active': '' ?>">
                            <a href="<?php echo modules('users')?>"><i class="fa fa-users"></i> Users</a>
                        </li>    

                        <li class="<?php echo isset($open) && $open=='comment'? 'active': '' ?>">
                            <a href="<?php echo modules('comment')?>"><i class="fa fa-users"></i> Bình luận</a>
                        </li>

                       

                        <li class="<?php echo isset($open) && $open=='transaction'? 'active': '' ?>">
                            <a data-toggle="collapse" data-target="#demo1" href="#"><i class="fa fa-clipboard"></i> Đơn hàng <i class="fa fa-fw fa-caret-down"></i></a>
                            
                            <ul id="demo1" class="collapse">
                                <li>
                                    <a href="<?php echo admin_trans('transaction')?>">Danh sách đơn hàng</a>
                                </li>
                                <li>
                                    <a href="<?php echo admin_trans('transaction/')?>dhchuaxuly.php">Đơn hàng chưa xử lý</a>
                                </li>
                                <li>
                                    <a href="<?php echo admin_trans('transaction/')?>dhdaxuly.php">Đơn hàng đã xử lý</a>
                                </li>
                                <li>
                                    <a href="<?php echo admin_trans('transaction/')?>dhhuy.php">Đơn hàng đã hủy</a>
                                </li>
                            </ul>
                        </li>
                        <li class="<?php echo isset($open) && $open=='thongke'? 'active': '' ?>">
                            <a data-toggle="collapse" data-target="#demo2" href="#"><i class="fa fa-clipboard"></i> Thống kê <i class="fa fa-fw fa-caret-down"></i></a>
                            
                            <ul id="demo2" class="collapse">
                                <li>
                                    <a href="<?php echo admin_trans('thongke/')?>dsthanhtoan.php">Thanh toán</a>
                                </li>
                                <!-- <li>
                                    <a href="<?php echo admin_trans('thongke/')?>chiphi.php">Chi phí</a>
                                </li> -->
                            </ul>
                        </li>
                        <li class="<?php echo isset($open) && $open=='manager'? 'active': '' ?>">
                            <a href="#" data-toggle="collapse" data-target="#demo"><i class="fa fa-cogs"></i> Quản lý kho <i class="fa fa-fw fa-caret-down"></i></a>
                            
                            <ul id="demo" class="collapse">
                                <li>
                                    <a href="<?php echo admin_trans('quanlykho/')?>mathangsaphet.php">Sản phẩm sắp hết</a>
                                </li>
                                <li>
                                    <a href="<?php echo admin_trans('quanlykho/')?>spbanchay.php">Sản phẩm bán chạy</a>
                                </li>
                                <li>
                                    <a href="<?php echo admin_trans('quanlykho/')?>spxemnhieu.php">Sản phẩm xem nhiều</a>
                                </li>
                            </ul>
                        </li>
                        
                        <li class="<?php echo isset($open) && $open =='setting'?'active':'' ?>">
                            <a href="<?php echo admin_trans('setting')?>"><i class="fa fa-cogs"></i> Cài đặt </a>
                        </li>
                        
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </nav>
            <div id="page-wrapper">
                <div class="container-fluid">
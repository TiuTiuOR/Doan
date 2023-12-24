<?php 
    if(isset($_SESSION['name_id'])){
    $id=intval($_SESSION['name_id']);
    $sql=$db->fetchID("users",$id);
    $name = $sql['name'];
    }
    
    
     ?>
<!DOCTYPE html>
<html>
    <head>
        <title> TiuTiu SHOP</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="./public/frontend/images/—Pngtree—wolf logo_2306634.png" type="image/x-icon">
        <link rel="stylesheet" type="text/css" href="public/frontend/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="public/frontend/css/bootstrap.min.css">
        <script  src="public/frontend/js/jquery-3.2.1.min.js"></script>
        <script  src="public/frontend/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="public/frontend/css/slick.css"/>
        <link rel="stylesheet" type="text/css" href="public/frontend/css/slick-theme.css"/>
        <!--slide-->
        <link rel="stylesheet" type="text/css" href="public/frontend/css/style.css">
        <link rel="stylesheet" type="text/css" href="public/frontend/css/notify.js">
        <!-- botchat -->
        <script type="text/javascript" src="https://ahachat.com/customer-chats/customer_chat_BUpG9cVDjd652fa4783e2cf.js"></script>
        <style>
            th{
                font-weight: bold;
                text-align: center;
            }

            tr{
                text-align: center;

            }

            body {
                background-image:url(./public/frontend/images/brg_body.jpg);
                background-size: 100%;
            }
            
            .navbar-default,
            #header{
                background-image:url(./public/frontend/images/bg1.jpg)
            }
        </style>
    </head>
    <body>
        <div id="wrapper">
        <!---->            <!--HEADER-->
        <nav class="navbar navbar-default" >
            <div class="container-fluid">
                
                <ul class="nav navbar-nav navbar-right">
                    <?php if(isset($_SESSION['name_id'])): ?>
                    <li style="color: #111;border-right: 1px solid #928f8f;padding-right: 10px;border-top-width: 5px;margin-top: 5px;border-left-width: 1px;">
                        Xin chào: <?php echo $name ?>
                    </li>
                    <li><a href="kt-don-hang.php"><span class="glyphicon glyphicon-edit"></span> Kiểm tra đơn hàng</a></li>
                    <li><a href="gio-hang.php"><span class="glyphicon glyphicon-shopping-cart"></span> Giỏ hàng</a></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span> Tài khoản
                        <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="users.php">Thông tin</a></li>
                            <li><a href="thoat.php"><i class="fa fa-share-square-o"></i> Thoát</a></li>
                        </ul>
                    </li>
                    <?php else: ?>
                    <li><a href="gio-hang.php"><span class="glyphicon glyphicon-shopping-cart"></span> Giỏ hàng</a></li>
                    <li><a href="dang-nhap.php"><span class="glyphicon glyphicon-log-in"></span> Đăng nhập</a></li>
                    <li><a href="dang-ky.php"><span class="glyphicon glyphicon-user"></span> Đăng ký</a></li>
                    <?php endif ?>
                </ul>
            </div>
        </nav>
        <div class="col-md-2">
            <a href="index.php">
                <img style="padding-left: 100px;" width="90%" height="100%" src="./public/frontend/images/—Pngtree—wolf logo_2306634.png" alt="logo 47SHOP">
            </a>
        </div>
        <div id="header" style=" height: 100px">
            <div class="container">
                <div class="row" id="header-main">
                    <div>
                        <div class="col-sm-8">
                            <form class="navbar-form navbar-right" action="search.php" method="GET">
                                <div class="input-group" style="width: 760px;">
                                    <input type="text" class="form-control" style="border-radius: 5px" name="search" placeholder="Tìm kiếm sản phẩm...">
                                    <div class="input-group-btn" style="width:40px">
                                        <button class="btn btn-default" style="background: #beccf2; padding-bottom: 3px; padding-left: 20px" type="submit">
                                            <i class="glyphicon glyphicon-search" style="color: #fff "></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                            </div>
                        </ul>    
                    </div>

                    <div class="col-md-2" id="header-right">
                        <div class="pull-right">
                            <div class="pull-left">
                                <img class  = "contact" style="margin-right: 5px;margin-top: 5px;" src="public/frontend/images/contact.png">
                            </div>
                            <div class="pull-right">
                                <p id="hotline" style="color: #fff"> HOTLINE</p>
                                <p style="color: #fff"> 0976374407</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--END HEADER-->
        <!--MENUNAV-->
        <div id="menunav" >
            <div class="container">
                <nav class="navbar navbar-inverse" style="background: #f3eada">
                    <div class="container-fluid">
                        <div class="col-md-2"></div>
                        <div class="col-sm-8">
                        <ul class="nav navbar-nav">
                            <li><a href="index.php">TRANG CHỦ</a></li>
                            <?php foreach ($page as $item): ?>
                            <li><a href="page.php?id=<?php echo $item['id'] ?>"><?php echo $item['name'] ?></a></li>
                            <?php endforeach ?>
                          
                            <li><a href="lienhe.php">LIÊN HỆ</a></li>
                        </div>
                        
                    </div>
                </nav>
            </div>
        </div>
        <!--ENDMENUNAV-->
        <div id="maincontent">
            <div class="container">
                <div class="col-md-3  fixside" >
                    <!-- <div class="box-left box-menu" >
                        <h3 class="box-title"><i class="fa fa-list"></i>  Danh mục</h3>
                        <ul>
                            <?php foreach($category as $item): ?>
                            <li>                                 
                                <a href="danh-muc-sp.php?id=<?php echo $item['id']?>"><?php echo $item['name']?> </a>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div> -->

                    <div class="box-left box-menu">
                        <h3 class="box-title"><i class="fa fa-warning"></i>  Sản phẩm mới </h3>
                        
                        <ul>
                            
                            <?php foreach($productNew as $item): ?>
                            <li class="clearfix">
                                <a href="chi-tiet-sp.php?id=<?php echo $item['id'] ?>">
                                    <img src="<?php echo uploads()?>/product/<?php echo $item['thumbal'] ?>" class="img-responsive pull-left" width="80" height="80">
                                    <div class="info pull-right">
                                        <p class="name"> <?php echo $item['name'] ?></p >
                                        <b class="price">
                                            Giá: 
                                            <?php if($item['sale']>0): ?>
                                            <!--Giá-->
                                            <b class="price"><?php echo saleprice($item['price'],$item['sale']); ?></b>
                                            <p><strike class="sale"><?php echo formatprice($item['price']); ?></strike>     
                                            </p>
                                            <?php else: ?>
                                            <b class="price"><?php echo saleprice($item['price'],$item['sale']); ?></b>
                                            <?php endif ?>
                                        </b>
                                        <br>
                                        <b class="">Số lượng:  <?php echo $item['number'] ?></b><br>
                                        
                                    </div>
                                </a>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                        <!-- </marquee> -->
                    </div>
                    <div class="box-left box-menu">
                        <h3 class="box-title"><i class="fa fa-warning"></i>  Sản phẩm bán chạy </h3>
                        <ul>
                            <?php foreach($productpay as $item): 
                                //productpay nằm ở autoload?>
                            <li class="clearfix">
                                <a href="chi-tiet-sp.php?id=<?php echo $item['id'] ?>">
                                    <img src="<?php echo uploads()?>/product/<?php echo $item['thumbal'] ?>" class="img-responsive pull-left" width="80" height="80">
                                    <div class="info pull-right">
                                        <p class="name"> <?php echo $item['name'] ?></p >
                                        <b class="price">
                                            Giá:
                                            <?php if($item['sale']>0): ?>
                                            <!--Giá-->
                                            <b class="price"><?php echo saleprice($item['price'],$item['sale']); ?></b>
                                            <p><strike class="sale"><?php echo formatprice($item['price']); ?></strike>     
                                            </p>
                                            <?php else: ?>
                                            <b class="price"><?php echo saleprice($item['price'],$item['sale']); ?></b>
                                            <?php endif ?>
                                        </b>
                                        <br>
                                        <b class="">Số lượng:  <?php echo $item['number'] ?></b><br>
                                        
                                    </div>
                                </a>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                        <!-- </marquee> -->
                    </div>

                    <div class="box-left box-menu">
                        <h3 class="box-title"><i class="fa fa-warning"></i>  Hỗ trợ trực tuyến </h3>
                         <!-- <marquee direction="down" onmouseover="this.stop()" onmouseout="this.start()"  > -->
                            <ul>
                                
                                <div class="panel-body"><p><span class="glyphicon glyphicon-map-marker"></span> 180 Cao Lỗ, phường 4, quận 8, TP.HCM</p></div>
                                <div class="panel-body"> <p><span class="glyphicon glyphicon-phone"></span> Phone: 0976374407</p></div>
                                <div class="panel-body"><p><span class="glyphicon glyphicon-envelope"></span> Email: DH52001832@student.stu.edu.vn</p></div>
                                <div class="panel-body"><p><span class="glyphicon glyphicon-link"></span> Facebook: <a href="https://www.facebook.com/groups/1426681154558323" target="_blank">TiuTiuSHOP</a></p></div>

                            </ul>
                        <!-- </marquee> -->
                    </div>
                </div>
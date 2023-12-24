<?php 
    include_once'autoload/autoload.php';
    include_once'../layouts/header.php';
    include'transaction/chuaxuly.php';
   
  
 ?>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Xin chào bạn đến với trang quản trị của admin
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i>  <a href="../../index.php">Bảng điều khiển</a>
            </li>
            <li class="active">
                <i class="fa fa-file"></i> Quản trị Admin
            </li>
        </ol>
    </div>
     <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-archive fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $sumproduct ?></div>
                                        <div>Sản phẩm!</div>
                                    </div>
                                </div>
                            </div>
                            <a href="modules/product/">
                                <div class="panel-footer">
                                    <span class="pull-left">Xem thêm</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-group fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $summember ?></div>
                                        <div>Thành viên</div>
                                    </div>
                                </div>
                            </div>
                            <a href="modules/users">
                                <div class="panel-footer">
                                    <span class="pull-left">Xem thêm</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-group fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $summember ?></div>
                                        <div>Bình luận</div>
                                    </div>
                                </div>
                            </div>
                            <a href="modules/comment">
                                <div class="panel-footer">
                                    <span class="pull-left">Xem thêm</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>


                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-shopping-cart fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $admin ?></div>
                                        <div>Tổng đơn hàng</div>
                                    </div>
                                </div>
                            </div>
                            <a href="transaction">
                                <div class="panel-footer">
                                    <span class="pull-left">Xem thêm</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-support fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php 
                                        echo $total ?></div>
                                        <div>Đơn hàng chưa xử lý !</div>
                                    </div>
                                </div>
                            </div>
                            <a href="transaction/index.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Xem thêm</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>

                    
                    
                     <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-align-center fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $saphet ?></div>
                                        <div>Sản phẩm sắp hết</div>
                                    </div>
                                </div>
                            </div>
                            <a href="quanlykho/mathangsaphet.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Xem thêm</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-desktop fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $daxl ?></div>
                                        <div>Đơn hàng đã xử lý</div>
                                    </div>
                                </div>
                            </div>
                            <a href="transaction/dhdaxuly.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Xem thêm</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                     <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file-excel-o fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php 
                                        echo $huy ?></div>
                                        <div>Đơn hàng đã hủy !</div>
                                    </div>
                                </div>
                            </div>
                            <a href="transaction/dhhuy.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Xem thêm</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    
                </div>
                <!-- /.row -->
</div>

<!-- /.row -->
<?php include_once'../layouts/footer.php'?>
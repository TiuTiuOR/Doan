<?php
    session_start();//Khai báo session, nếu không khai báo thì session không hoạt động
    include_once'dtbase.php';
    include_once'ftion.php';
        $db = new Database;
    
        define("ROOT",$_SERVER['DOCUMENT_ROOT']."/public/uploads/");
    if (!isset($_SESSION['admin_id'])) {
            header('location: ../login');
        }
     ?>
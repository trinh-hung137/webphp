<?php
    include('../config/constants.php');
    //b1. Hủy quá trình
    session_destroy();

    //b2. chuyển hướng trang đến login.php
    header("location:".SITEURL.'admin/login.php');

?>
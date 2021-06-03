<?php
session_start();
include('server.php');
$requestid = $_GET['id'];
$userid = $_SESSION['userid'];
$sql ="UPDATE request SET time = CURRENT_TIMESTAMP,requeststatus='C'
        WHERE requestid = '$requestid'AND userid='$userid'";
mysqli_query($conn,$sql);
header('location: show_request.php');

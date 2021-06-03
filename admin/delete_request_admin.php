<?php
session_start();
include('server.php');
$requestid = $_GET['id'];
$sql = "DELETE FROM request  WHERE requestid = '$requestid' ";
mysqli_query($conn,$sql);
header('location: show_request_admin.php');

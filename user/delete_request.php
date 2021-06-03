<?php
session_start();
include('server.php');
$requestid = $_GET['id'];
$userid = $_SESSION['userid'];
$sql = "DELETE FROM request  WHERE requestid = '$requestid' AND userid =$userid ";
mysqli_query($conn,$sql);
header('location: show_request.php');

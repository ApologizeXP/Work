<?php
include('server.php');

if(isset($_GET['id'])){
    $requestid = $_GET['id'];
    $sql = "SELECT * FROM request WHERE requestid = $requestid ";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    header('location: ../files/'.$row['file']);
    
}

?>
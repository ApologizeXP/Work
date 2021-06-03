<?php

session_start();
include('server.php');

$errors = array();
$requestid = $_POST['requestid'];
if(isset($_POST['request_edit'])){
    $request = mysqli_real_escape_string($conn,$_POST['request']);
    $number1 = mysqli_real_escape_string($conn,$_POST['number1']);
    $number2 = mysqli_real_escape_string($conn,$_POST['number2']);
    $number3 = mysqli_real_escape_string($conn,$_POST['number3']);
    $number4 = mysqli_real_escape_string($conn,$_POST['number4']);
    $number5 = mysqli_real_escape_string($conn,$_POST['number5']);
    $amount1 = mysqli_real_escape_string($conn,$_POST['amount1']);
    $amount2 = mysqli_real_escape_string($conn,$_POST['amount2']);
    $amount3 = mysqli_real_escape_string($conn,$_POST['amount3']);
    $amount4 = mysqli_real_escape_string($conn,$_POST['amount4']);
    $amount5 = mysqli_real_escape_string($conn,$_POST['amount5']);
    

}
    if (empty($request)) {
        array_push($errors,"กรุณากรอกคำเสนอแนะ");
        $_SESSION['error'] = "กรุณากรอกคำเสนอแนะ";
    }
    if(count($errors)==0){
        
        $sql ="UPDATE request SET request='$request' ,number1='$number1',number2='$number2',number3='$number3',number4='$number4',number5='$number5',amount1='$amount1',amount2='$amount2',amount3='$amount3',amount4='$amount4',amount5='$amount5',time = CURRENT_TIMESTAMP,requeststatus='N'
        WHERE requestid = '$requestid'";
        mysqli_query($conn,$sql);
        header('location: show_request_admin.php');
       
    }else{
        
        header('location: edit_request_admin?id='.$requestid.'');
    }

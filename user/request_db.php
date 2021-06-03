<?php

session_start();
include('server.php');

$errors = array();

if (isset($_POST['request_creat'])) {
    if (isset($_FILES['file'])) {
        echo "<pre>";
        print_r($_FILES['file']);
        echo "</pre>";

        $file_name = $_FILES['file']['name'];
        $file_type = $_FILES['file']['type'];
        $file_size = $_FILES['file']['size'];
        $tmp_name = $_FILES['file']['tmp_name'];
        $error = $_FILES['file']['error'];


        if ($file_size > 10000000) {
            array_push($errors, "ไฟล์มีขนาดใหญ่เกิน");
            $_SESSION['error'] = "ไฟล์มีขนาดใหญ่เกิน";
        } else {
            $file_ex = pathinfo($file_name, PATHINFO_EXTENSION);
            $file_ex_lc = strtolower($file_ex);

            $allowd_exs = array("jpg", "jpeg", "png", "pdf","xlsx","zip","rar","");
            if (in_array($file_ex_lc, $allowd_exs)) {
                $new_file_name = $file_name;
                $file_upload_path = '../files/' . $new_file_name;
                move_uploaded_file($tmp_name, $file_upload_path);
            } else {
                array_push($errors, "คุณไม่สามารถลงไฟล์นามสกุลนี้ได้");
                $_SESSION['error'] = "คุณไม่สามารถลงไฟล์นามสกุลนี้ได้";
            }
        }
    }

    $request = mysqli_real_escape_string($conn, $_POST['request']);
    $number1 = mysqli_real_escape_string($conn, $_POST['number1']);
    $number2 = mysqli_real_escape_string($conn, $_POST['number2']);
    $number3 = mysqli_real_escape_string($conn, $_POST['number3']);
    $number4 = mysqli_real_escape_string($conn, $_POST['number4']);
    $number5 = mysqli_real_escape_string($conn, $_POST['number5']);
    $amount1 = mysqli_real_escape_string($conn, $_POST['amount1']);
    $amount2 = mysqli_real_escape_string($conn, $_POST['amount2']);
    $amount3 = mysqli_real_escape_string($conn, $_POST['amount3']);
    $amount4 = mysqli_real_escape_string($conn, $_POST['amount4']);
    $amount5 = mysqli_real_escape_string($conn, $_POST['amount5']);
    $userid = $_SESSION['userid'];
}
if (empty($request)) {
    array_push($errors, "กรุณากรอกคำเสนอแนะ");
    $_SESSION['error'] = "กรุณากรอกคำเสนอแนะ";
}

if (count($errors) >> 1) {
    $_SESSION['error'] = "กรุณากรอกข้อมูลให้ครบถ้วน";
}
if (count($errors) == 0) {
    $sql = "INSERT INTO request (request,namefile,minefile,file,number1,number2,number3,number4,number5,amount1,amount2,amount3,amount4,amount5,requeststatus,userid) VALUES ('$request','$file_name','$file_type','$new_file_name','$number1','$number2','$number3','$number4','$number5','$amount1','$amount2','$amount3','$amount4','$amount5','W','$userid')";
    mysqli_query($conn, $sql);
    header('location: show_request.php');
} else {

    header('location: request.php');
}

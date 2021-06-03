<?php

session_start();
include('server.php');

$errors = array();

if(isset($_POST['register_user'])){
    $firstname = mysqli_real_escape_string($conn,$_POST['firstname']);
    $lastname = mysqli_real_escape_string($conn,$_POST['lastname']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $phonenumber = mysqli_real_escape_string($conn,$_POST['phonenumber']);
    $passwd1 = mysqli_real_escape_string($conn,$_POST['passwd1']);
    $passwd2 = mysqli_real_escape_string($conn,$_POST['passwd2']);
    

}
    if (empty($firstname)) {
        array_push($errors,"กรุณากรอกชื่อ");
        $_SESSION['error'] = "กรุณากรอกชื่อ";
    }
    if (empty($lastname)) {
        array_push($errors,"กรุณากรอกนามสกุล");
        $_SESSION['error'] = "กรุณากรอกนามสกุล";
    }
    
    if (empty($email)) {
        array_push($errors,"กรุณากรอกอีเมล์");
        $_SESSION['error'] = "กรุณากรอกอีเมล์";
    }
    if (empty($phonenumber)) {
        array_push($errors,"กรุณากรอกเบอร์โทรศัพท์");
        $_SESSION['error'] = "กรุณากรอกเบอร์โทรศัพท์";
    }
    if (empty($passwd1)) {
        array_push($errors,"กรุณากรอกรหัสผ่าน");
        $_SESSION['error'] = "กรุณากรอกรหัสผ่าน";
    }
    if ($passwd1 != $passwd2) {
        array_push($errors,"กรุณากรอกรหัสผ่านทั้งสองให้เหมือนกัน");
        $_SESSION['error'] = "กรุณากรอกรหัสผ่านทั้งสองให้เหมือนกัน";
    }
    if(count($errors)> 1 ){
        $_SESSION['error'] = "กรุณากรอกข้อมูลให้ครบถ้วน";
    }
    $user_check_query = "SELECT * FROM user WHERE email = '$email'";
    $query = mysqli_query($conn,$user_check_query);
    $result = mysqli_fetch_assoc($query);

    if ($result){
        if ($result['email'] === $email){
            array_push($errors,"มีอีเมล์นี้แล้ว");
            $_SESSION['error'] = "มีอีเมล์นี้มีผู้แล้ว";
        }
    }
    

    if(count($errors)==0){
        $password = md5($passwd1);
        $sql = "INSERT INTO user (firstname,lastname,email,phonenumber,passwd,user_group) VALUES ('$firstname','$lastname','$email','$phonenumber','$password','P')";
        mysqli_query($conn,$sql);
        $data = $query->fetch_assoc();
        header('location: index.php');
       
    }else{
        
        header('location: register.php');
    }
    



?>
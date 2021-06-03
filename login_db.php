<?php
    session_start();
    include('server.php');
    $errors = array();

    if(isset($_POST['login_user'])){
        $email = mysqli_real_escape_string($conn,$_POST['email']);
        $passwd = mysqli_real_escape_string($conn,$_POST['passwd']);
    }

    if (empty($email)) { 
        array_push($errors,"กรุณากรอกอีเมล์");
        $_SESSION['error'] = "กรุณากรอกอีเมล์";
    }

    if (empty($passwd)) {
        array_push($errors,"กรุณากรอกรหัสผ่าน");
        $_SESSION['error'] = "กรุณากรอกรหัสผ่าน";
    }
    if(count($errors)>1){
        $_SESSION['error'] = "กรุณากรอกอีเมล์ และรหัสผ่าน";
    }
    if(count($errors)==0){  
        $passwd = md5($passwd);
        $user_check_query = "SELECT * FROM user WHERE email = '$email' AND passwd = '$passwd'";
        $query = mysqli_query($conn,$user_check_query);
        $data = $query->fetch_assoc();
        if (mysqli_num_rows($query) == 1) {
            $_SESSION['email'] = $email;
            $_SESSION['user_group'] = $data['user_group'];
            $_SESSION['userid'] = $data['userid'];
           if( $_SESSION['user_group']=='P'){
            header('location: user/request.php');
           }elseif( $_SESSION['user_group']=='A'){
            header('location: admin/show_request_admin.php');
           }
            
        }else{
            array_push($errors,"กรุณากรอก ชื่อผู้ใช้ / รหัสผ่าน ให้ถูกต้อง");
            $_SESSION['error'] = "กรุณากรอก ชื่อผู้ใช้ / รหัสผ่าน ให้ถูกต้อง" ;
            header('location: login.php');
           
        }
    }else{
        header('location: login.php');
    }
?>
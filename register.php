<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สมัครสมาชิก</title>

    <style>
        * {
            margin: 0px;
            padding: 0px;
        }
        body{
        text-align: center;
    }
        
    </style>
</head>

<body>
    <h1>สมัครสมาชิก</h1>
    <br>
    <?php if (!empty($_SESSION['error'])) : ?>
        <div>
            <script type='text/javascript'>
                alert('<?php echo $_SESSION['error']; ?>');
            </script>
        </div>
    <?php  unset($_SESSION['error']); endif ?>
    <div>
        <form action="register_db.php" method="POST">
        <label for="firstname">ชื่อ :</label>
        <input type="text" name="firstname" id="firstname"><br><br>
        <label for="lastname">นามสกุล :</label>
        <input type="text" name="lastname" id="lastname"><br><br>
        <label for="email">อีเมล์ :</label>
        <input type="email" name="email" id="email"><br><br>
        <label for="phonenumber">เบอร์โทรศัพท์ :</label>
        <input type="tel" name="phonenumber" id="phonenumber"><br><br>
        <label for="passwd1">รหัสผ่าน :</label>
        <input type="password" name="passwd1" id="passwd1"><br><br>
        <label for="passwd2">รหัสผ่านอีกครั้ง :</label>
        <input type="password" name="passwd2" id="passwd2"><br><br>
        <button type="submit" name="register_user">สมัครสมาชิก</button>
        </form>
    </div>



</body>

</html>
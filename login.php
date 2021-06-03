<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เข้าสู่ระบบ</title>

    <style>
        * {
            margin: 0px;
            padding: 0px;
        }

        body {
            text-align: center;
        }
    </style>
</head>

<body>
    <h1>เข้าสู่ระบบ</h1>
    <br>
    <?php if (!empty($_SESSION['error'])) : ?>
        <div>
            <script type='text/javascript'>
                alert('<?php echo $_SESSION['error']; ?>');
            </script>
        </div>
    <?php  unset($_SESSION['error']); endif ?>
    <div>
        <form action="login_db.php" method="POST">
            <label for="email">อีเมล์ :</label>
            <input type="eamil" name="email" id="email"><br><br>
            <label for="passwd">รหัสผ่าน :</label>
            <input type="password" name="passwd" id="passwd"><br><br>
            <button type="submit" name="login_user">เข้าสู่ระบบ</button></button>
        </form>
    </div>



</body>

</html>
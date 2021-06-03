<?php
session_start();
if (!isset($_SESSION["email"])) {
    header('location: ../index.php');
}
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ใบเสนอแนะ</title>
    <style>
        * {
            margin: 0px;
            padding: 0px;
        }

        body {
            text-align: center;
        }

        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
            margin-left: auto;
            margin-right: auto;
        }

        th,
        td {
            padding: 15px;
        }

        input {
            text-align: center;
        }
    </style>
</head>

<body>
    <h1>ใบเสนอแนะ</h1>
    <div>
        <h3 style="color: red;">
            <?php echo $_SESSION['user_group'];
            echo $_SESSION['userid'];
            ?>
        </h3>
        <br>
    </div>
    <?php if (!empty($_SESSION['error'])) : ?>
        <div>
            <script type='text/javascript'>
                alert('<?php echo $_SESSION['error']; ?>');
            </script>
        </div>
    <?php  unset($_SESSION['error']); endif ?>
    <a href="logout.php"><button>ออกจากระบบ</button></a>
    <a href="show_request.php"><button>แสดงใบเสนอ</button></a>
    <br>
    <br>
    <div>
        <form action="request_db.php" method="POST" enctype="multipart/form-data">
            <table>
                <tr>
                    <th>รายละเอียดสินค้า</th>
                    <th>จำนวน</th>
                    <th>ราคา(บาท)</th>
                </tr>
                <tr>
                    <td>
                        <textarea name="request" id="request" cols="50" rows="10"></textarea>
                        <br><br>
                        <p>แนบรายละเอียดเพิ่ม <input type="file" name="file" id="file"></p>

                    </td>
                    <td>
                        <input type="number" name="number1" id="number1"><br><br>
                        <input type="number" name="number2" id="number2"><br><br>
                        <input type="number" name="number3" id="number3"><br><br>
                        <input type="number" name="number4" id="number4"><br><br>
                        <input type="number" name="number5" id="number5">
                    </td>
                    <td>
                        <input type="number" name="amount1" id="amount1" readonly><br><br>
                        <input type="number" name="amount2" id="amount2" readonly><br><br>
                        <input type="number" name="amount3" id="amount3" readonly><br><br>
                        <input type="number" name="amount4" id="amount4" readonly><br><br>
                        <input type="number" name="amount5" id="amount5" readonly>
                    </td>
                </tr>
            </table>
            <br>
            <button name="request_creat">เสนอแนะ</button>
    </div>
    </form>

</body>

</html>
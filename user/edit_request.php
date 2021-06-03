<?php
session_start();
include('server.php');
if (!isset($_SESSION["email"])) {
    header('location: index.php');
}
if (isset($_GET['id'])) {
    $requestid = $_GET['id'];
    $userid = $_SESSION['userid'];
    mysqli_set_charset($conn, "utf8");
    $sql = "SELECT * FROM request WHERE userid = $userid AND requestid = $requestid";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}

?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=TIS620" />
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
            text-align: center;
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
    <?php unset($_SESSION['error']);
    endif ?>
    <a href="logout.php"><button>ออกจากระบบ</button></a>
    <a href="show_request.php"><button>แสดงใบเสนอ</button></a>
    <br>
    <br>
    <div>
        <form action="edit_request_db.php" method="POST" enctype="multipart/form-data">
            <table>
                <tr>
                    <th>รายละเอียดสินค้า</th>
                    <th>จำนวน</th>
                    <th>ราคา(บาท)</th>
                </tr>
                <tr>
                    <td>
                        <textarea name="request" id="request" cols="50" rows="10"><?php echo $row['request'] ?></textarea>
                        <br><br>
                        <p>แนบรายละเอียดเพิ่ม <input type="file" name="file" id="file"></p>
                </td>
                <td>
                            <input type="number" name="number1" id="number1" value="<?php echo $row['number1']; ?>"><br><br>
                            <input type="number" name="number2" id="number2" value="<?php echo $row['number2']; ?>"><br><br>
                            <input type="number" name="number3" id="number3" value="<?php echo $row['number3']; ?>"><br><br>
                            <input type="number" name="number4" id="number4" value="<?php echo $row['number4']; ?>"><br><br>
                            <input type="number" name="number5" id="number5" value="<?php echo $row['number5']; ?>">
                    </td>
                    <td>
                        <input type="number" name="amount1" id="amount1" readonly value="<?php echo $row['amount1']; ?>"><br><br>
                        <input type="number" name="amount2" id="amount2" readonly value="<?php echo $row['amount2']; ?>"><br><br>
                        <input type="number" name="amount3" id="amount3" readonly value="<?php echo $row['amount3']; ?>"><br><br>
                        <input type="number" name="amount4" id="amount4" readonly value="<?php echo $row['amount4']; ?>"><br><br>
                        <input type="number" name="amount5" id="amount5" readonly value="<?php echo $row['amount5']; ?>">
                        <input type="hidden" name="requestid" value="<?php echo $requestid; ?>">
                    </td>
                </tr>

            </table>
            <br>
            <button name="request_edit">เสนอแนะใหม่</button>
    </div>
    </form>
</body>

</html>
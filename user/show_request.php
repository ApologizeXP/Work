<?php
session_start();
include('server.php');
if (!isset($_SESSION["email"])) {
    header('location: ../index.php');
}
$userid = $_SESSION['userid'];
$sql = "SELECT * FROM request WHERE userid = $userid  ORDER BY time DESC   ";
$result = $conn->query($sql);
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
    <?php if (isset($_SESSION['error'])) : ?>
        <div>
            <h3 style="color: red;">
                <?php echo $_SESSION['error'];
                unset($_SESSION['error']);
                ?>
            </h3>
            <br>
        </div>
    <?php endif ?>
    <a href="logout.php"><button>ออกจากระบบ</button></a>
    <a href="request.php"><button>ใบเสนอแนะ</button></a>
    <br>
    <br>
    <div>
        <table>
            <tr>
                <th>สถานะ</th>
                <th>รายละเอียดสินค้า</th>
                <th>จำนวน</th>
                <th>ราคา(บาท)</th>
                <th>เมนู</th>
                <th>พรีวิว</th>
            </tr>
            <?php
            while ($row = $result->fetch_object()) { ?>
                <tr>
                    <td> <?php if ($row->requeststatus == 'N') { ?>
                            <legend style="color: green; font-weight: bolder;">ใหม่</legend><br>
                        <?php } elseif ($row->requeststatus == 'W') { ?>
                            <legend style="color: red; font-weight: bolder;">รอ</legend><br>
                        <?php } elseif ($row->requeststatus == 'C') { ?>
                            <legend style="color: green; font-weight: bolder;">ยอมรับ</legend><br>
                        <?php } ?>
                        <p><?php echo $row->time ?></p>
                    </td>
                    <td>
                        <textarea name="request" id="request" cols="50" rows="10" readonly><?php echo $row->request ?></textarea>
                    </td>
                    <td>
                        <input type="number" name="number1" id="number1" readonly value="<?php echo $row->number1; ?>"><br><br>
                        <input type="number" name="number2" id="number2" readonly value="<?php echo $row->number2; ?>"><br><br>
                        <input type="number" name="number3" id="number3" readonly value="<?php echo $row->number3; ?>"><br><br>
                        <input type="number" name="number4" id="number4" readonly value="<?php echo $row->number4; ?>"><br><br>
                        <input type="number" name="number5" id="number5" readonly value="<?php echo $row->number5; ?>">
                    </td>
                    <td>
                        <input type="number" name="amount1" id="amount1" readonly value="<?php echo $row->amount1; ?>"><br><br>
                        <input type="number" name="amount2" id="amount2" readonly value="<?php echo $row->amount2; ?>"><br><br>
                        <input type="number" name="amount3" id="amount3" readonly value="<?php echo $row->amount3; ?>"><br><br>
                        <input type="number" name="amount4" id="amount4" readonly value="<?php echo $row->amount4; ?>"><br><br>
                        <input type="number" name="amount5" id="amount5" readonly value="<?php echo $row->amount5; ?>">
                    </td>
                    <td>
                        <a href="edit_request.php?id=<?php echo $row->requestid; ?>"><button>แก้ไข</button></a>
                        <a href="delete_request.php?id=<?php echo $row->requestid; ?>"><button>ลบ</button></a>
                        <a href="confirm_request.php?id=<?php echo $row->requestid; ?>"><button>ยอมรับ</button></a>
                    </td>
                    <td>
                        <?php
                        if ($row->minefile == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet") { ?>
                            <embed src="../image/microsoft-excel-4-722715.png " style="width: 150px;height: 150px">
                            <br><br>
                            <a href="view.php?id=<?php echo $row->requestid; ?>"><?php echo $row->namefile; ?></a>
                        <?php } elseif ($row->minefile == "") { ?>
                            <h3 style="color: red;">ไม่มีไฟล์</h3>
                        <?php } elseif ($row->minefile == "application/octet-stream") { ?>
                            <embed src="../image/kisspng-winrar-android-zip-5b146da06cfad8.0662247015280654404464.png" style="width: 150px;height: 150px">
                            <br><br>
                            <a href="view.php?id=<?php echo $row->requestid; ?>"><?php echo $row->namefile; ?></a>
                        <?php } else { ?>
                            <embed src="../files/<?php echo $row->file; ?> " type="<?php echo $row->minefile; ?>" style="width: 150px;height: 150px">
                            <br><br>
                            <a href="view.php?id=<?php echo $row->requestid; ?>"><?php echo $row->namefile; ?></a>
                        <?php } ?>
                    </td>
                </tr>
            <?php
            }
            ?>
        </table>
        <br>
    </div>

</body>

</html>
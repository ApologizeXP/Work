<?php
include('server.php');
if (!empty($_GET['id'])) {
    $id = ($_GET['id']);
    $sql = "SELECT * FROM request WHERE requestid =$id";
    $result = mysqli_query($conn, $sql);
    $file = $result->fetch_assoc();
    $filepath = "../files/" . $file['namefile'];

    if (file_exists($filepath)) {
        header('Content-Description: File Transfer');
        header('Content-Type:'.$file['minefile']);
        header('Content-Disposition: attachment; filename=' . basename($filepath));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize('../files/' . $file['namefile']));
        readfile('../files/' . $file['namefile']);
        exit;
    } else {
        echo "file not exit";
    }
}



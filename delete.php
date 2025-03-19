<?php
include 'db_connect.php';

if (isset($_GET['id'])) {
    $MaSV = $_GET['id'];
    $sql = "DELETE FROM SinhVien WHERE MaSV='$MaSV'";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Lỗi: " . $conn->error;
    }
}
?>

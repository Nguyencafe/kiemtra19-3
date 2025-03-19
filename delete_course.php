<?php
include 'db_connect.php';

if (isset($_GET['id'])) {
    $MaHP = $_GET['id'];
    $sql = "DELETE FROM HocPhan WHERE MaHP='$MaHP'";

    if ($conn->query($sql) === TRUE) {
        header("Location: course_list.php");
    } else {
        echo "Lỗi: " . $conn->error;
    }
}
?>

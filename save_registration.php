<?php
include 'db_connect.php';
session_start();

if (!isset($_SESSION['MaSV'])) {
    header("Location: login.php");
    exit();
}

$MaSV = $_SESSION['MaSV'];
$NgayDK = date('Y-m-d');

$conn->query("INSERT INTO DangKy (NgayDK, MaSV) VALUES ('$NgayDK', '$MaSV')");
$MaDK = $conn->insert_id;

foreach ($_SESSION['cart'] as $course) {
    $MaHP = $course['MaHP'];
    $conn->query("INSERT INTO ChiTietDangKy (MaDK, MaHP) VALUES ('$MaDK', '$MaHP')");
}

// Không xóa giỏ hàng sau khi lưu đăng ký
$_SESSION['success_message'] = "Thông tin học phần đã lưu thành công!";
header("Location: view_registration.php");
?>

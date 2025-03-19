<?php
include 'db_connect.php';
session_start();

if (!isset($_SESSION['MaSV'])) {
    header("Location: login.php");
    exit();
}

$MaSV = $_SESSION['MaSV'];
$HoTen = $_SESSION['HoTen'];
$NgaySinh = $_SESSION['NgaySinh'];
$TenNganh = $_SESSION['TenNganh'];
$NgayDK = date('Y-m-d');

?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin đăng ký học phần</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<!-- Thanh điều hướng -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">Test1</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="index.php">Sinh Viên</a></li>
                <li class="nav-item"><a class="nav-link" href="course_list.php">Học Phần</a></li>
                <li class="nav-item"><a class="nav-link" href="register_course.php">Đăng Kí Học Phần</a></li>
                <li class="nav-item"><a class="nav-link" href="login.php">Đăng Nhập</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-4">
    <h2 class="text-center text-primary">Thông tin đăng ký học phần</h2>
đâu
    <?php if (isset($_SESSION['success_message'])): ?>
        <div class="alert alert-success">
            <?= $_SESSION['success_message'] ?>
            <?php unset($_SESSION['success_message']); ?>
        </div>
    <?php endif; ?>

    <div class="bg-white p-4 rounded shadow-sm">
        <p><strong>Mã số sinh viên:</strong> <?= htmlspecialchars($MaSV) ?></p>
        <p><strong>Họ tên sinh viên:</strong> <?= htmlspecialchars($HoTen) ?></p>
        <p><strong>Ngày sinh:</strong> <?= date("d-m-Y", strtotime($NgaySinh)) ?></p>
        <p><strong>Ngành học:</strong> <?= htmlspecialchars($TenNganh) ?></p>
        <p><strong>Ngày đăng ký:</strong> <?= date("d-m-Y", strtotime($NgayDK)) ?></p>
    </div>

    <h2 class="text-center text-primary mt-5">Danh sách học phần đã đăng ký</h2>

    <table class="table table-bordered table-hover text-center bg-white shadow-sm">
        <thead class="table-primary">
            <tr>
                <th>Mã Học Phần</th>
                <th>Tên Học Phần</th>
                <th>Số Tín Chỉ</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php $total_credits = 0; ?>
            <?php foreach ($_SESSION['cart'] as $course): ?>
            <tr>
                <td><?= $course['MaHP'] ?></td>
                <td><?= $course['TenHP'] ?></td>
                <td><?= $course['SoTinChi'] ?></td>
                <td>
                    <a href="register_course.php?remove=<?= $course['MaHP'] ?>" class="btn btn-danger btn-sm">Xóa</a>
                </td>
            </tr>
            <?php $total_credits += $course['SoTinChi']; ?>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="text-center">
        <p class="text-danger">Số học phần: <?= count($_SESSION['cart']) ?></p>
        <p class="text-danger">Tổng số tín chỉ: <?= $total_credits ?></p>
        <a href="register_course.php?clear=true" class="btn btn-danger">Xóa Đăng Kí</a>
        <a href="save_registration.php" class="btn btn-primary">Lưu đăng ký</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
include 'db_connect.php';
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Cập nhật số lượng dự kiến của hai học phần "Cơ sở dữ liệu" và "Kinh tế vi mô" thành 100
$conn->query("UPDATE HocPhan SET SoLuongDuKien = 100 WHERE TenHP = 'Cơ sở dữ liệu' OR TenHP = 'Kinh tế vi mô'");

if (isset($_GET['add'])) {
    $MaHP = $_GET['add'];
    $result = $conn->query("SELECT * FROM HocPhan WHERE MaHP = '$MaHP'");
    $course = $result->fetch_assoc();
    if ($course) {
        $_SESSION['cart'][$MaHP] = $course;
        // Giảm số lượng dự kiến
        $conn->query("UPDATE HocPhan SET SoLuongDuKien = SoLuongDuKien - 1 WHERE MaHP = '$MaHP'");
        header("Location: view_registration.php");
        exit();
    }
}

if (isset($_GET['remove'])) {
    $MaHP = $_GET['remove'];
    if (isset($_SESSION['cart'][$MaHP])) {
        unset($_SESSION['cart'][$MaHP]);
        // Tăng số lượng dự kiến
        $conn->query("UPDATE HocPhan SET SoLuongDuKien = SoLuongDuKien + 1 WHERE MaHP = '$MaHP'");
    }
}

if (isset($_GET['clear'])) {
    foreach ($_SESSION['cart'] as $course) {
        $MaHP = $course['MaHP'];
        // Tăng số lượng dự kiến
        $conn->query("UPDATE HocPhan SET SoLuongDuKien = SoLuongDuKien + 1 WHERE MaHP = '$MaHP'");
    }
    $_SESSION['cart'] = [];
}

$courses = $conn->query("SELECT * FROM HocPhan");
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Kí Học Phần</title>
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
    <h2 class="text-center text-primary">Danh Sách Học Phần</h2>

    <table class="table table-bordered table-hover text-center bg-white shadow-sm">
        <thead class="table-primary">
            <tr>
                <th>Mã Học Phần</th>
                <th>Tên Học Phần</th>
                <th>Số Tín Chỉ</th>
                <th>Số Lượng Dự Kiến</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $courses->fetch_assoc()): ?>
            <tr>
                <td><?= $row['MaHP'] ?></td>
                <td><?= $row['TenHP'] ?></td>
                <td><?= $row['SoTinChi'] ?></td>
                <td><?= isset($row['SoLuongDuKien']) ? $row['SoLuongDuKien'] : 'N/A' ?></td>
                <td>
                    <a href="register_course.php?add=<?= $row['MaHP'] ?>" class="btn btn-success btn-sm">Đăng Kí</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <div class="text-center mt-3">
        <a href="view_registration.php" class="btn btn-primary">Xem học phần đã đăng ký</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

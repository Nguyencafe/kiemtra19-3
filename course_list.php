<?php
include 'db_connect.php';
$result = $conn->query("SELECT * FROM HocPhan");
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách học phần</title>
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
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['MaHP'] ?></td>
                <td><?= $row['TenHP'] ?></td>
                <td><?= $row['SoTinChi'] ?></td>
                <td><?= $row['SoLuongDuKien'] ?></td>
                <td>
                    <a href="edit_course.php?id=<?= $row['MaHP'] ?>" class="btn btn-warning btn-sm">Sửa</a>
                    <a href="delete_course.php?id=<?= $row['MaHP'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Xóa học phần này?');">Xóa</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <div class="text-center">
        <a href="create_course.php" class="btn btn-success">➕ Thêm Học Phần</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

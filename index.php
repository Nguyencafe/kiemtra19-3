<?php
include 'db_connect.php';
$result = $conn->query("SELECT * FROM SinhVien INNER JOIN NganhHoc ON SinhVien.MaNganh = NganhHoc.MaNganh");
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sinh viên</title>
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
                <li class="nav-item"><a class="nav-link" href="#">Sinh Viên</a></li>
                <li class="nav-item"><a class="nav-link" href="course_list.php">Học Phần</a></li>
                <li class="nav-item"><a class="nav-link" href="register_course.php">Đăng Kí Học Phần</a></li>
                <li class="nav-item"><a class="nav-link" href="login.php">Đăng Nhập</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-4">
    <h2 class="text-center text-primary">Danh Sách Sinh Viên</h2>

    <table class="table table-bordered table-hover text-center bg-white shadow-sm">
        <thead class="table-primary">
            <tr>
                <th>Mã SV</th>
                <th>Họ Tên</th>
                <th>Giới Tính</th>
                <th>Ngày Sinh</th>
                <th>Hình</th>
                <th>Ngành</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['MaSV'] ?></td>
                <td><?= $row['HoTen'] ?></td>
                <td><?= $row['GioiTinh'] ?></td>
                <td><?= date("d-m-Y", strtotime($row['NgaySinh'])) ?></td>
                <td><img src="<?= $row['Hinh'] ?>" class="rounded-circle" width="50" height="50"></td>
                <td><?= $row['TenNganh'] ?></td>
                <td>
                    <a href="detail.php?id=<?= $row['MaSV'] ?>" class="btn btn-info btn-sm">Xem</a>
                    <a href="edit.php?id=<?= $row['MaSV'] ?>" class="btn btn-warning btn-sm">Sửa</a>
                    <a href="delete.php?id=<?= $row['MaSV'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Xóa sinh viên này?');">Xóa</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <div class="text-center">
        <a href="create.php" class="btn btn-success">➕ Thêm Sinh Viên</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

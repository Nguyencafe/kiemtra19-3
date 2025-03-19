<?php
include 'db_connect.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $MaSV = $_POST['MaSV'];
    $result = $conn->query("SELECT * FROM SinhVien WHERE MaSV = '$MaSV'");
    $sinhvien = $result->fetch_assoc();
    if ($sinhvien) {
        $_SESSION['MaSV'] = $MaSV;
        $_SESSION['HoTen'] = $sinhvien['HoTen'];
        $_SESSION['NgaySinh'] = $sinhvien['NgaySinh'];
        $_SESSION['MaNganh'] = $sinhvien['MaNganh'];
        header("Location: register_course.php");
    } else {
        $error = "Mã sinh viên không tồn tại!";
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng Nhập</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2 class="text-center text-primary">Đăng Nhập</h2>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>
        <form action="login.php" method="post" class="bg-white p-4 rounded shadow-sm">
            <div class="mb-3">
                <label for="MaSV" class="form-label">Mã SV:</label>
                <input type="text" name="MaSV" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Đăng Nhập</button>
        </form>
        <div class="text-center mt-3">
            <a href="index.php" class="btn btn-secondary">Quay lại</a>
        </div>
    </div>
</body>
</html>

<?php
include 'db_connect.php';

if (isset($_GET['id'])) {
    $MaSV = $_GET['id'];
    $result = $conn->query("SELECT * FROM SinhVien INNER JOIN NganhHoc ON SinhVien.MaNganh = NganhHoc.MaNganh WHERE MaSV='$MaSV'");
    $sinhvien = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chi tiết sinh viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2 class="text-center text-primary">Chi Tiết Sinh Viên</h2>
        <div class="bg-white p-4 rounded shadow-sm">
            <p><strong>Họ Tên:</strong> <?= htmlspecialchars($sinhvien['HoTen']) ?></p>
            <p><strong>Giới Tính:</strong> <?= htmlspecialchars($sinhvien['GioiTinh']) ?></p>
            <p><strong>Ngày Sinh:</strong> <?= date("d-m-Y", strtotime($sinhvien['NgaySinh'])) ?></p>
            <p><strong>Ngành:</strong> <?= htmlspecialchars($sinhvien['TenNganh']) ?></p>
            <p><img src="<?= htmlspecialchars($sinhvien['Hinh']) ?>" width="100"></p>
        </div>
        <div class="text-center mt-3">
            <a href="index.php" class="btn btn-secondary">Quay lại</a>
        </div>
    </div>
</body>
</html>

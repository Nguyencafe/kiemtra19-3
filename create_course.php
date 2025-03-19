<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $MaHP = $_POST['MaHP'];
    $TenHP = $_POST['TenHP'];
    $SoTinChi = $_POST['SoTinChi'];

    $sql = "INSERT INTO HocPhan (MaHP, TenHP, SoTinChi) VALUES ('$MaHP', '$TenHP', '$SoTinChi')";

    if ($conn->query($sql) === TRUE) {
        header("Location: course_list.php");
    } else {
        echo "Lỗi: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm Học Phần</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2 class="text-center text-primary">Thêm Học Phần</h2>
        <form action="create_course.php" method="post" class="bg-white p-4 rounded shadow-sm">
            <div class="mb-3">
                <label for="MaHP" class="form-label">Mã Học Phần:</label>
                <input type="text" name="MaHP" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="TenHP" class="form-label">Tên Học Phần:</label>
                <input type="text" name="TenHP" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="SoTinChi" class="form-label">Số Tín Chỉ:</label>
                <input type="number" name="SoTinChi" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Thêm Học Phần</button>
        </form>
        <div class="text-center mt-3">
            <a href="course_list.php" class="btn btn-secondary">Quay lại</a>
        </div>
    </div>
</body>
</html>

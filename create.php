<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $MaSV = $_POST['MaSV'];
    $HoTen = $_POST['HoTen'];
    $GioiTinh = $_POST['GioiTinh'];
    $NgaySinh = $_POST['NgaySinh'];
    $MaNganh = $_POST['MaNganh'];

    // Kiểm tra xem MaSV đã tồn tại chưa
    $check = $conn->query("SELECT * FROM SinhVien WHERE MaSV = '$MaSV'");
    if ($check->num_rows > 0) {
        echo "Lỗi: Mã sinh viên đã tồn tại!";
        exit();
    }

    // Xử lý upload ảnh
    $hinh = "";
    if (isset($_FILES['HinhFile']) && $_FILES['HinhFile']['name'] != "") {
        $target_dir = "uploads/";  // Thư mục lưu ảnh
        $target_file = $target_dir . basename($_FILES["HinhFile"]["name"]);
        
        // Kiểm tra và lưu ảnh
        if (move_uploaded_file($_FILES["HinhFile"]["tmp_name"], $target_file)) {
            $hinh = $target_file; // Lưu đường dẫn đầy đủ vào database
        }
    } else {
        $hinh = $_POST['HinhURL'] ?? '';
    }

    $sql = "INSERT INTO SinhVien (MaSV, HoTen, GioiTinh, NgaySinh, Hinh, MaNganh)
            VALUES ('$MaSV', '$HoTen', '$GioiTinh', '$NgaySinh', '$hinh', '$MaNganh')";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Lỗi: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm Sinh Viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2 class="text-center text-primary">Thêm Sinh Viên</h2>
        <form action="create.php" method="post" enctype="multipart/form-data" class="bg-white p-4 rounded shadow-sm">
            <div class="mb-3">
                <label for="MaSV" class="form-label">Mã SV:</label>
                <input type="text" name="MaSV" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="HoTen" class="form-label">Họ Tên:</label>
                <input type="text" name="HoTen" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="GioiTinh" class="form-label">Giới Tính:</label>
                <select name="GioiTinh" class="form-select">
                    <option value="Nam">Nam</option>
                    <option value="Nữ">Nữ</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="NgaySinh" class="form-label">Ngày Sinh:</label>
                <input type="date" name="NgaySinh" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="MaNganh" class="form-label">Ngành Học:</label>
                <select name="MaNganh" class="form-select">
                    <?php
                    $result = $conn->query("SELECT * FROM NganhHoc");
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='{$row['MaNganh']}'>{$row['TenNganh']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="HinhFile" class="form-label">Ảnh Sinh Viên (Chọn file):</label>
                <input type="file" name="HinhFile" class="form-control">
            </div>
            <div class="mb-3">
                <label for="HinhURL" class="form-label">Hoặc nhập link ảnh:</label>
                <input type="text" name="HinhURL" class="form-control" placeholder="Nhập URL ảnh">
            </div>
            <button type="submit" class="btn btn-primary w-100">Thêm Sinh Viên</button>
        </form>
        <div class="text-center mt-3">
            <a href="index.php" class="btn btn-secondary">Quay lại</a>
        </div>
    </div>
</body>
</html>
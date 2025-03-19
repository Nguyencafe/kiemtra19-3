<?php
include 'db_connect.php';

if (isset($_GET['id'])) {
    $MaSV = $_GET['id'];
    $result = $conn->query("SELECT * FROM SinhVien WHERE MaSV = '$MaSV'");
    $sinhvien = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $MaSV = $_POST['MaSV'];
    $HoTen = $_POST['HoTen'];
    $GioiTinh = $_POST['GioiTinh'];
    $NgaySinh = $_POST['NgaySinh'];
    $MaNganh = $_POST['MaNganh'];
    $image = $sinhvien['Hinh'];

    // Xử lý upload ảnh mới nếu có
    if (isset($_FILES['HinhFile']) && $_FILES['HinhFile']['error'] == 0) {
        $target_dir = "uploads/";
        $image_name = uniqid() . '_' . basename($_FILES["HinhFile"]["name"]);
        $target_file = $target_dir . $image_name;
        if (move_uploaded_file($_FILES["HinhFile"]["tmp_name"], $target_file)) {
            $image = $target_file;
            if ($sinhvien['Hinh'] && file_exists($target_dir . $sinhvien['Hinh'])) {
                unlink($target_dir . $sinhvien['Hinh']);
            }
        } else {
            echo "<p style='color: red;'>Lỗi khi upload ảnh: " . $_FILES['HinhFile']['error'] . "</p>";
        }
    } else {
        $image = $_POST['HinhURL'] ?? $sinhvien['Hinh'];
    }

    $sql = "UPDATE SinhVien SET HoTen='$HoTen', GioiTinh='$GioiTinh', NgaySinh='$NgaySinh', Hinh='$image', MaNganh='$MaNganh' WHERE MaSV='$MaSV'";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php?success=" . urlencode("Cập nhật sinh viên thành công!"));
        exit;
    } else {
        echo "<p style='color: red;'>Lỗi khi cập nhật: " . $conn->error . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sửa sinh viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2 class="text-center text-primary">Sửa Sinh Viên</h2>
        <form method="POST" enctype="multipart/form-data" class="bg-white p-4 rounded shadow-sm">
            <input type="hidden" name="MaSV" value="<?= $sinhvien['MaSV'] ?>">
            <div class="mb-3">
                <label for="HoTen" class="form-label">Họ Tên:</label>
                <input type="text" name="HoTen" class="form-control" value="<?= htmlspecialchars($sinhvien['HoTen']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="GioiTinh" class="form-label">Giới Tính:</label>
                <select name="GioiTinh" class="form-select">
                    <option value="Nam" <?= $sinhvien['GioiTinh'] == 'Nam' ? 'selected' : '' ?>>Nam</option>
                    <option value="Nữ" <?= $sinhvien['GioiTinh'] == 'Nữ' ? 'selected' : '' ?>>Nữ</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="NgaySinh" class="form-label">Ngày Sinh:</label>
                <input type="date" name="NgaySinh" class="form-control" value="<?= $sinhvien['NgaySinh'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="MaNganh" class="form-label">Ngành Học:</label>
                <select name="MaNganh" class="form-select">
                    <?php
                    $result = $conn->query("SELECT * FROM NganhHoc");
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='{$row['MaNganh']}'" . ($sinhvien['MaNganh'] == $row['MaNganh'] ? 'selected' : '') . ">{$row['TenNganh']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="HinhFile" class="form-label">Ảnh hiện tại:</label><br>
                <?php if ($sinhvien['Hinh']) { ?>
                    <img src="<?= $sinhvien['Hinh'] ?>" alt="" width="100"><br>
                <?php } ?>
                <label for="HinhFile" class="form-label">Ảnh mới (nếu muốn thay):</label>
                <input type="file" name="HinhFile" class="form-control">
            </div>
            <div class="mb-3">
                <label for="HinhURL" class="form-label">Hoặc nhập link ảnh:</label>
                <input type="text" name="HinhURL" class="form-control" placeholder="Nhập URL ảnh">
            </div>
            <button type="submit" class="btn btn-primary w-100">Cập nhật</button>
        </form>
        <div class="text-center mt-3">
            <a href="index.php" class="btn btn-secondary">Quay lại</a>
        </div>
    </div>
</body>
</html>

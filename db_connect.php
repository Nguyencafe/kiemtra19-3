<?php
$servername = "localhost"; // XAMPP chạy trên localhost
$username = "root"; // Mặc định XAMPP không có mật khẩu
$password = ""; // Nếu bạn có đặt mật khẩu MySQL thì thay vào đây
$database = "test1"; // Tên database của bạn

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $database);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Tạo bảng nếu chưa tồn tại
$conn->query("CREATE TABLE IF NOT EXISTS HocPhan (
    MaHP CHAR(6) PRIMARY KEY,
    TenHP NVARCHAR(30) NOT NULL,
    SoTinChi INT
)");

$conn->query("CREATE TABLE IF NOT EXISTS DangKy (
    MaDK INT AUTO_INCREMENT PRIMARY KEY,
    NgayDK DATE,
    MaSV CHAR(10),
    FOREIGN KEY (MaSV) REFERENCES SinhVien(MaSV)
)");

$conn->query("CREATE TABLE IF NOT EXISTS ChiTietDangKy (
    MaDK INT,
    MaHP CHAR(6),
    PRIMARY KEY (MaDK, MaHP),
    FOREIGN KEY (MaDK) REFERENCES DangKy(MaDK),
    FOREIGN KEY (MaHP) REFERENCES HocPhan(MaHP)
)");
?>

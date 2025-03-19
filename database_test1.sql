-- Tạo database
CREATE DATABASE IF NOT EXISTS Test1;
USE Test1;

-- Tạo bảng NganhHoc
CREATE TABLE IF NOT EXISTS NganhHoc (
    MaNganh CHAR(4) PRIMARY KEY,
    TenNganh NVARCHAR(30)
);

-- Tạo bảng SinhVien
CREATE TABLE IF NOT EXISTS SinhVien (
    MaSV CHAR(10) PRIMARY KEY,
    HoTen NVARCHAR(50) NOT NULL,
    GioiTinh NVARCHAR(5),
    NgaySinh DATE,
    Hinh NVARCHAR(50),
    MaNganh CHAR(4),
    FOREIGN KEY (MaNganh) REFERENCES NganhHoc(MaNganh)
);

-- Tạo bảng HocPhan
CREATE TABLE IF NOT EXISTS HocPhan (
    MaHP CHAR(6) PRIMARY KEY,
    TenHP NVARCHAR(30) NOT NULL,
    SoTinChi INT
);

-- Tạo bảng DangKy
CREATE TABLE IF NOT EXISTS DangKy (
    MaDK INT AUTO_INCREMENT PRIMARY KEY,
    NgayDK DATE,
    MaSV CHAR(10),
    FOREIGN KEY (MaSV) REFERENCES SinhVien(MaSV)
);

-- Tạo bảng ChiTietDangKy
CREATE TABLE IF NOT EXISTS ChiTietDangKy (
    MaDK INT,
    MaHP CHAR(6),
    PRIMARY KEY (MaDK, MaHP),
    FOREIGN KEY (MaDK) REFERENCES DangKy(MaDK),
    FOREIGN KEY (MaHP) REFERENCES HocPhan(MaHP)
);

-- Chèn dữ liệu vào bảng NganhHoc
INSERT INTO NganhHoc (MaNganh, TenNganh) VALUES
    ('CNTT', N'Công nghệ thông tin'),
    ('QTKD', N'Quản trị kinh doanh');

-- Chèn dữ liệu vào bảng SinhVien
INSERT INTO SinhVien (MaSV, HoTen, GioiTinh, NgaySinh, Hinh, MaNganh) VALUES
    ('0123456789', N'Nguyễn Văn A', N'Nam', '2002-12-12', 'Content/images/sv1.jpg', 'CNTT'),
    ('9876543210', N'Nguyễn Thị B', N'Nữ', '2000-08-03', 'Content/images/sv2.jpg', 'QTKD');

-- Chèn dữ liệu vào bảng HocPhan
INSERT INTO HocPhan (MaHP, TenHP, SoTinChi) VALUES
    ('CNTT01', N'Lập trình C', 3),
    ('CNTT02', N'Cơ sở dữ liệu', 2),
    ('QTKD01', N'Kinh tế vi mô', 2),
    ('QTKD02', N'Xác suất thống kê 1', 3);

-- Hiển thị dữ liệu (tùy chọn, chỉ chạy khi cần xem dữ liệu)
SELECT * FROM SinhVien;
SELECT * FROM NganhHoc;
SELECT * FROM HocPhan;
SELECT * FROM DangKy;
SELECT * FROM ChiTietDangKy;

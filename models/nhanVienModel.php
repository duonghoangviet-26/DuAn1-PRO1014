<?php
// Có class chứa các function thực thi tương tác với cơ sở dữ liệu 
class nhanVienModel
{
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function getAllNhanVien()
    {
        $sql = "SELECT * FROM   nhanvien  ORDER BY MaNhanVien ASC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getNhanVienById($id)
    {
        $sql = "SELECT * FROM nhanvien WHERE MaNhanVien = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function insertNhanVien($HoTen, $VaiTro, $SoDienThoai, $Email, $LinkAnh, $MaCodeNhanVien)
{
    $sql = "INSERT INTO nhanvien (HoTen, VaiTro, SoDienThoai, Email, TrangThai, LinkAnhDaiDien, MaCodeNhanVien)
            VALUES (:HoTen, :VaiTro, :SoDienThoai, :Email, 'dang_lam', :LinkAnhDaiDien, :MaCodeNhanVien)";
            
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([
        ':HoTen' => $HoTen,
        ':VaiTro' => $VaiTro,
        ':SoDienThoai' => $SoDienThoai,
        ':Email' => $Email,
        ':LinkAnhDaiDien' => $LinkAnh,
        ':MaCodeNhanVien' => $MaCodeNhanVien
    ]);
}

    public function updateNhanVien($id, $TenNhanVien, $VaiTro, $SDT, $Email, $LinkAnh, $TrangThai)
{
    $sql = "UPDATE nhanvien 
            SET HoTen = :ten, VaiTro = :vaitro, SoDienThoai = :sdt, Email = :email, 
                LinkAnhDaiDien = :anh, TrangThai = :trangthai
            WHERE MaNhanVien = :id";

    $stmt = $this->conn->prepare($sql);
    return $stmt->execute([
        ':ten' => $TenNhanVien,
        ':vaitro' => $VaiTro,
        ':sdt' => $SDT,
        ':email' => $Email,
        ':anh' => $LinkAnh,
        ':trangthai' => $TrangThai,
        ':id' => $id
    ]);
}

    public function deleteNhanVien($id)
    {
    $sql = "UPDATE nhanvien SET TrangThai = 'da_nghi' WHERE MaNhanVien = :id";
    $stmt = $this->conn->prepare($sql);
    return $stmt->execute([':id' => $id]);
    }
    
}

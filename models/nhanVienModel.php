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
}

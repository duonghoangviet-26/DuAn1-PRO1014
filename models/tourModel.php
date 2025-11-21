<?php
class tourModel
{
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }

    // Viết truy vấn danh sách sản phẩm 
    public function getCategoryAll()
    {
        try {
            $sql = 'SELECT * FROM danhmuctour ORDER BY MaDanhMuc ASC';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }


    // Xóa danh mục theo mã
    public function deleteDanhMuc($id)
    {
        $sql = "DELETE FROM danhmuctour WHERE MaDanhMuc = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public  function creatDanhMuc($TenDanhMuc, $MoTa)
    {
        $sql = "INSERT INTO danhmuctour (TenDanhMuc, MoTa) VALUES (:TenDanhMuc, :MoTa)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':TenDanhMuc', $TenDanhMuc);
        $stmt->bindParam(':MoTa', $MoTa);
        $stmt->execute();
    }

    // Lấy thông tin danh mục theo MaDanhMuc
    public function getDanhMucByMa($MaDanhMuc)
    {
        $sql = "SELECT * FROM danhmuctour WHERE MaDanhMuc = :MaDanhMuc LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':MaDanhMuc', $MaDanhMuc);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Sửa danh mục
    public function updateDanhMuc($MaDanhMuc, $TenDanhMuc, $MoTa)
    {
        $sql = "UPDATE danhmuctour 
                SET TenDanhMuc = :TenDanhMuc, MoTa = :MoTa
                WHERE MaDanhMuc = :MaDanhMuc";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':MaDanhMuc', $MaDanhMuc, PDO::PARAM_INT);
        $stmt->bindParam(':TenDanhMuc', $TenDanhMuc);
        $stmt->bindParam(':MoTa', $MoTa);
        $stmt->execute();
    }


    public function getAllTours()
    {
        $sql = "SELECT * FROM tour WHERE TrangThai = 'hoat_dong' ORDER BY TenTour ASC";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllKhachHang()
    {
        $sql = "SELECT * FROM khachhang ORDER BY NgayTao DESC";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

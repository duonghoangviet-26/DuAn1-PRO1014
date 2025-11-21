<?php
class nhaCungCapModel
{
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function getAllNhaCungCap()
    {
        $sql = "SELECT * FROM nhacungcap ORDER BY MaNhaCungCap ASC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOneNhaCungCap($id)
    {
        $sql = "SELECT * FROM nhacungcap WHERE MaNhaCungCap = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindparam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insertNhaCungCap($data)
    {
        try{
            $sql = "INSERT INTO nhacungcap (
                MaCodeNCC, TenNhaCungCap, LoaiNhaCungCap, NguoiLienHe, TenLaiXe, SDTLaiXe, SoDienThoai, Email, 
                DiaChi, DichVuCungCap, FileHopDong, NgayBatDauHopDong, NgayKetThucHopDong, 
                DanhGia, GhiChu, TrangThai
            ) VALUES (
                :MaCodeNCC, :TenNhaCungCap, :LoaiNhaCungCap, :NguoiLienHe, :TenLaiXe, :SDTLaiXe, :SoDienThoai, :Email, 
                :DiaChi, :DichVuCungCap, :FileHopDong, :NgayBatDauHopDong, :NgayKetThucHopDong, 
                :DanhGia, :GhiChu, :TrangThai
            )";

            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(':MaCodeNCC', $data['MaCodeNCC']);
            $stmt->bindParam(':TenNhaCungCap', $data['TenNhaCungCap']);
            $stmt->bindParam(':LoaiNhaCungCap', $data['LoaiNhaCungCap']);
            $stmt->bindParam(':NguoiLienHe', $data['NguoiLienHe']);

            $stmt->bindParam(':TenLaiXe', $data['TenLaiXe']);
            $stmt->bindParam(':SDTLaiXe', $data['SDTLaiXe']);

            $stmt->bindParam(':SoDienThoai', $data['SoDienThoai']);
            $stmt->bindParam(':Email', $data['Email']);
            $stmt->bindParam(':DiaChi', $data['DiaChi']);
            $stmt->bindParam(':DichVuCungCap', $data['DichVuCungCap']);
            $stmt->bindParam(':FileHopDong', $data['FileHopDong']);
            $stmt->bindParam(':NgayBatDauHopDong', $data['NgayBatDauHopDong']);
            $stmt->bindParam(':NgayKetThucHopDong', $data['NgayKetThucHopDong']);
            $stmt->bindParam(':DanhGia', $data['DanhGia']);
            $stmt->bindParam(':GhiChu', $data['GhiChu']);
            $stmt->bindParam(':TrangThai', $data['TrangThai']);

            $stmt->execute();
            return true;
        } catch (Exception $e) {
            echo "Lỗi khi thêm: " . $e->getMessage();
            return false;
        }
    }

    public function updateNhaCungCap($id, $data)
    {
        try{
            $sql = "UPDATE nhacungcap SET
                MaCodeNCC = :MaCodeNCC, 
                TenNhaCungCap = :TenNhaCungCap, 
                LoaiNhaCungCap = :LoaiNhaCungCap, 
                NguoiLienHe = :NguoiLienHe, 
                TenLaiXe = :TenLaiXe, 
                SDTLaiXe = :SDTLaiXe,
                SoDienThoai = :SoDienThoai, 
                Email = :Email, 
                DiaChi = :DiaChi, 
                DichVuCungCap = :DichVuCungCap, 
                FileHopDong = :FileHopDong, 
                NgayBatDauHopDong = :NgayBatDauHopDong, 
                NgayKetThucHopDong = :NgayKetThucHopDong, 
                DanhGia = :DanhGia, 
                GhiChu = :GhiChu, 
                TrangThai = :TrangThai
            WHERE MaNhaCungCap = :MaNhaCungCap";

            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(':MaCodeNCC', $data['MaCodeNCC']);
            $stmt->bindParam(':TenNhaCungCap', $data['TenNhaCungCap']);
            $stmt->bindParam(':LoaiNhaCungCap', $data['LoaiNhaCungCap']);
            $stmt->bindParam(':NguoiLienHe', $data['NguoiLienHe']);

            $stmt->bindParam(':TenLaiXe', $data['TenLaiXe']);
            $stmt->bindParam(':SDTLaiXe', $data['SDTLaiXe']);

            $stmt->bindParam(':SoDienThoai', $data['SoDienThoai']);
            $stmt->bindParam(':Email', $data['Email']);
            $stmt->bindParam(':DiaChi', $data['DiaChi']);
            $stmt->bindParam(':DichVuCungCap', $data['DichVuCungCap']);
            $stmt->bindParam(':FileHopDong', $data['FileHopDong']);
            $stmt->bindParam(':NgayBatDauHopDong', $data['NgayBatDauHopDong']);
            $stmt->bindParam(':NgayKetThucHopDong', $data['NgayKetThucHopDong']);
            $stmt->bindParam(':DanhGia', $data['DanhGia']);
            $stmt->bindParam(':GhiChu', $data['GhiChu']);
            $stmt->bindParam(':TrangThai', $data['TrangThai']);
            $stmt->bindParam(':MaNhaCungCap', $id);

            $stmt->execute();
            return true;
        } catch (Exception $e) {
            echo "Lỗi khi thêm: " . $e->getMessage();
            return false;
        }
    }

    public function deleteNhaCungCap($id)
    {
        try{
            $sql = "DELETE FROM nhacungcap WHERE MaNhaCungCap = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return true;
        } catch (Exception $e) {
            echo "Lỗi khi xóa: " . $e->getMessage();
            return false;
        }
    }

    public function getNhaCungCapByCategory($loai_ncc)
    {
        $sql = "SELECT * FROM nhacungcap
        WHERE LoaiNhaCungCap = :loai_ncc
        ORDER BY MaNhaCungCap ASC";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindparam(':loai_ncc', $loai_ncc);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
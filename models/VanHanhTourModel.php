<?php
class VanHanhTourModel {
    public $conn;
    public function __construct() {
        $this->conn = connectDB();
    }

    public function getTaiChinhByDoan($maDoan) {
        $sql = "SELECT * FROM taichinhtour WHERE MaDoan = :maDoan ORDER BY NgayGiaoDich DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':maDoan' => $maDoan]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addTaiChinh($maDoan, $loaiGD, $hangMuc, $soTien, $ngayGD, $moTa, $phuongThuc, $soHoaDon, $maNguoiTao) {
        $sql = "INSERT INTO taichinhtour (MaDoan, LoaiGiaoDich, HangMucChi, SoTien, NgayGiaoDich, MoTa, PhuongThucThanhToan, SoHoaDon, MaNguoiTao) 
                VALUES (:md, :loai, :hm, :tien, :ngay, :mt, :pt, :hd, :mnt)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':md' => $maDoan, ':loai' => $loaiGD, ':hm' => $hangMuc, 
            ':tien' => $soTien, ':ngay' => $ngayGD, ':mt' => $moTa, 
            ':pt' => $phuongThuc, ':hd' => $soHoaDon, ':mnt' => $maNguoiTao
        ]);
    }
    
    public function deleteTaiChinh($id) {
        $sql = "DELETE FROM taichinhtour WHERE MaTaiChinh = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }

    public function getThongBaoByTaiKhoan($maTaiKhoan) {
        $sql = "SELECT * FROM thongbao WHERE MaTaiKhoan = :mtk ORDER BY NgayTao DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':mtk' => $maTaiKhoan]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getNhaCungCapByDoan($maDoan) {
        
        $sql = "SELECT ncc.*, dv.LoaiDichVu as DichVuCungCapThucTe, dv.GhiChu as GhiChuDichVu
                FROM nhacungcap ncc
                JOIN dichvucuadoan dv ON ncc.MaNhaCungCap = dv.MaNhaCungCap
                WHERE dv.MaDoan = :maDoan
                AND dv.TrangThaiXacNhan != 'da_huy'";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':maDoan' => $maDoan]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
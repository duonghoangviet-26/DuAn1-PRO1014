<?php
class VanHanhTourModel
{
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function getTaiChinhByDoan($maDoan)
    {
        $sql = "SELECT * FROM taichinhtour 
            WHERE MaDoan = :maDoan 
            ORDER BY NgayGiaoDich DESC, MaTaiChinh DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':maDoan' => $maDoan]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addTaiChinh($maDoan, $loaiGD, $hangMuc, $soTien, $ngayGD, $moTa, $phuongThuc, $soHoaDon, $maNguoiTao,$anhChungTu)
    {
        $sql = "INSERT INTO taichinhtour 
    (MaDoan, LoaiGiaoDich, HangMucChi, SoTien, NgayGiaoDich, MoTa, 
     PhuongThucThanhToan, SoHoaDon, MaNguoiTao, AnhChungTu) 
    VALUES (:md, :loai, :hm, :tien, :ngay, :mt, :pt, :hd, :mnt, :anh)";

       $stmt = $this->conn->prepare($sql);
return $stmt->execute([
    ':md' => $maDoan,
    ':loai' => $loaiGD,
    ':hm' => $hangMuc,
    ':tien' => $soTien,
    ':ngay' => $ngayGD,
    ':mt' => $moTa,
    ':pt' => $phuongThuc,
    ':hd' => $soHoaDon,
    ':mnt' => $maNguoiTao,
    ':anh' => $anhChungTu
]);

    }

    public function deleteTaiChinh($id)
    {
        $sql = "DELETE FROM taichinhtour WHERE MaTaiChinh = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }


    public function getThongBaoByTaiKhoan($maTaiKhoan)
    {
        $sql = "SELECT * FROM thongbao WHERE MaTaiKhoan = :mtk ORDER BY NgayTao DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':mtk' => $maTaiKhoan]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getNhaCungCapByDoan($maDoan)
    {
        $sql = "SELECT ncc.*, dv.LoaiDichVu as DichVuCungCapThucTe, dv.GhiChu as GhiChuDichVu
                FROM nhacungcap ncc
                JOIN dichvucuadoan dv ON ncc.MaNhaCungCap = dv.MaNhaCungCap
                WHERE dv.MaDoan = :maDoan
                AND dv.TrangThaiXacNhan != 'da_huy'";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':maDoan' => $maDoan]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



    public function admin_getTaiChinh($maDoan)
    {
        $sql = "SELECT * FROM admin_taichinh 
                WHERE MaDoan = :maDoan 
                ORDER BY NgayGiaoDich DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':maDoan' => $maDoan]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function admin_addTaiChinh($data)
    {
        $sql = "INSERT INTO admin_taichinh 
                (MaDoan, LoaiGiaoDich, HangMucChi, SoTien, NgayGiaoDich, MoTa, 
                 PhuongThucThanhToan, SoHoaDon, NguoiTao)
                VALUES 
                (:MaDoan, :Loai, :HangMuc, :SoTien, :NgayGD, :MoTa, :PTTT, :SoHoaDon, :NguoiTao)";

        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($data);
    }

    public function admin_deleteTaiChinh($id)
    {
        $sql = "DELETE FROM admin_taichinh WHERE MaTaiChinh = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
    // public function updateTaiChinh($id, $loaiGD, $hangMuc, $soTien, $ngayGD, $moTa, $pttt, $soHoaDon)
    // {

    //     $sql = "UPDATE taichinhtour 
    //         SET LoaiGiaoDich = :loai,
    //             HangMucChi = :hm,
    //             SoTien = :tien,
    //             NgayGiaoDich = :ngay,
    //             MoTa = :mota,
    //             PhuongThucThanhToan = :pt,
    //             SoHoaDon = :hd
    //         WHERE MaTaiChinh = :id";

    //     $stmt = $this->conn->prepare($sql);

    //     return $stmt->execute([
    //         ':loai' => $loaiGD,
    //         ':hm'   => $hangMuc,
    //         ':tien' => $soTien,
    //         ':ngay' => $ngayGD,
    //         ':mota' => $moTa,
    //         ':pt'   => $pttt,
    //         ':hd'   => $soHoaDon,
    //         ':id'   => $id
    //     ]);
    // }
    public function getTaiChinhById($id)
    {
        $sql = "SELECT * FROM taichinhtour WHERE MaTaiChinh = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateTaiChinh($id, $loaiGD, $hangMuc, $soTien, $ngayGD, $moTa, $pttt, $soHoaDon, $anh)
    {

        $sql = "UPDATE taichinhtour 
            SET LoaiGiaoDich = :loai,
                HangMucChi = :hm,
                SoTien = :tien,
                NgayGiaoDich = :ngay,
                MoTa = :mota,
                PhuongThucThanhToan = :pt,
                SoHoaDon = :hd,
                AnhChungTu = :anh
            WHERE MaTaiChinh = :id";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ':loai' => $loaiGD,
            ':hm'   => $hangMuc,
            ':tien' => $soTien,
            ':ngay' => $ngayGD,
            ':mota' => $moTa,
            ':pt'   => $pttt,
            ':hd'   => $soHoaDon,
            ':anh'  => $anh,
            ':id'   => $id
        ]);
    }
    public function addLog($MaDoan, $MaNguoi, $NoiDung, $MaTaiChinh)
    {
        $sql = "INSERT INTO nhatkytour 
            (MaDoan, MaNguoiTao, NgayGhi, GioGhi, NoiDung, LoaiSuCo, MaGiaoDich)
            VALUES (?, ?, CURDATE(), CURTIME(), ?, 'chinh_sua_tai_chinh', ?)";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$MaDoan, $MaNguoi, $NoiDung, $MaTaiChinh]);
    }
    public function getLogByTransaction($MaDoan, $MaTaiChinh)
    {
        $sql = "SELECT nk.*, tk.TenDangNhap
            FROM nhatkytour nk
            LEFT JOIN taikhoan tk ON nk.MaNguoiTao = tk.MaTaiKhoan
            WHERE nk.MaDoan = ? AND nk.MaGiaoDich = ?
            ORDER BY nk.MaNhatKy DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$MaDoan, $MaTaiChinh]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getLogById($id)
    {
        $sql = "SELECT LichSuChinhSua FROM taichinhtour WHERE MaTaiChinh = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetchColumn();
    }
    public function updateTaiChinhFull(
        $id,
        $Loai,
        $HangMuc,
        $SoTien,
        $NgayGD,
        $MoTa,
        $PTTT,
        $SoHoaDon,
        $Anh,
        $logJSON
    ) {
        $sql = "UPDATE taichinhtour SET
        LoaiGiaoDich=?, HangMucChi=?, SoTien=?, NgayGiaoDich=?, MoTa=?,
        PhuongThucThanhToan=?, SoHoaDon=?, AnhChungTu=?, LichSuChinhSua=?
        WHERE MaTaiChinh=?";

        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            $Loai,
            $HangMuc,
            $SoTien,
            $NgayGD,
            $MoTa,
            $PTTT,
            $SoHoaDon,
            $Anh,
            $logJSON,
            $id
        ]);
    }
}

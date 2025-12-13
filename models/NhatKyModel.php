<?php
class NhatKyModel
{
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function getTourPhuTrach($maHDV)
    {
        $sql = "SELECT dkh.*, t.TenTour, llv.MaLichLamViec
                FROM doankhoihanh dkh
                JOIN tour t ON dkh.MaTour = t.MaTour
                LEFT JOIN lichlamviec llv ON dkh.MaDoan = llv.MaDoan AND llv.MaNhanVien = dkh.MaHuongDanVien
                WHERE dkh.MaHuongDanVien = :maHDV 
                AND dkh.NgayVe >= CURDATE()
                ORDER BY dkh.NgayKhoiHanh ASC";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':maHDV', $maHDV);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getNhatKyByDoan($maDoan)
    {
        $sql = "SELECT * FROM nhatkytour WHERE MaDoan = :maDoan ORDER BY NgayGhi DESC, GioGhi DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':maDoan', $maDoan);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getThongTinDoan($maDoan)
    {
        $sql = "SELECT dkh.*, t.TenTour 
                FROM doankhoihanh dkh
                JOIN tour t ON dkh.MaTour = t.MaTour
                WHERE dkh.MaDoan = :maDoan";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':maDoan', $maDoan);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insertNhatKy($maDoan, $ngay, $gio, $noiDung, $suCo, $anh, $nguoiTao)
    {
        $sql = "INSERT INTO nhatkytour (MaDoan, NgayGhi, GioGhi, NoiDung, LoaiSuCo, LinkAnh, MaNguoiTao) 
                VALUES (:maDoan, :ngay, :gio, :noiDung, :suCo, :anh, :nguoiTao)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':maDoan' => $maDoan,
            ':ngay' => $ngay,
            ':gio' => $gio,
            ':noiDung' => $noiDung,
            ':suCo' => $suCo,
            ':anh' => $anh,
            ':nguoiTao' => $nguoiTao
        ]);
    }

    public function getOneNhatKy($id)
    {
        $sql = "SELECT * FROM nhatkytour WHERE MaNhatKy = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateNhatKy($id, $ngay, $gio, $noiDung, $suCo, $anh)
    {
        if ($anh) {
            $sql = "UPDATE nhatkytour SET NgayGhi=:ngay, GioGhi=:gio, NoiDung=:noiDung, LoaiSuCo=:suCo, LinkAnh=:anh WHERE MaNhatKy=:id";
            $params = [':id' => $id, ':ngay' => $ngay, ':gio' => $gio, ':noiDung' => $noiDung, ':suCo' => $suCo, ':anh' => $anh];
        } else {
            $sql = "UPDATE nhatkytour SET NgayGhi=:ngay, GioGhi=:gio, NoiDung=:noiDung, LoaiSuCo=:suCo WHERE MaNhatKy=:id";
            $params = [':id' => $id, ':ngay' => $ngay, ':gio' => $gio, ':noiDung' => $noiDung, ':suCo' => $suCo];
        }
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
    }

    public function deleteNhatKy($id)
    {
        $sql = "DELETE FROM nhatkytour WHERE MaNhatKy = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    // Đã sửa lt.MoTa thành lt.NoiDung
    public function getLichSuDiemDanh($maDoan)
    {
        $sql = "SELECT dd.*, lt.NgayThu, lt.*, k.HoTen, k.SoDienThoai
                FROM diemdanh dd
                JOIN lichtrinh lt ON dd.MaLichTrinh = lt.MaLichTrinh
                JOIN khachtrongbooking k ON dd.MaKhachTrongBooking = k.MaKhachTrongBooking
                JOIN booking b ON k.MaBooking = b.MaBooking
                WHERE b.MaDoan = :maDoan
                ORDER BY lt.NgayThu ASC, dd.Buoi ASC, k.HoTen ASC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':maDoan' => $maDoan]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getNhatKyAdmin($maDoan)
    {
        $sql = "SELECT nk.*, nv.HoTen AS TenHDV
            FROM nhatkytour nk
            LEFT JOIN nhanvien nv ON nk.MaNguoiTao = nv.MaNhanVien
            WHERE nk.MaDoan = :maDoan
            ORDER BY nk.NgayGhi DESC, nk.GioGhi DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['maDoan' => $maDoan]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

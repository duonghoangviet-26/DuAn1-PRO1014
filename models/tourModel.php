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


    //tour
    public function getAllTour()
    {
        $sql = "SELECT t.*, dm.TenDanhMuc 
                FROM tour t
                LEFT JOIN danhmuctour dm ON t.MaDanhMuc = dm.MaDanhMuc";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // Thêm tour mới
    public function addTour($TenTour, $Gia, $KhoiHanh, $SoNgay,$SoDem, $MoTa, $MaDanhMuc, $LinkAnhBia,$GiaVonDuKien, $NgayBatDau, $NgayKetThuc)
    {
        $sql = "INSERT INTO tour 
            (TenTour, GiaBanMacDinh, DiemKhoiHanh, SoNgay,SoDem, MoTa, MaDanhMuc, LinkAnhBia,GiaVonDuKien, NgayBatDau, NgayKetThuc)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?,?,?)";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            $TenTour,
            $Gia,
            $KhoiHanh,
            $SoNgay,
            $SoDem,
            $MoTa,
            $MaDanhMuc,
            $LinkAnhBia,
            $GiaVonDuKien,
            $NgayBatDau,
            $NgayKetThuc
        ]);

        return $this->conn->lastInsertId();
    }
    // Cập nhật tour
    public function updateTour(
    $id,
    $TenTour,
    $Gia,
    $KhoiHanh,
    $SoNgay,
    $SoDem,
    $MoTa,
    $MaDanhMuc,
    $LinkAnhBia,
    $GiaVonDuKien,
    $NgayBatDau,
    $NgayKetThuc
) {
    $sql = "UPDATE tour SET 
            TenTour = ?, 
            GiaBanMacDinh = ?, 
            DiemKhoiHanh = ?, 
            SoNgay = ?, 
            SoDem=?,
            MoTa = ?, 
            MaDanhMuc = ?,
            LinkAnhBia = ?,
            GiaVonDuKien=?,
            NgayBatDau = ?,
            NgayKetThuc = ?
        WHERE MaTour = ?";

    $stmt = $this->conn->prepare($sql);
    $stmt->execute([
        $TenTour,
        $Gia,
        $KhoiHanh,
        $SoNgay,
        $SoDem,
        $MoTa,
        $MaDanhMuc,
        $LinkAnhBia,
        $GiaVonDuKien,
        $NgayBatDau,
        $NgayKetThuc,
        $id
    ]);
}

    // Xóa tour
    public function deleteTour($id)
    {
        $sql = "DELETE FROM tour WHERE MaTour = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
    }
    // Lấy tour theo ID
    public function getTourById($id)
    {
        $sql = "SELECT t.*, dm.TenDanhMuc
            FROM tour t
            LEFT JOIN danhmuctour dm ON t.MaDanhMuc = dm.MaDanhMuc
            WHERE t.MaTour = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Lấy toàn bộ danh mục
    public function getAllDanhMuc()
    {
        $sql = "SELECT * FROM danhmuctour";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // Lấy lịch trình theo tour
    public function getLichTrinhByTour($idTour)
    {
        $sql = "SELECT * 
            FROM lichtrinh 
            WHERE MaTour = ?
            ORDER BY NgayThu ASC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$idTour]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // Lấy chính sách tour theo ID tour
    // public function getChinhSachByTour($idTour)
    // {
    //     $sql = "SELECT 
    //             ChinhSachBaoGom, 
    //             ChinhSachKhongBaoGom, 
    //             ChinhSachHuy, 
    //             ChinhSachHoanTien
    //         FROM tour 
    //         WHERE MaTour = ?";

    //     $stmt = $this->conn->prepare($sql);
    //     $stmt->execute([$idTour]);

    //     return $stmt->fetch(PDO::FETCH_ASSOC);
    // }

    // UPDATE lịch trình
    public function updateLichTrinh(
        $idLT,
        $TieuDeNgay,
        $ChiTietHoatDong,
        $DiaDiem,
        $Sang,
        $Trua,
        $Toi,
        $NoiO,
        $GioTapTrung,
        $GioXuatPhat,
        $GioKetThuc,
        $GioHoatDong,
        $NoiDungSang,
        $NoiDungTrua,
        $NoiDungChieu,
        $NoiDungToi
    ) {
        $sql = "UPDATE lichtrinh SET 
                TieuDeNgay = ?, 
                ChiTietHoatDong = ?, 
                DiaDiemThamQuan = ?, 
                CoBuaSang = ?, 
                CoBuaTrua = ?, 
                CoBuaToi = ?, 
                NoiO = ?, 
                GioTapTrung = ?, 
                GioXuatPhat = ?, 
                GioKetThuc = ?, 
                GioHoatDong = ?,
                NoiDungSang=?,
                NoiDungTrua=?,
                NoiDungChieu=?,
                NoiDungToi=?
            WHERE MaLichTrinh = ?";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([
            $TieuDeNgay,
            $ChiTietHoatDong,
            $DiaDiem,
            $Sang,
            $Trua,
            $Toi,
            $NoiO,
            $GioTapTrung,
            $GioXuatPhat,
            $GioKetThuc,
            $GioHoatDong,
            $NoiDungSang,
            $NoiDungTrua,
            $NoiDungChieu,
            $NoiDungToi,
            $idLT
        ]);
    }


    public function addLichTrinh(
        $MaTour,
        $NgayThu,
        $TieuDeNgay,
        $ChiTietHoatDong,
        $DiaDiem,
        $Sang,
        $Trua,
        $Toi,
        $NoiO,
        $GioTapTrung,
        $GioXuatPhat,
        $GioKetThuc,
        $GioHoatDong,
        $NoiDungSang,
        $NoiDungTrua,
        $NoiDungChieu,
        $NoiDungToi
    ) {
        $sql = "INSERT INTO lichtrinh 
            (MaTour, NgayThu, TieuDeNgay, ChiTietHoatDong, DiaDiemThamQuan,
             CoBuaSang, CoBuaTrua, CoBuaToi, NoiO, GioTapTrung, GioXuatPhat, GioKetThuc, GioHoatDong, NoiDungSang, NoiDungTrua,NoiDungChieu, NoiDungToi)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,?,?,?)";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([
            $MaTour,
            $NgayThu,
            $TieuDeNgay,
            $ChiTietHoatDong,
            $DiaDiem,
            $Sang,
            $Trua,
            $Toi,
            $NoiO,
            $GioTapTrung,
            $GioXuatPhat,
            $GioKetThuc,
            $GioHoatDong,
            $NoiDungSang,
            $NoiDungTrua,
            $NoiDungChieu,
            $NoiDungToi
        ]);
    }

    // public function updateChinhSach($id, $baoGom, $khongBaoGom, $huy, $hoanTien)
    // {
    //     $sql = "UPDATE tour SET 
    //             ChinhSachBaoGom=?, 
    //             ChinhSachKhongBaoGom=?,
    //             ChinhSachHuy=?,
    //             ChinhSachHoanTien=?
    //         WHERE MaTour=?";

    //     $stmt = $this->conn->prepare($sql);
    //     $stmt->execute([$baoGom, $khongBaoGom, $huy, $hoanTien, $id]);
    // }


    public function getLastId()
    {
        return $this->conn->lastInsertId();
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

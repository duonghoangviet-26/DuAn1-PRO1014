<?php
class tourController
{
    public $modelTour;

    public function __construct()
    {
        $this->modelTour = new tourModel();
    }

    public function Home()
    {
        require_once "./views/trangchu.php";
    }

    public function getCategoryAll()
    {
        try {
            $listdanhmuc = $this->modelTour->getCategoryAll();
            require_once "./views/Admin/danhmuc/list.php";
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    public function deleteDanhMuc()
    {
        $id = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;

        if ($id > 0) {
            $rowsDeleted = $this->modelTour->deleteDanhMuc($id);

            if ($rowsDeleted > 0) {
                $_SESSION['success'] = "Xóa danh mục thành công!";
            } else {
                $_SESSION['error'] = "Không tìm thấy danh mục để xóa.";
            }
        } else {
            $_SESSION['error'] = "ID không hợp lệ.";
        }
        header("Location: index.php?act=listdm");
        exit;
    }

    // Thêm danh mục 
    public function creatDanhMuc()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $TenDanhMuc = $_POST['TenDanhMuc'] ?? '';
            $MoTa = $_POST['MoTa'] ?? '';

            if ($TenDanhMuc != '') {
                $this->modelTour->creatDanhMuc($TenDanhMuc, $MoTa);
                $_SESSION['success'] = "Thêm danh mục thành công!";
                header("Location: index.php?act=listdm");
                exit;
            } else {
                $_SESSION['error'] = "Tên danh mục không được để trống!";
            }
        }

        require_once "./views/Admin/danhmuc/addDanhMuc.php";
    }

    public function editDanhMuc()
    {
        $MaDanhMuc = isset($_GET['MaDanhMuc']) ? intval($_GET['MaDanhMuc']) : 0;
        if ($MaDanhMuc <= 0) {
            $_SESSION['error'] = "Mã danh mục không hợp lệ!";
            header("Location: index.php?act=listdm");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $TenDanhMuc = $_POST['TenDanhMuc'] ?? '';
            $MoTa = $_POST['MoTa'] ?? '';

            if ($TenDanhMuc != '') {
                $MaDanhMuc = $_GET['MaDanhMuc'] ?? null;

                if ($MaDanhMuc) {
                    $this->modelTour->updateDanhMuc($MaDanhMuc, $TenDanhMuc, $MoTa);
                    $_SESSION['success'] = "Sửa danh mục thành công!";
                    header("Location: index.php?act=listdm");
                    exit;
                } else {
                    $_SESSION['error'] = "Mã danh mục không hợp lệ!";
                }
            } else {
                $_SESSION['error'] = "Tên danh mục không được để trống!";
            }
        }
        $dm = $this->modelTour->getDanhMucByMa($MaDanhMuc);
        require_once "./views/Admin/danhmuc/editDanhMuc.php";
    }


    private function joinBuoi($times, $notes)
    {
        $result = [];

        if (!is_array($times) || !is_array($notes)) return "";

        foreach ($times as $i => $t) {
            $t = trim($times[$i] ?? "");
            $n = trim($notes[$i] ?? "");

            if ($t !== "" || $n !== "") {
                $result[] = "⏰ " . $t . " - " . $n;
            }
        }
        return implode("\n", $result);
    }
    // public function getAllTour()
    // {
    //     $model = new tourModel();
    //     $model->autoUpdateStatus();
    //     $keyword = $_GET['keyword'] ?? "";
    //     $trangthai = $_GET['trangthai'] ?? "";

    //     if ($keyword != "" || $trangthai != "") {


    //         $where = " WHERE 1 ";

    //     }
    // }
    public function getAllTour()
    {
        $model = new tourModel();
        $model->autoUpdateStatus();
        // Lấy keyword và trạng thái lọc
        $keyword = $_GET['keyword'] ?? "";
        $trangthai = $_GET['trangthai'] ?? "";

        // Nếu có từ khóa tìm kiếm hoặc trạng thái lọc → bỏ phân trang
        if ($keyword != "" || $trangthai != "") {

            // Tạo câu SQL tìm kiếm + lọc
            $where = " WHERE 1 ";


            if ($keyword != "") {
                $keyword = addslashes($keyword);
                $where .= " AND (t.TenTour LIKE '%$keyword%' 
                        OR dm.TenDanhMuc LIKE '%$keyword%' 
                        OR t.DiemKhoiHanh LIKE '%$keyword%')";
            }

            if ($trangthai != "") {
                $where .= " AND t.TrangThai = '$trangthai' ";
            }

            $listTour = $model->searchTourAdvanced($where);
            $totalPage = 1;
            $page = 1;
        } else {


            // PHÂN TRANG BÌNH THƯỜNG

            $limit = 7;
            $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
            if ($page < 1) $page = 1;

            $start = ($page - 1) * $limit;

            $listTour = $model->getTourPagination($start, $limit);
            $totalTour = $model->countTours();
            $totalPage = ceil($totalTour / $limit);
        }

        include "views/Admin/tour/listTour.php";
    }




    // FORM THÊM TOUR
    public function createTourForm()
    {
        $model = new tourModel();
        $danhmuc = $model->getAllDanhMuc();
        include "views/Admin/tour/addTour.php";
    }

    // XỬ LÝ THÊM TOUR
    public function createTour()
    {
        if (isset($_POST['btn-add'])) {

            $TenTour        = $_POST['TenTour'];
            $GiaBanMacDinh  = $_POST['GiaBanMacDinh'];
            $DiemKhoiHanh   = $_POST['DiemKhoiHanh'];
            $SoNgay         = $_POST['SoNgay'];
            $SoDem          = $_POST['SoDem'];
            $MoTa           = $_POST['MoTa'];
            $MaDanhMuc      = $_POST['MaDanhMuc'];
            $GiaVonDuKien   = $_POST['GiaVonDuKien'];
            $NgayBatDau     = $_POST['NgayBatDau'];
            $NgayKetThuc    = $_POST['NgayKetThuc'];
            $TrangThai = $_POST['TrangThai'];

            if ($SoDem > $SoNgay) {
                echo "<script>alert('❌ Số đêm không được lớn hơn số ngày!'); history.back();</script>";
                exit();
            }
            $LinkAnhBia = "";
            if (!empty($_FILES['LinkAnhBia']['name'])) {
                $fileName = time() . "_" . preg_replace('/\s+/', '_', $_FILES['LinkAnhBia']['name']);
                $uploadDir = $_SERVER['DOCUMENT_ROOT'] . "/DUAN1-PRO1014/uploads/imgproduct/";
                if (!file_exists($uploadDir)) mkdir($uploadDir, 0777, true);
                $target = $uploadDir . $fileName;

                if (move_uploaded_file($_FILES['LinkAnhBia']['tmp_name'], $target)) {
                    $LinkAnhBia = $fileName;
                }
            }
            $model = new tourModel();
            $model->addTour(
                $TenTour,
                $GiaBanMacDinh,
                $DiemKhoiHanh,
                $SoNgay,
                $SoDem,
                $MoTa,
                $MaDanhMuc,
                $LinkAnhBia,
                $GiaVonDuKien,
                $NgayBatDau,
                $NgayKetThuc,
                $TrangThai
            );
            $idTour = $model->getLastId();
            if (!empty($_POST['NgayThu'])) {
                foreach ($_POST['NgayThu'] as $i => $NgayThu) {

                    $NoiDungSang  = $this->joinBuoi($_POST['GioSang'][$i] ?? [], $_POST['NoiDungSang'][$i] ?? []);
                    $NoiDungTrua  = $this->joinBuoi($_POST['GioTrua'][$i] ?? [], $_POST['NoiDungTrua'][$i] ?? []);
                    $NoiDungChieu = $this->joinBuoi($_POST['GioChieu'][$i] ?? [], $_POST['NoiDungChieu'][$i] ?? []);
                    $NoiDungToi   = $this->joinBuoi($_POST['GioToi'][$i] ?? [], $_POST['NoiDungToi'][$i] ?? []);

                    $model->addLichTrinh(
                        $idTour,
                        $NgayThu,
                        $_POST['TieuDeNgay'][$i] ?? "",
                        $_POST['ChiTietHoatDong'][$i] ?? "",
                        $_POST['DiaDiemThamQuan'][$i] ?? "",
                        $_POST['CoBuaSang'][$i] ?? 0,
                        $_POST['CoBuaTrua'][$i] ?? 0,
                        $_POST['CoBuaToi'][$i] ?? 0,
                        $_POST['NoiO'][$i] ?? "",
                        $_POST['GioTapTrung'][$i] ?? null,
                        $_POST['GioXuatPhat'][$i] ?? null,
                        $_POST['GioKetThuc'][$i] ?? null,
                        $_POST['GioHoatDong'][$i] ?? null,
                        $NoiDungSang,
                        $NoiDungTrua,
                        $NoiDungChieu,
                        $NoiDungToi
                    );
                }
            }

            header("Location: index.php?act=listTour");
            exit();
        }
    }



    // FORM SỬA TOUR
    public function editTourForm()
    {
        $model = new tourModel();
        $tour = $model->getTourById($_GET['id']);
        $danhmuc = $model->getAllDanhMuc();
        $lichTrinhRaw = $model->getLichTrinhByTour($_GET['id']);

        $getTime = function ($line) {
            preg_match('/(\d{2}:\d{2})/', $line, $m);
            return $m[1] ?? "";
        };

        $parseBuoi = function ($text) use ($getTime) {
            if (!$text) return [
                "gio" => [],
                "hd" => []
            ];
            $arr = array_values(array_filter(array_map("trim", explode("\n", $text))));
            $gio = [];
            $hd  = [];

            foreach ($arr as $line) {
                $gio[] = $getTime($line);
                $hd[]  = trim(preg_replace('/⏰\s*\d{2}:\d{2}(:\d{2})?\s*-\s*/', '', $line));
            }

            return ["gio" => $gio, "hd" => $hd];
        };

        $lichTrinh = [];
        foreach ($lichTrinhRaw as $lt) {
            $lichTrinh[] = [
                "MaLichTrinh" => $lt['MaLichTrinh'],
                "NgayThu"     => $lt['NgayThu'],

                "TieuDeNgay"  => $lt['TieuDeNgay'],
                "NoiO"        => $lt['NoiO'],
                "DiaDiemThamQuan" => $lt['DiaDiemThamQuan'],

                "GioTapTrung" => $lt['GioTapTrung'],
                "GioXuatPhat" => $lt['GioXuatPhat'],
                "GioKetThuc"  => $lt['GioKetThuc'],
                "CoBuaSang" => $lt['CoBuaSang'],
                "CoBuaTrua" => $lt['CoBuaTrua'],
                "CoBuaToi"  => $lt['CoBuaToi'],

                "Sang"  => $parseBuoi($lt["NoiDungSang"]),
                "Trua"  => $parseBuoi($lt["NoiDungTrua"]),
                "Chieu" => $parseBuoi($lt["NoiDungChieu"]),
                "Toi"   => $parseBuoi($lt["NoiDungToi"])
            ];
        }

        include "views/Admin/tour/edit.php";
    }
    // XỬ LÝ UPDATE TOUR
    public function updateTour()
    {
        $id          = $_POST['MaTour'];
        $TenTour     = $_POST['TenTour'];
        $GiaBanMacDinh = $_POST['GiaBanMacDinh'];
        $DiemKhoiHanh  = $_POST['DiemKhoiHanh'];
        $SoNgay     = $_POST['SoNgay'];
        $SoDem      = $_POST['SoDem'];
        $MoTa       = $_POST['MoTa'];
        $MaDanhMuc  = $_POST['MaDanhMuc'];
        $GiaVonDuKien = $_POST['GiaVonDuKien'];
        $NgayBatDau  = $_POST['NgayBatDau'];
        $NgayKetThuc = $_POST['NgayKetThuc'];
        $TrangThai   = $_POST['TrangThai'];

        if ($SoDem > $SoNgay) {
            echo "<script>alert('❌ Số đêm không được lớn hơn số ngày!'); history.back();</script>";
            exit();
        }

        $model = new tourModel();
        $oldTour = $model->getTourById($id);

        $LinkAnhBia = $oldTour['LinkAnhBia'];
        if (!empty($_FILES['LinkAnhBia']['name'])) {
            if (file_exists("uploads/imgproduct/" . $LinkAnhBia)) {
                unlink("uploads/imgproduct/" . $LinkAnhBia);
            }

            $file = $_FILES['LinkAnhBia'];
            $fileName = time() . "_" . $file['name'];
            move_uploaded_file($file['tmp_name'], "uploads/imgproduct/" . $fileName);
            $LinkAnhBia = $fileName;
        }

        $model->updateTour(
            $id,
            $TenTour,
            $GiaBanMacDinh,
            $DiemKhoiHanh,
            $SoNgay,
            $SoDem,
            $MoTa,
            $MaDanhMuc,
            $LinkAnhBia,
            $GiaVonDuKien,
            $NgayBatDau,
            $NgayKetThuc,
            $TrangThai
        );

        $joinBuoi = function ($times, $notes) {
            $result = [];

            if (!is_array($times) || !is_array($notes)) return "";

            foreach ($times as $i => $t) {
                $t = trim($times[$i] ?? "");
                $n = trim($notes[$i] ?? "");

                if ($t !== "" || $n !== "") {
                    $result[] = "⏰ $t - $n";
                }
            }
            return implode("\n", $result);
        };

        if (!empty($_POST['MaLichTrinh'])) {

            foreach ($_POST['MaLichTrinh'] as $i => $idLT) {

                $NoiDungSang  = $joinBuoi($_POST['Sang_Gio'][$i] ?? [], $_POST['Sang_HD'][$i] ?? []);
                $NoiDungTrua  = $joinBuoi($_POST['Trua_Gio'][$i] ?? [], $_POST['Trua_HD'][$i] ?? []);
                $NoiDungChieu = $joinBuoi($_POST['Chieu_Gio'][$i] ?? [], $_POST['Chieu_HD'][$i] ?? []);
                $NoiDungToi   = $joinBuoi($_POST['Toi_Gio'][$i] ?? [], $_POST['Toi_HD'][$i] ?? []);

                $model->updateLichTrinh(
                    $idLT,
                    $_POST['TieuDeNgay'][$i] ?? "",
                    $_POST['ChiTietHoatDong'][$i] ?? "",
                    $_POST['DiaDiemThamQuan'][$i] ?? "",
                    isset($_POST['CoBuaSang'][$i]) ? 1 : 0,
                    isset($_POST['CoBuaTrua'][$i]) ? 1 : 0,
                    isset($_POST['CoBuaToi'][$i]) ? 1 : 0,
                    $_POST['NoiO'][$i] ?? "",
                    $_POST['GioTapTrung'][$i] ?? null,
                    $_POST['GioXuatPhat'][$i] ?? null,
                    $_POST['GioKetThuc'][$i] ?? null,
                    $_POST['GioHoatDong'][$i] ?? null,
                    $NoiDungSang,
                    $NoiDungTrua,
                    $NoiDungChieu,
                    $NoiDungToi
                );
            }
        }

        header("Location: index.php?act=listTour");
        exit();
    }
    // XÓA TOUR
    public function deleteTour()
    {
        $model = new tourModel();
        $tour = $model->getTourById($_GET['id']);

        if (!empty($tour['LinkAnhBia']) && file_exists("uploads/imgproduct/" . $tour['LinkAnhBia'])) {
            unlink("uploads/imgproduct/" . $tour['LinkAnhBia']);
        }

        $model->deleteTour($_GET['id']);
        header("Location: index.php?act=listTour");
    }


    // CHI TIẾT TOUR
    public function detailTour()
    {
        $id = $_GET['id'];
        $model = new tourModel();
        $tour = $model->getTourById($id);
        $lichTrinh = $model->getLichTrinhByTour($id);
        include "views/Admin/tour/chiTietTour.php";
    }
    // CLONE TOUR
    public function cloneTour()
    {
        $id = $_GET['id'];
        $model = new tourModel();
        $tour = $model->getTourById($id);
        $danhmuc = $model->getAllDanhMuc();
        $lichTrinh = $model->getLichTrinhByTour($id);

        include "views/Admin/tour/cloneTour.php";
    }

    public function cloneTourSave()
    {
        $model = new tourModel();
        $TrangThai = $_POST['TrangThai'];

        $idNew = $model->addTour(
            $_POST['TenTour'],
            $_POST['GiaBanMacDinh'],
            $_POST['DiemKhoiHanh'],
            $_POST['SoNgay'],
            $_POST['SoDem'],
            $_POST['MoTa'],
            $_POST['MaDanhMuc'],
            $_POST['OldAnh'],
            $_POST['GiaVonDuKien'],
            $_POST['NgayBatDau'],
            $_POST['NgayKetThuc'],
            $TrangThai
        );

        if (!empty($_POST['MaLichTrinh'])) {

            foreach ($_POST['MaLichTrinh'] as $i => $oldId) {

                $NoiDungSang = $this->joinBuoi($_POST['GioSang'][$i], $_POST['NoiDungSang'][$i]);
                $NoiDungTrua = $this->joinBuoi($_POST['GioTrua'][$i], $_POST['NoiDungTrua'][$i]);
                $NoiDungChieu = $this->joinBuoi($_POST['GioChieu'][$i], $_POST['NoiDungChieu'][$i]);
                $NoiDungToi = $this->joinBuoi($_POST['GioToi'][$i], $_POST['NoiDungToi'][$i]);

                $model->addLichTrinh(
                    $idNew,
                    $_POST['NgayThu'][$i],
                    $_POST['TieuDeNgay'][$i],
                    $_POST['ChiTietHoatDong'][$i],
                    $_POST['DiaDiemThamQuan'][$i],
                    $_POST['CoBuaSang'][$i] ?? 0,
                    $_POST['CoBuaTrua'][$i] ?? 0,
                    $_POST['CoBuaToi'][$i] ?? 0,
                    $_POST['NoiO'][$i],
                    $_POST['GioTapTrung'][$i],
                    $_POST['GioXuatPhat'][$i],
                    $_POST['GioKetThuc'][$i],
                    $_POST['GioHoatDong'][$i],
                    $NoiDungSang,
                    $NoiDungTrua,
                    $NoiDungChieu,
                    $NoiDungToi
                );
            }
        }

        header("Location: index.php?act=listTour");
    }

    private function tachBuoi($text)
    {
        return array_filter(
            array_map('trim', explode("\n", $text))
        );
    }
    private function getTimesFromText($arr)
    {
        return array_map(fn($line) => trim(substr($line, 2, 5)), $arr);
    }
    private function getHoatDongFromText($arr)
    {
        return array_map(function ($line) {
            return trim(explode("-", $line, 2)[1] ?? "");
        }, $arr);
    }
    
}

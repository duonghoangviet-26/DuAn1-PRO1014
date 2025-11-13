<?php
class nhanVienController
{
    public $modelNhanVien;

    public function __construct()
    {
        $this->modelNhanVien = new nhanVienModel();
    }

    public function listNV()
    {
        $listNhanVien = $this->modelNhanVien->getAllNhanVien();
        require_once "./views/Admin/nhanvien/list.php";
    }
    public function creatNV() {}
}

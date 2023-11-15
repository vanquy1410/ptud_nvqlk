<?php
include_once("connect.php");
class modelPhieuKiemTraKho{
    
    function selectAllPhieuKiemTraKhoBySearch($search){
        $con;
        $p=new KetNoiDB();
        if ($p->moKetNoi($con)) {
            $string = "SELECT pktk.MaPhieuKiemTraKho,pktk.TrangThaiKiemTra, pktk.PhieuShow, nvk.MaNhanVienKho, nvk.HoTen, pktk.NgayKiemTra, sp.MaSanPham, sp.TenSanPham, sp.SoLuongTon, sp.GiaBan, sp.GiaNhap, sp.ThuongHieu, sp.HanSuDung, sp.LoaiSanPham, lsp.TenLoai
            FROM phieukiemtrakho pktk
            INNER JOIN nhanvienkho nvk ON nvk.MaNhanVienKho = pktk.MaNhanVienKho
            INNER JOIN sanpham sp ON sp.MaSanPham = pktk.MaSanPham
            INNER JOIN loaisanpham lsp ON lsp.MaLoai = sp.LoaiSanPham where TrangThaiKiemTra like N'%".$search."%' order by MaPhieuKiemTraKho Desc";
            $table=mysqli_query($con,$string);
            $p->dongketnoi($con);
            return $table;
        } else {
            return false;
        }
        
    }


    function SelectAllPhieuKiemTraKho()
    {
        $con;
        $p = new KetNoiDB();
        if ($p->moKetNoi($con)) {
            $string = "SELECT pktk.MaPhieuKiemTraKho,pktk.TrangThaiKiemTra, pktk.PhieuShow, 
            nvk.MaNhanVienKho, nvk.HoTen, pktk.NgayKiemTra, 
            sp.MaSanPham, sp.TenSanPham, sp.SoLuongTon, sp.GiaBan, sp.GiaNhap, sp.ThuongHieu, sp.HanSuDung, sp.LoaiSanPham, lsp.TenLoai
            FROM phieukiemtrakho pktk
            INNER JOIN nhanvienkho nvk ON nvk.MaNhanVienKho = pktk.MaNhanVienKho
            INNER JOIN sanpham sp ON sp.MaSanPham = pktk.MaSanPham
            INNER JOIN loaisanpham lsp ON lsp.MaLoai = sp.LoaiSanPham
            LIMIT 0 , 30";
            $table = mysqli_query($con,$string);
            $p->dongKetNoi($con);
            return $table;
        } else {
            return false;
        }
    }

    function insertPhieuKiemTraKho($NgayKiemTra,$TrangThaiKiemTra,$MaNhanVienKho,$MaSanPham)
{

        // $con;
        $p = new KetNoiDB();
        if($p -> moKetNoi($con)){
            $string ="INSERT INTO `mypham`.`phieukiemtrakho` (
                `NgayKiemTra` ,
                `TrangThaiKiemTra` ,
                `MaNhanVienKho` ,
                `MaSanPham` ,
                `PhieuShow`
                )
                VALUES (
                '$NgayKiemTra', '$TrangThaiKiemTra', '$MaNhanVienKho','$MaSanPham', '1'
                );";
            $result = mysqli_query($con,$string);
            $p -> dongKetNoi($con);
            return $result;
        }else{
            return false; //ket noi that bai
        }
    }
    function selectPhieuKiemTraKhoUpdate($MaPhieuKiemTraKho)
    {
        // $con;
        $p = new KetNoiDB();
        if ($p->moKetNoi($con)) {
            $string = "SELECT * FROM phieukiemtrakho where MaPhieuKiemTraKho = $MaPhieuKiemTraKho";
            $table = mysqli_query($con,$string);
            $p->dongKetNoi($con);
            return $table;
        } else {
            return false;
        }
    }
    function selectDelPhieuKiemTraKho($MaPhieuKiemTraKho){
        $p = new KetNoiDB();
        // $con;
        if($p -> moketnoi($con)){
            $str = "UPDATE phieukiemtrakho SET PhieuShow = '0' WHERE MaPhieuKiemTraKho = '$MaPhieuKiemTraKho' LIMIT 1 ;";
            $tbl = mysqli_query($con,$str);
            $p -> dongketnoi($con);
            return $tbl;
        }else{
            return false;
        }
    }
  
    
    function selectPhieuKiemTraKhoToEdit($MaPhieuKiemTraKho){
        $p = new KetNoiDB();
        // $con;
        if($p -> moKetNoi($con)){
            $string = "SELECT * FROM phieukiemtrakho WHERE MaPhieuKiemTraKho = '$MaPhieuKiemTraKho' LIMIT 1 ;";
            $tbl = mysqli_query($con,$string);
            $p -> dongKetNoi($con);
            return $tbl;
        }else{
            return false;
        }
    }

    function  updatePhieuKiemTraKho($MaPhieuKiemTraKho, $NgayKiemTra, $TrangThaiKiemTra, $MaNhanVienKho, $MaSanPham){
        $p = new KetNoiDB();
        $con;
        if($p -> moKetNoi($con)){
            $string = "UPDATE  `mypham`.`phieukiemtrakho` SET `NgayKiemTra` = '$NgayKiemTra', `TrangThaiKiemTra` = '$TrangThaiKiemTra', 
            `MaNhanVienKho` = '$MaNhanVienKho', `MaSanPham` = '$MaSanPham'
             WHERE `MaPhieuKiemTraKho` = '$MaPhieuKiemTraKho';
            ";
            $tbl = mysqli_query($con,$string);
            $p -> dongKetNoi($con);
            return $tbl;
        }else{
            return false;
        }
    }

    // function updatePhieuKiemTraKho($MaSanPham, $TenSanPham, $SoLuongTon, $MoTa,$GiaBan,$GiaNhap,$ThuongHieu,$HinhAnh,$HanSuDung,$LoaiSanPham,$NhaCungCap,$NgayKiemTraKho,$MaNhanVien){
    //     $con;
    //     $p = new KetNoiDB();
    //     if($p -> moKetNoi($con)){
    //         $string ="
    //         UPDATE `mypham`.`sanpham` SET `TenSanPham` = '$TenSanPham',
    //         `TenSanPham` = '$TenSanPham',
    //         `SoLuongTon` = '$SoLuongTon',
    //         `MoTa` = '$MoTa',
    //         `GiaBan` = '$GiaBan',
    //         `GiaNhap` = '$GiaNhap',
    //         `ThuongHieu` = '$ThuongHieu',
    //         `HanSuDung` = '$HanSuDung',
    //         `LoaiSanPham` = '$LoaiSanPham',
    //         `NhaCungCap` = '$NhaCungCap',
    //         `NgayKiemTraKho`,
    //         `MaNhanVien`,
    //         ";
           
    //         if(!$HinhAnh == ''){
    //             $string ="
    //             UPDATE `mypham`.`sanpham` SET `TenSanPham` = '$TenSanPham',
    //             `TenSanPham` = '$TenSanPham',
    //             `SoLuongTon` = '$SoLuongTon',
    //             `MoTa` = '$MoTa',
    //             `GiaBan` = '$GiaBan',
    //             `GiaNhap` = '$GiaNhap',
    //             `ThuongHieu` = '$ThuongHieu',
    //             `HanSuDung` = '$HanSuDung',
    //             `LoaiSanPham` = '$LoaiSanPham',
    //             `NhaCungCap` = '$NhaCungCap',
    //             `NgayKiemTraKho`,
    //             `MaNhanVien`,
    //             ";
              
    //         }
    //         $result = mysql_query($string);
    //         $p -> dongKetNoi($con);
    //         return $result;
    //     }else{
    //         return false; //ket noi that bai
    //     }
    // }

    



}
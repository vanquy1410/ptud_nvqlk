<?php
    
    //hien thi tat ca cac san pham
    //include file ketnoi
    include_once("connect.php");
    class modelPhieuXuatKho{
        function selectAllPhieuXuatKho(){
            // $con;
            $p = new KetNoiDB();
            if ($p ->moketnoi($con)) {
                $query="SELECT pxk.MaPhieuXuatKho, pxk.TrangThaiPhieuXuatKho, pxk.PhieuShow, 
                pxk.NgayLapPhieuXuatKho, nvk.MaNhanVienKho, nvk.HoTen,
                sp.MaSanPham, sp.TenSanPham, sp.SoLuongTon, sp.ThuongHieu, sp.LoaiSanPham, lsp.TenLoai
                FROM phieuxuatkho pxk
                INNER JOIN nhanvienkho nvk ON nvk.MaNhanVienKho = pxk.MaNhanVienKho
                INNER JOIN sanpham sp ON sp.MaSanPham = pxk.MaSanPham
                INNER JOIN loaisanpham lsp ON lsp.MaLoai = sp.LoaiSanPham
                LIMIT 0 , 30";
                $tbl=mysqli_query($con,$query);
                $p->dongketnoi($con);
                return $tbl;
            } else {
                return false;
            }
        }
        function selectAllPhieuXuatKhoBySearch($search){
            // $con;
            $p=new KetNoiDB();
            if ($p->moKetNoi($con)) {
                $string = "SELECT pxk.MaPhieuXuatKho, pxk.TrangThaiPhieuXuatKho, pxk.PhieuShow, 
                pxk.NgayLapPhieuXuatKho, nvk.MaNhanVienKho, nvk.HoTen,
                sp.MaSanPham, sp.TenSanPham, sp.SoLuongTon, sp.ThuongHieu, sp.LoaiSanPham, lsp.TenLoai
                FROM phieuxuatkho pxk
                INNER JOIN nhanvienkho nvk ON nvk.MaNhanVienKho = pxk.MaNhanVienKho
                INNER JOIN sanpham sp ON sp.MaSanPham = pxk.MaSanPham
                INNER JOIN loaisanpham lsp ON lsp.MaLoai = sp.LoaiSanPham
                where TrangThaiPhieuXuatKho like N'%".$search."%' order by MaPhieuXuatKho Desc";
                $table=mysqli_query($con,$string);
                $p->dongketnoi($con);
                return $table;
            } else {
                return false;
            }
            
        }
        
        function selectPhieuXuatKhoToEdit($MaPhieuXuatKho){
            $p = new KetNoiDB();
            // $con;
            if($p -> moKetNoi($con)){
                $string = "SELECT * FROM phieuxuatkho WHERE MaPhieuXuatKho = '$MaPhieuXuatKho' LIMIT 1 ;";
                $tbl = mysqli_query($con,$string);
                $p -> dongKetNoi($con);
                return $tbl;
            }else{
                return false;
            }
        }
        function  updatePhieuXuatKho($MaPhieuXuatKho,$NgayLapPhieuXuatKho,$TrangThaiPhieuXuatKho,$MaNhanVienKho,$MaSanPham){
            $p = new KetNoiDB();
            $con;
            if($p -> moKetNoi($con)){
                $string = "UPDATE  `mypham`.`phieuxuatkho` SET `NgayLapPhieuXuatKho` = '$NgayLapPhieuXuatKho', `TrangThaiPhieuXuatKho` = '$TrangThaiPhieuXuatKho', 
                `MaNhanVienKho` = '$MaNhanVienKho', `MaSanPham` = '$MaSanPham'
                 WHERE `MaPhieuXuatKho` = '$MaPhieuXuatKho';
                ";
                $tbl = mysqli_query($con,$string);
                $p -> dongKetNoi($con);
                return $tbl;
            }else{
                return false;
            }
        }
    

        function selectDelPhieuXuatKho($MaPhieuXuatKho){
            // $con;
            $p = new KetNoiDB();
            if($p -> moKetNoi($con)){
                $string = "UPDATE `mypham`.`phieuxuatkho` SET `PhieuShow` = '0' WHERE `phieuxuatkho`.`MaPhieuXuatKho` =$MaPhieuXuatKho LIMIT 1 ;";
                $result = mysqli_query($con,$string);
                $p -> dongKetNoi($con);
                return $result;
            }else{
                return false; //ket noi that bai
            }
        }
        function insertPhieuXuatKho($NgayLapPhieuXuatKho,$TrangThaiPhieuXuatKho,$MaNhanVienKho,$MaSanPham)
        {
            // $con;
            $p = new KetNoiDB();
            if($p -> moKetNoi($con)){
                $string = "INSERT INTO `mypham`.`phieuxuatkho` (
                    `NgayLapPhieuXuatKho` ,
                    `TrangThaiPhieuXuatKho` ,
                    `MaNhanVienKho` ,
                    `MaSanPham` ,
                    `PhieuShow`
                    )
                    VALUES (
                    '$NgayLapPhieuXuatKho', '$TrangThaiPhieuXuatKho','$MaNhanVienKho','$MaSanPham', '1'
                    );";
                $result = mysqli_query($con,$string);
                $p -> dongKetNoi($con);
                return $result;
            }else{
                return false; //ket noi that bai
            }
        }
    }
?>
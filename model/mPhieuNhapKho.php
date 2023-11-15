<?php
    
    //hien thi tat ca cac san pham
    //include file ketnoi
    include_once("connect.php");
    class modelPhieuNhapKho{
        function selectAllPhieuNhapKho(){
            // $con;
            $p = new KetNoiDB();
            if ($p ->moketnoi($con)) {
                $query="SELECT pnk.MaPhieuNhapKho, pnk.TrangThaiPhieuNhapKho, pnk.PhieuShow, pnk.NgayLapPhieuNhapKho, nvk.MaNhanVienKho, nvk.HoTen, sp.MaSanPham, sp.TenSanPham, sp.SoLuongTon, sp.ThuongHieu, sp.LoaiSanPham, lsp.TenLoai, ncc.TenNhaCungCap
                FROM phieunhapkho pnk
                INNER JOIN nhanvienkho nvk ON nvk.MaNhanVienKho = pnk.MaNhanVienKho
                INNER JOIN sanpham sp ON sp.MaSanPham = pnk.MaSanPham
                INNER JOIN loaisanpham lsp ON lsp.MaLoai = sp.LoaiSanPham
                INNER JOIN nhacungcap ncc ON ncc.MaNhaCungCap = sp.MaSanPham
                LIMIT 0 , 30";
                $tbl=mysqli_query($con,$query);
                $p->dongketnoi($con);
                return $tbl;
            } else {
                return false;
            }
        }
        
        function selectAllPhieuNhapKhoBySearch($search){
            // $con;
            $p=new KetNoiDB();
            if ($p->moKetNoi($con)) {
                $string = "SELECT pnk.MaPhieuNhapKho, pnk.TrangThaiPhieuNhapKho, pnk.PhieuShow, pnk.NgayLapPhieuNhapKho, nvk.MaNhanVienKho, nvk.HoTen, sp.MaSanPham, sp.TenSanPham, sp.SoLuongTon, sp.ThuongHieu, sp.LoaiSanPham, lsp.TenLoai, ncc.TenNhaCungCap
                FROM phieunhapkho pnk
                INNER JOIN nhanvienkho nvk ON nvk.MaNhanVienKho = pnk.MaNhanVienKho
                INNER JOIN sanpham sp ON sp.MaSanPham = pnk.MaSanPham
                INNER JOIN loaisanpham lsp ON lsp.MaLoai = sp.LoaiSanPham
                INNER JOIN nhacungcap ncc ON ncc.MaNhaCungCap = sp.MaSanPham
                where TrangThaiPhieuNhapKho like N'%".$search."%' order by MaPhieuNhapKho Desc";
                $table=mysqli_query($con,$string);
                $p->dongketnoi($con);
                return $table;
            } else {
                return false;
            }
            
        }
        function selectPhieuNhapKhoToEdit($MaPhieuNhapKho){
            $p = new KetNoiDB();
            // $con;
            if($p -> moKetNoi($con)){
                $string = "SELECT * FROM phieunhapkho WHERE MaPhieuNhapKho = '$MaPhieuNhapKho' LIMIT 1 ;";
                $tbl = mysqli_query($con,$string);
                $p -> dongKetNoi($con);
                return $tbl;
            }else{
                return false;
            }
        }
        function selectDelPhieuNhapKho($MaPhieuNhapKho){
            // $con;
            $p = new KetNoiDB();
            if($p -> moKetNoi($con)){
                $string = "UPDATE `mypham`.`phieunhapkho` SET `PhieuShow` = '0' WHERE `phieunhapkho`.`MaPhieuNhapKho` =$MaPhieuNhapKho LIMIT 1 ;";
                $result = mysqli_query($con,$string);
                $p -> dongKetNoi($con);
                return $result;
            }else{
                return false; //ket noi that bai
            }
        }
        function  updatePhieuNhapKho($MaPhieuNhapKho,$NgayLapPhieuNhapKho,$TrangThaiPhieuNhapKho,$MaNhanVienKho,$MaSanPham){
            $p = new KetNoiDB();
            $con;
            if($p -> moKetNoi($con)){
                $string = "UPDATE  `mypham`.`phieunhapkho` SET `NgayLapPhieuNhapKho` = '$NgayLapPhieuNhapKho', `TrangThaiPhieuNhapKho` = '$TrangThaiPhieuNhapKho', 
                `MaNhanVienKho` = '$MaNhanVienKho', `MaSanPham` = '$MaSanPham'
                 WHERE `MaPhieuNhapKho` = '$MaPhieuNhapKho';
                ";
                $tbl = mysqli_query($con,$string);
                $p -> dongKetNoi($con);
                return $tbl;
            }else{
                return false;
            }
        }
    


        function insertPhieuNhapKho($NgayLapPhieuNhapKho,$TrangThaiPhieuNhapKho,$MaNhanVienKho,$MaSanPham)
        {
            $con;
            $p = new KetNoiDB();
            if($p -> moKetNoi($con)){
                $string ="INSERT INTO `mypham`.`phieunhapkho` (
                    `NgayLapPhieuNhapKho` ,
                    `TrangThaiPhieuNhapKho` ,
                    `MaNhanVienKho` ,
                    `MaSanPham` ,
                    `PhieuShow`
                    )
                    VALUES (
                    '$NgayLapPhieuNhapKho', '$TrangThaiPhieuNhapKho', '$MaNhanVienKho','$MaSanPham', '1'
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
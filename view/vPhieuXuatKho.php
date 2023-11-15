
<?php
    include_once("controller/cPhieuXuatKho.php");
    class VPhieuXuatKho{
        function viewAllPhieuXuatKho(){
            $p = new controlPhieuXuatKho();
            $tbl = $p -> getAllPhieuXuatKho();
            showPhieuXuatKho($tbl);
        }
        function viewAllPhieuXuatKhoBySearch($search){
            $p = new controlPhieuXuatKho();
            if(isset($_REQUEST['txtSearchPXK'])){
                $tbl = $p -> getAllPhieuXuatKhoBySearch($search);
            }
            showPhieuXuatKho($tbl);
        }
        function showFormEditPhieuXuatKho(){
            $p = new controlPhieuXuatKho();
            if(isset($_REQUEST["btnSubmitActionPhieuXuatKho"])){
                if($_REQUEST["btnSubmitActionPhieuXuatKho"] == "edit"){
                    include("editPhieuXuatKho.php");
                    // return $result;
                }
            }
        }
        function showFormDelPhieuXuatKho(){
            $p = new controlPhieuXuatKho();
                if(isset($_REQUEST["btnSubmitActionPhieuXuatKho"])){
                    if ($_REQUEST["btnSubmitActionPhieuXuatKho"] == "delete"){
                        $result = $p -> getDeletePhieuXuatKho($_REQUEST["MaPhieuXuatKho"]);
                        echo header("refresh:0; url='index.php?phieu-xuat-kho'");
                        return $result;
                    }
                }
        }
    }
        function showPhieuXuatKho($tbl){
            if($tbl){
                if(mysqli_num_rows($tbl) >0){
                    $dem=0;
                    echo '
                    <div id="phieu-xuat-kho" class="container tab-pane active"><br>
                    <div class="row timKiem-them">
                        <div class="timKiem input-group mb-3 col-md-5">
                            <form action="index.php" method="get">
                                     <input type="text" name="txtSearchPXK" size="18" placeholder = "Search" value = "';
                                     if(isset($_REQUEST["txtSearchPXK"])) echo $_REQUEST["txtSearchPXK"];
                                     echo '" >
                                     <input type="submit" name="btnSearchPXK" class="btnCus" value="Search"> 
                            </form>
                        </div>
    
                        <div class="timKiem col-md-4">
                            <h2>PHIẾU XUẤT KHO</h2>
                        </div>
                        <div class="timKiem themPXK col-md-3">
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ModalPXK">
                                Thêm phiếu xuất kho
                            </button>
                        </div>
                    </div>
                    </div>
                    ';
                    echo "<table class='pxk_tbl'> <tr>";
                        echo'
                        <table class="table table-bordered table-hover " id="myTable">
                        <thead class="table-secondary">
                                <tr class="ex">
                                <th width="auto">Mã Phiếu Xuất Kho</th>
                                <th width="auto">Trạng Thái Phiếu Xuất Kho</th>
                                <th>Ngày Lập Phiếu Xuất Kho</th>
                                <th>Mã Nhân Viên Kho</th>
                                <th>Họ Tên</th>
                                <th>Mã Sản Phẩm</th>
                                <th>Tên Sản Phẩm</th>
                                <th>Số lượng tồn</th>
                                <th>Thương hiệu</th>
                                <th>Loại sản phẩm</th>
                                <th>Tên loại</th>
                                <th>Tính Năng</th>
                            </tr>
                        </thead>
                        ';
                        while($row = mysqli_fetch_assoc($tbl)){
                            if($row["PhieuShow"] == 1){
                                echo "<tr >";
                                    echo "<td>". $row['MaPhieuXuatKho'] ."</td>";
                                    echo "<td>". $row['TrangThaiPhieuXuatKho'] ."</td>";
                                    echo "<td>". $row['NgayLapPhieuXuatKho'] ."</td>"; 
                                    echo "<td>". $row['MaNhanVienKho'] ."</td>";
                                    echo "<td>". $row['HoTen'] ."</td>";  
                                    echo "<td>". $row['MaSanPham'] ."</td>"; 
                                    echo "<td>". $row['TenSanPham'] ."</td>";
                                    echo "<td>". $row['SoLuongTon'] ."</td>";
                                    echo "<td>". $row['ThuongHieu'] ."</td>";
                                    echo "<td>". $row['LoaiSanPham'] ."</td>";
                                    echo "<td>". $row['TenLoai'] ."</td>"; 
                                echo "<td>
                                        <form action='#' method='get'>
                                        <input type='hidden' name='MaPhieuXuatKho' value='" . $row["MaPhieuXuatKho"] . "'>
                                        <button class='btnCus btn2 edit' type='submit' value='edit' name= 'btnSubmitActionPhieuXuatKho'>
                                            <i class='fa fa-pencil' aria-hidden='true'></i>
                                        </button>
                                    </form>
                                    <form action='#' method='get'onsubmit='return confirmDelete();'>
                                        <input type='hidden' name='MaPhieuXuatKho' value='" . $row["MaPhieuXuatKho"] . "'>
                                        
                                        <button class='btnCus btn2 delete' type='submit' value='delete' name= 'btnSubmitActionPhieuXuatKho'>
                                            <i class='fa fa-trash-o' aria-hidden='true'></i>
                                        </button>
                                        </form>
                                    </td>";
                                echo "</tr>";
                            }
                        }
                        echo "</table>";
            }else{
                echo"Không tìm thấy phiếu nhập kho!";
                echo header("refresh: 5; url='index.php?phieu-xuat-kho'");
            }
        }
        }
    
    ?>
 
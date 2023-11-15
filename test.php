<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <link rel="stylesheet" href="../css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 header">
                <a class="navbar-brand" href="#"><i class="fa fa-user-circle" aria-hidden="true"></i> CHỦ CỬA HÀNG</a>
                <a href="/index.html" data-toggle="tooltip" data-placement="bottom" title="ĐĂNG XUẤT"><b>Đăng xuất <i class="fas fa-sign-out-alt"></i></b></a>
            </div>
        </div>
    </div>
    <div class="container mt-3 body">
        <br>
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" >
            <li class="nav-item">
                <a class="nav-link active" href="index.php?kiem-ke-kho">KIỂM KÊ KHO</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?cap-nhat-thong-tin">CẬP NHẬT THÔNG TIN</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?phieu-nhap-kho">PHIẾU NHẬP KHO</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?phieu-xuat-kho">PHIẾU XUẤT KHO</a>
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <!-- quản lý kho hàng  -->
                <?php
                include_once("view/vKiemKeKho.php");
                $p = new VPhieuKiemTraKho();

                include_once("view/vProduct.php");
                $p = new VProduct();

                include_once("view/vPhieuNhapKho.php");
                $p = new VPhieuNhapKho();

                include_once("view/vPhieuXuatKho.php");
                $p = new VPhieuXuatKho();

                if(isset($_REQUEST['kiem-ke-kho']) ){
                    $p->viewAllPhieuKiemTraKho();
                }elseif(isset($_REQUEST['cap-nhat-thong-tin'])){
                    $c->viewAllProduct();
                }elseif(isset($_REQUEST['phieu-nhap-kho'])){
                    $d->viewAllPhieuNhapKho();
                }elseif(isset($_REQUEST['phieu-xuat-kho'])){
                        $d->viewAllPhieuXuatKho();    
                }elseif( isset($_REQUEST['btnSearchPKTK'] )){
                    $p->viewAllPhieuKiemTraKhoBySearch($_REQUEST['btnSearchPKTK']);
                }elseif(isset($_REQUEST['btnSearchSP'])){
                    $c->viewAllProductBySearch($_REQUEST['txtSearchSP']);
                // }elseif(isset($_REQUEST['btnSearchKH'])){
                //     $d->viewAllCustomerBySearch($_REQUEST['txtSearchKH']);
                }elseif(isset($_REQUEST["btnProdAct"])){
                    $c -> showFormDelProduct();
                }elseif(isset($_REQUEST["btnSubmitActionPhieuKiemTraKho"])){
                    // $p -> showFormDelEmployee();
                    $p -> showFormEditPhieuKiemTraKho();
                // }elseif(isset($_REQUEST["btnCusAct"])){
                //     $d -> showFormDelCustomer();
                }else{
                    echo "welcom admin";
                }

                
                //thêm sản phẩm
            if (isset($_REQUEST["btnAddProd"])) {

                $tenSP = $_REQUEST["tenSP"];
                $slt = $_REQUEST["SLT"];
                $moTa = $_REQUEST["moTa"];
                $giaBan = $_REQUEST["giaBan"];
                $giaNhap = $_REQUEST["giaNhap"];
                $thuongHieu = $_REQUEST["thuongHieu"];
                $hinhAnh = $_FILES["fileAnh"];
                $hsd = $_REQUEST["HSD"];
                $loaiSP = $_REQUEST["LoaiSP"];
                $nhaCC = $_REQUEST["nhaCC"];
                $cp = new CProduct();
                $result = $cp->addProduct($tenSP, $slt, $moTa, $giaBan, $giaNhap, $thuongHieu, $hinhAnh, $hsd, $loaiSP, $nhaCC);

                if ($result == 1) {
                    echo "<script>alert('Add product successfully!')</script>";
                    // echo header("refresh: 0; url = 'index.php?san-pham'");
                } elseif ($result == 0) {
                    echo "<script>alert('Add product unsuccessfully!')</script>";
                } elseif ($result == -1) {
                    echo "<script>alert('This file is not image format!')</script>";
                } elseif ($result == -2) {
                    echo "<script>alert('This file is too lagre to upload!')</script>";
                } else{
                    echo "<script>alert('Can not upload file!')</script>";
                }
            }
            ?>
        </div>

    </div>

    <div class="modal fade" id="ModalPKTK" tabindex="-1" aria-labelledby="modalPKTKLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                         <!-- Modal Header -->
                         <div class="modal-header">
                                        <h4 class="modal-title">Thêm phiếu kiểm tra kho</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                    <!-- Modal body -->
                                    <form action="#" name="formThemPKTK" method="get">
                                    <div class="modal-body">


                                    <div class="form-group">
                                        <label for="">Ngày Kiểm Tra</label>
                                        <input type="date" name="ngayKiemTra" id="ngayKiemTra" class="form-control"
                                            placeholder="vi du: 20/11/2023" aria-describedby="ngayKiemTra-mess"
                                            onblur="test('#ngayKiemTra', ngayKiemTra)">
                                        <small id="ngayKiemTra-mess"></small>
                                    </div>
                                    <div class="form-group">
                                    <label for="">Mã Sản Phẩm</label>
                                        <input type="text" name="MSP" id="MSP" class="form-control"
                                            placeholder="" aria-describedby="MSP-messs"
                                            onblur="test('#MSP', ktMSP)">
                                        <small id="MSP-mess"></small>
                                    </div>
                                    <div class="form-group">
                                    <label for="">Mã nhân viên kiểm tra kho</label>
                                        <input type="text" name="MNVK" id="MNVK" class="form-control"
                                            placeholder="" aria-describedby="MNVK-messs"
                                            onblur="test('#MNVK', ktMNVK)">
                                        <small id="MNVK-mess"></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Trạng thái kiểm tra</label>
                                        <input type="text" name="TTKT" id="TTKT" class="form-control"
                                            placeholder="vi du: sản phẩm không hư hỏng" aria-describedby="TTKT-messs"
                                            onblur="test('#TTKT', ktTTKT)">
                                        <small id="TTKT-mess"></small>
                                    </div>
                                    <div class="form-group">
                                    
                                        <input type="hidden" name="MPKTK" id="MPKTK" class="form-control"
                                            placeholder="" aria-describedby="MPKTK-messs"
                                            onblur="test('#MPKTK', ktMPKTK)">
                                        <small id="MPKTK-mess"></small>
                                    </div>

                                    </div>
                                    
                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                                        <input type="submit" class="btn btn-primary" value="Thêm sản phẩm" name="btnInsertPhieuKiemTraKho"/>
                                    </div>
                                    
                                </div>
                                    </form>
                                </div>
                                </div>
                                  
                </div>

    
       
           <!-- Modal Them san pham -->
    <div class="modal fade" id="modalThemSP" tabindex="-1" aria-labelledby="modalThemSPLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">THÔNG TIN SẢN PHẨM</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="#" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Tên sản phẩm</label>
                            <input type="text" name="tenSP" id="tenSP" class="form-control" aria-describedby="tenSP-messs" onblur="test('#tenSP', kttenSP)">
                            <small id="tenSP-mess"></small>
                        </div>

                        <div class="form-group">
                            <label for="">Số lượng tồn</label>
                            <input type="number" name="SLT" id="SLT" class="form-control" aria-describedby="SLT-messs" onblur="test('#SLT', ktEmail)">
                            <small id="SLT-mess"></small>
                        </div>

                        <div class="form-group">
                            <label for="">Mô tả</label>
                            <input type="text" name="moTa" id="moTa" class="form-control" aria-describedby="moTa-messs" onblur="test('#moTa', ktSDT)">
                            <small id="moTa-mess"></small>
                        </div>

                        <div class="form-group">
                            <label for="">Giá bán</label>
                            <input type="double" name="giaBan" id="giaBan" class="form-control" aria-describedby="giaBan-messs" onblur="test('#giaBan', ktQueQuan)">
                            <small id="giaBan-mess"></small>
                        </div>

                        <div class="form-group">
                            <label for="">Giá nhập</label>
                            <input type="double" name="giaNhap" id="giaNhap" class="form-control" aria-describedby="giaNhap-messs" onblur="test('#giaNhap', ktQueQuan)">
                            <small id="giaNhap-mess"></small>
                        </div>

                        <div class="form-group">
                            <label for="">Thương hiệu</label>
                            <input type="text" name="thuongHieu" id="thuongHieu" class="form-control" aria-describedby="thuongHieu-messs" onblur="test('#thuongHieu', ktSDT)">
                            <small id="thuongHieu-mess"></small>
                        </div>

                        <div class="form-group">
                            <label for="">Hình ảnh</label>
                            <input type="file" name="fileAnh" class="form-control">
                            <small id="hinhAnh-mess"></small>
                        </div>

                        <div class="form-group">
                            <label for="">Hạn sử dụng</label>
                            <input type="date" name="HSD" id="HSD" class="form-control" aria-describedby="HSD-messs" onblur="test('#HSD', ktSDT)">
                            <small id="HSD-mess"></small>
                        </div>

                        <div class="form-group">
                            <label for="">Loại sản phẩm</label>
                            <!-- <select name="ChucVu" id="ChucVu" class="form-control">
                                        <option value="1">Nhân viên bán hàng</option>
                                        <option value="2">Nhân viên kho</option>
                                    </select>
                                    <small id="DiaChi-mess"></small> -->
                            <?php
                            include_once("Controller/cLoaiSP.php");
                            $cloai = new CLoaiSP();
                            $tbl = $cloai->getAllLoaiSP();

                            if (mysqli_num_rows($tbl) > 0) {
                                echo '<select name="LoaiSP" class="form-control">';
                                while ($r = mysqli_fetch_assoc($tbl)) {
                                    echo '<option value="' . $r["MaLoai"] . '">' . $r["TenLoai"] . '</option>';
                                }
                                echo '</select>';
                            }
                            ?>
                        </div>

                        <div class="form-group">
                            <label for="">Nhà cung cấp</label>
                            <?php
                            include_once("Controller/cNhaCC.php");
                            $ce = new CNhaCC();
                            $tbl = $ce->getAllNCC();

                            if (mysqli_num_rows($tbl) > 0) {
                                echo '<select name="nhaCC" class="form-control">';
                                while ($r = mysqli_fetch_assoc($tbl)) {
                                    echo '<option value="' . $r["MaNhaCungCap"] . '">' . $r["TenNhaCungCap"] . '</option>';
                                }
                                echo '</select>';
                            }
                            ?>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Huỷ</button>
                        <button type="submit" name="btnAddProd" class="btn btn-success">Lưu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

           
            <!-- quản lý khách hàng  -->
            <div class="modal fade" id="ModalPNK" tabindex="-1" aria-labelledby="modalPNKLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">Thêm phiếu nhập kho</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                    <!-- Modal body -->
                                    <form action="#" name="formThemPNK" method="get">
                                    <div class="modal-body">
                                            <div class="form-group">
                                            
                                            <input type="hidden" name="MPNK" id="MPNK" class="form-control"
                                                placeholder="" aria-describedby="MPNK-messs"
                                                onblur="test('#MPNK', ktMPNK)">
                                            <small id="MPNK-mess"></small>
                                        </div>

                                        <div class="form-group">
                                            <label for="">Trạng thái phiếu nhập kho</label>
                                            <input type="text" name="TTPN" id="TTPN" class="form-control"
                                                placeholder="vi du: sản phẩm không hư hỏng" aria-describedby="TTPN-messs"
                                                onblur="test('#TTPN', ktTTPN)">
                                            <small id="TTPN-mess"></small>
                                        </div>
                                        <div class="form-group">
                                        <label for="">Ngày Lập Phiếu Nhập Kho</label>
                                        <input type="date" name="NLPNK" id="NLPNK" class="form-control"
                                            placeholder="vi du: 20/11/2023" aria-describedby="NLPNK-mess"
                                            onblur="test('#NLPNK', NLPNK)">
                                        <small id="NLPNK-mess"></small>
                                    </div>
                                        <div class="form-group">
                                    <label for="">Mã Sản Phẩm</label>
                                        <input type="text" name="MSP" id="MSP" class="form-control"
                                            placeholder="" aria-describedby="MSP-messs"
                                            onblur="test('#MSP', ktMSP)">
                                        <small id="MSP-mess"></small>
                                    </div>
                                    <div class="form-group">
                                    <label for="">Mã nhân viên kiểm tra kho</label>
                                        <input type="text" name="MNVK" id="MNVK" class="form-control"
                                            placeholder="" aria-describedby="MNVK-messs"
                                            onblur="test('#MNVK', ktMNVK)">
                                        <small id="MNVK-mess"></small>
                                    </div>
                                    
                                    </div>
                                    
                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                                        <input type="submit" class="btn btn-primary" value="Thêm phiếu" name="btnInsertPhieuNhapKho"/>
                                    </div>

                                    </div>
                                    </form>
                                </div>
                                </div>
                                  
                </div>
             
   
            </div>
            

            <div class="modal fade" id="ModalPXK" tabindex="-1" aria-labelledby="modalPXKLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">Thêm phiếu xuất kho</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                    <!-- Modal body -->
                                    <form action="#" name="formThemPXK" method="get">
                                    <div class="modal-body">
                                    <div class="form-group">
                                    <input type="hidden" name="MPXK" id="MPNK" class="form-control"
                                                placeholder="" aria-describedby="MPXK-messs"
                                                onblur="test('#MPXK', ktMPNK)">
                                            <small id="MPXK-mess"></small>
                                        </div>

                                        <div class="form-group">
                                            <label for="">Trạng Thái Phiếu Xuất Kho</label>
                                            <input type="text" name="TTPX" id="TTPX" class="form-control"
                                                placeholder="" aria-describedby="TTPX-messs"
                                                onblur="test('#TTPX', ktTTPX)">
                                            <small id="TTPX-mess"></small>
                                        </div>
                                        <div class="form-group">
                                        <label for="">Ngày Lập Phiếu Xuất Kho</label>
                                        <input type="date" name="NLPXK" id="NLPXK" class="form-control"
                                            placeholder="vi du: 20/11/2023" aria-describedby="NLPXK-mess"
                                            onblur="test('#NLPXK', NLPNK)">
                                        <small id="NLPXK-mess"></small>
                                    </div>
                                        <div class="form-group">
                                    <label for="">Mã Sản Phẩm</label>
                                        <input type="text" name="MSP" id="MSP" class="form-control"
                                            placeholder="" aria-describedby="MSP-messs"
                                            onblur="test('#MSP', ktMSP)">
                                        <small id="MSP-mess"></small>
                                    </div>
                                    <div class="form-group">
                                    <label for="">Mã nhân viên kiểm tra kho</label>
                                        <input type="text" name="MNVK" id="MNVK" class="form-control"
                                            placeholder="" aria-describedby="MNVK-messs"
                                            onblur="test('#MNVK', ktMNVK)">
                                        <small id="MNVK-mess"></small>
                                    </div>
                                            
                                    </div>

                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                                        <input type="submit" class="btn btn-primary" value="Thêm phiếu" name="btnInsertPhieuXuatKho"/>
</div>

                                    </div>
                                    </form>
                                </div>
                                </div>
                                  
                </div>
            
        
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>

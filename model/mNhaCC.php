<?php
    include_once("connect.php");

    class MNhaCC {
        function selectAllNCC() {
            $p = new KetNoiDB();
            // $con;
            if ($p->moKetNoi($con)) {
                $str = "SELECT * FROM nhacungcap";
                $tbl = mysqli_query($con,$str); // Use mysqli_query with the connection parameter
                $p->dongKetNoi($con);
                return $tbl;
            } else {
                return false;
            }
        }

    }
?>
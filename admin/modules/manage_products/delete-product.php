<?php 
    include("../../config/connection.php"); 
    if (isset($_GET['id_pro'])) {
    $ID_SanPham=$_GET['id_pro'];
    $query_select_image = "SELECT Img FROM sanpham WHERE ID_SanPham = $ID_SanPham";
    $result_select_image = mysqli_query($mysqli, $query_select_image);
    $row_select_image = mysqli_fetch_assoc($result_select_image);
    $imageToDelete = $row_select_image['Img'];
    unlink("../../../assets/image/product/".$imageToDelete);
    $sql_comment = "DELETE FROM  binhluan WHERE ID_SanPham='".$ID_SanPham."'";
    mysqli_query($mysqli,$sql_comment);
    $sql="DELETE FROM  sanpham WHERE ID_SanPham='".$ID_SanPham."'";
    mysqli_query($mysqli,$sql);
    }
    header('location: ../../index.php?product=list-product');
?>
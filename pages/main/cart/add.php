<?php
include("../../../admin/config/connection.php");
session_start();

// Kiểm tra xem session ID Giỏ hàng đã tồn tại chưa
if (!isset($_SESSION['ID_GioHang'])) {
    // Nếu chưa tồn tại, tạo một ID mới cho giỏ hàng
    $sql_create_cart = "INSERT INTO giohang() VALUES ()"; // Tạo một giỏ hàng mới
    if (mysqli_query($mysqli, $sql_create_cart)) {
        // Lấy ID mới vừa tạo
        $new_cart_id = mysqli_insert_id($mysqli);
        
        // Lưu ID mới vào session
        $_SESSION['ID_GioHang'] = $new_cart_id;
    } else {
        // Xử lý lỗi nếu quá trình tạo giỏ hàng mới thất bại
        echo "Lỗi: " . mysqli_error($mysqli);
        exit(); // Dừng chương trình
    }
}

// Tiếp tục xử lý của bạn...
if(isset($_GET['id']) && isset($_POST['soluong'])){
    $id_product = $_GET['id'];
    $soluong = (int)$_POST['soluong'];
    $id_giohang = $_SESSION['ID_GioHang'];

    // Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng hay chưa
    $sql_check_product = "SELECT * FROM chitietgiohang WHERE ID_GioHang = '$id_giohang' AND ID_SanPham = '$id_product'";
    $result_check_product = mysqli_query($mysqli, $sql_check_product);

    if (!$result_check_product || mysqli_num_rows($result_check_product) == 0) {
        // Nếu sản phẩm chưa tồn tại trong giỏ hàng, thêm mới
        $sql_addtocart="INSERT INTO chitietgiohang(ID_GioHang,ID_SanPham,SoLuong) VALUES('$id_giohang','$id_product','$soluong')";
        $add_result = mysqli_query($mysqli, $sql_addtocart);

        if (!$add_result) {
            // Xử lý lỗi nếu truy vấn INSERT không thành công
            echo "Lỗi: " . mysqli_error($mysqli);
            exit();
        }
    } else {
        // Nếu sản phẩm đã tồn tại trong giỏ hàng, cập nhật số lượng
        $sql_update_quantity = "UPDATE chitietgiohang SET SoLuong = SoLuong + $soluong WHERE ID_GioHang = '$id_giohang' AND ID_SanPham = '$id_product'";
        $update_result = mysqli_query($mysqli, $sql_update_quantity);

        if (!$update_result) {
            // Xử lý lỗi nếu truy vấn UPDATE không thành công
            echo "Lỗi: " . mysqli_error($mysqli);
            exit();
        }
    }

    // Chuyển hướng đến trang giỏ hàng
    header('location: ../../../index1.php?navigate=cart');
    exit();
}
?>

<?php
    $id_order = isset($_GET['id']) ? $_GET['id'] : '';
    $sql_order = "SELECT NguoiNhan, SoDienThoai, DiaChi, ThoiGianLap,
        GhiChu, CodeOrder, HinhThucThanhToan, GiaTien, XuLy 
        from donhang where ID_DonHang = $id_order";
    $query_order = mysqli_query($mysqli, $sql_order);
    $row = mysqli_fetch_assoc($query_order);
    $sql_order_detail = "SELECT TenSanPham, chitietdonhang.SoLuong,
    chitietdonhang.GiaMua from sanpham inner join chitietdonhang
    on chitietdonhang.ID_SanPham = sanpham.ID_SanPham
    where chitietdonhang.ID_DonHang = $id_order";
    $query_order_detail = mysqli_query($mysqli, $sql_order_detail);
?>
<div class="container mt-60 min-height-100">  
    <table class="table-bordered w-100 bg-white" cellpadding="5px">
        <tr>
            <th colspan="4"><h1 class="text-center">Chi tiết đơn hàng</h1></th>
        </tr>
        <tr>
            <td colspan="2">Người nhận: <?= $row['NguoiNhan']?></td>
            <td colspan="2">Số điện thoại: <?= $row['SoDienThoai']?></td>
        </tr>
        <tr>
            <td colspan="2">Địa chỉ: <?= $row['DiaChi']?></td>
            <td colspan="2">Thời gian: <?= $row['ThoiGianLap']?></td>
        </tr>
        <tr>
            <td colspan="4">Ghi chú: <?= $row['GhiChu']?></td>
        </tr>
        <tr>
            <td colspan="2">Mã đơn hàng: <?= $row['CodeOrder']?></td>
            <td colspan="2">Hình thức thanh toán: <?= $row['HinhThucThanhToan']?></td>
        </tr>
        <tr>
            <th>STT</th>
            <th>Tên sản phẩm</th>
            <th>Số lượng</th>
            <th>Giá mua</th>
        </tr>
        <?php 
        $i=0;
        while($row_detail = mysqli_fetch_assoc($query_order_detail)){
            $i++;    
        ?>
        <tr>
            <td><?= $i?></td>
            <td><?= $row_detail['TenSanPham']?></td>
            <td><?= $row_detail['SoLuong']?> </td>
            <td><?= number_format($row_detail['GiaMua'],0,',','.')?> VND</td>
        </tr>
        <?php }?>
        <tr>
            <th colspan="4">Tổng tiền: <?= number_format($row['GiaTien'],0,',','.')?> VND</th>
        </tr>
    </table>
    <?php
        if($row['XuLy'] == 0)  {
    ?>
     <div class="text-center mt-60"><a class="btn btn-danger" href="pages/main/order/cancel.php?id_cancel=<?= $id_order?>">Hủy đơn hàng</a></div>
     <?php }?>
</div>
<?php
error_reporting(0);
include '../../_config.php';
$get_pack = mysqli_query($conn, "SELECT MIN(price) FROM package WHERE");
$package = mysqli_fetch_assoc($get_pack);
if (isset($_POST['han'], $_POST['goi'], $_POST['rule'])) {
    if ($_POST['han'] < 0 || $_POST['han'] > 12 || $_POST['goi'] < $package['MIN(price)']) {
        echo 'Không hợp lệ, chú định bug à, quên mẹ cái mùa xuân ấy đê :)))';
    } else {
        $price = $_POST['han'] * $_POST['goi'];
        if ($_POST['rule'] == 'agency') {
            $price -= $price * 10 / 100;
        } else if ($_POST['rule'] == 'freelancer') {
            $price -= $price * 5 / 100;
        }
        if (!isset($_POST['coupon'])) {
            echo number_format($price) . ' VNĐ';
        } else if (isset($_POST['coupon'])) {
            $coupon = $_POST['coupon'];
            $get = mysqli_query($conn, "SELECT sale_off, code, min_price, COUNT(*) FROM coupon WHERE code = '$coupon' GROUP BY sale_off,code,min_price");
            $cop = mysqli_fetch_assoc($get);
            if ($cop['COUNT(*)'] == 1) {
                if (strcmp($coupon, $cop['code']) == 0) {
                    if ($cop['min_price'] <= $_POST['han'] * $_POST['goi']) {
                        $price -= $price * $cop['sale_off'] / 100;
                        $result = array(
                            'status' => 'OK',
                            'price' => number_format($price) . ' VNĐ',
                            'sale_off' => $cop['sale_off'],
                            'code' => $_POST['coupon'],
                            'msg' => 'Bạn đã áp dụng thành công mã giảm giá '. $_POST['coupon'] . ' và được giảm ' .$cop['sale_off']. '% tổng giá trị đơn hàng'
                        );
                    } else {
                        $result = array(
                            'status' => 'cc',
                            'min_price' => $cop['min_price'],
                            'error_msg' => 'Mã khuyến mại này chỉ áp dụng cho đơn hàng có giá trị tối thiểu là: '.number_format($cop['min_price']).' VNĐ'
                        );
                    }
                } else {
                    $result = array(
                        'status' => 'Loz',
                        'error_msg' => 'Vui lòng nhập đúng định dạng, phân biệt chữ HOA và chữ thường!!!'
                        );
                }
            } else {
                $result = array(
                    'status' => 'Fail',
                    'error_msg' => 'Mã khuyến mại không tồn tại, đã hết hạn, hoặc không được áp dụng cho dịch vụ này!!!'
                );
            }
            echo json_encode($result);
        }
    }
}
?>
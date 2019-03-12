<?php if($rule != 'admin'){
    header('Location: index.php');
}
if(isset($_POST['xoa'])){
    mysqli_query($conn, "UPDATE member SET payment = 0");
    echo "<script>alert('Thành công !!');location.href='index.php?vip=Statics';</script>";
}
?>
<div class="box wow fadeIn">
    <div class="box-header">
        <h3 class="box-title">Thống kê doanh thu tháng <?php echo date('m/Y'); ?> </h3>
<?php if($rule == 'admin' && $idctv == 1){ ?> <form method="post"><button type="submit" name="xoa" class="btn btn-danger">Xóa Doanh Thu All</button></form> <?php } ?>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
            <div class="table-responsive">
            <table id="example2" class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên</th>
                        <th>ID Facebook</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Doanh Thu Tháng <?php echo date('m/Y'); ?></th>
                        <?php if($idctv == 1) {?><th>Thao tác</th> <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $getvip = "SELECT * FROM member WHERE `num_id` > '0' ORDER BY `payment` DESC";
                    $result = mysqli_query($conn, $getvip);
                    while ($x = mysqli_fetch_assoc($result)) {
                            $id = $x['id_ctv'];
                            $name = $x['name'];
                            $u_name = $x['user_name'];
                            $idfb = $x['profile'];
                            $num = $x['num_id'];
                            $pay = $x['payment'];
                            $email = $x['email'];
                            $phone = $x['phone'];
                        ?>
                        <tr style="font-weight: bold">
                            <td><?php echo $id; ?></td>
                            <td><?php echo $name; ?> (<?php echo $u_name; ?>)</td>
                            <td><?php echo $idfb; ?> </td>
                            <td><?php echo $email; ?> </td>
                            <td><?php echo $phone; ?> </td>
                           
                            <td style="color:red"><?php echo number_format($pay). ' VNĐ'; ?></td>
                            <?php if($idctv == 1){ ?> <td><a href="index.php?vip=Reset_Statics&id_ctv=<?php echo $id; ?>" class="btn btn-danger">Reset</a><!--  <a href="index.php?vip=Update_Statics&id_ctv=<?php echo $id; ?>" class="btn btn-info">Cập nhật</a></td> --><?php } ?>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            </div>
            </div>

            </div>
            </div>
            <p class="alert alert-success" style="text-align: justify;"><span class="h4">Doanh thu tự động được cộng khi thêm ID VIP mới, khi chuyển tiền cho thành viên ( Đại lí, CTV ) khác, khi tạo gift code (khi muốn tạo gift code cho event gì đó thì liên hệ Admin Full để tạo, hoặc tự tạo thì sẽ tính vào doanh thu). Mọi giao dịch đều được lưu vào lịch sử. Không gian lận tạo clone, tạo gift.. đều được ghi vào lịch sử và doanh thu nhé :)</span></p>
        </div>
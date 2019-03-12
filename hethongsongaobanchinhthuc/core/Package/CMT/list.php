<?php
if ($rule != 'admin' || $idctv != 1) {
    echo "<script>alert('Ra chỗ khác chơi');window.location='index.php';</script>";
}
?>
<script>
    function check(id) {
        if (confirm('Bạn có chắc chắn muốn xóa package này ?') == true) {
            window.location = 'index.php?vip=Delete_Package_CMT&id_package=' + id;
        } else {
            return false;
        }
    }
</script>
<div class="box wow fadeIn">
    <div class="box-header">
        <h3 class="box-title">Danh sách Package CMT | <a href="index.php?vip=Add_Package_CMT" class="btn btn-danger">Thêm Package</a></h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive">
            <table id="orderPrice" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Max CMT</th>
                        <th>Giá tiền</th>
                        <th>Package Type</th>
                        <?php if($rule == 'admin') echo "<th>Người tạo</th>"; ?>
                        <th>Công cụ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if($rule != 'admin'){
                        $get = "SELECT id, max, price FROM package WHERE type='CMT' AND id_ctv=$idctv";
                    }else{
                        $get = "SELECT package.id, package.price, package.max, member.name,member.user_name FROM package INNER JOIN member ON package.id_ctv = member.id_ctv WHERE package.type = 'CMT'";
                    }
                    $result = mysqli_query($conn, $get);
                    while ($x = mysqli_fetch_assoc($result)) {
                        $id = $x['id'];
                        if(isset($x['name'], $x['user_name'])){
                            $name = $x['name'];
                            $u_name = $x['user_name'];
                        }                        ?>
                        <tr style="font-weight: bold">
                            <td><?php echo $x['id']; ?></td>
                            <td><?php echo $x['max']; ?></td>
                            <td><?php echo number_format($x['price']); ?> VNĐ</td>
                            <td>VIP CMT</td>
                            <?php echo isset($u_name, $name) ?  "<td>$name ($u_name)</td>" : ''; ?>
                            <td style="text-align:center"><a href="index.php?vip=Update_Package_CMT&id_package=<?php echo $id; ?>" class="btn btn-info">Sửa</a> <a href="#" onclick="check(<?php echo $id; ?>);" class="btn btn-danger">Xóa</a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
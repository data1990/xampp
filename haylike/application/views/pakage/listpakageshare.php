<script>
    function check(id) {
        if (confirm('Bạn có chắc chắn muốn xóa package này ?') == true) {
            window.location = 'index.php?vip=Delete_Package_Like&id_package=' + id;
        } else {
            return false;
        }
    }
</script>
<div class="box wow fadeIn">
    <div class="box-header">
        <h3 class="box-title">Danh sách Package SHARE | <a href="index.php?vip=Add_Package_Like" class="btn btn-danger">Thêm Package</a></h3>
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
                        <?php if($this->session->userdata['logged_in']['rule'] == 'admin') echo "<th>Người tạo</th>"; ?>
                        <th>Công cụ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                   if(isset($vippakage)){
                       foreach ($vippakage as $row)                
                        {
                        $id = $row['id'];
                        if(isset($row['name'], $row['user_name'])){
                            $name = $row['name'];
                            $u_name = $row['user_name'];
                        }                        ?>
                        <tr style="font-weight: bold">
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['max']; ?></td>
                            <td><?php echo number_format($row['price']); ?> VNĐ</td>
                            <td>VIP SHARE</td>
                            <?php echo isset($u_name, $name) ?  "<td>$name ($u_name)</td>" : ''; ?>
                            <td style="text-align:center"><a href="index.php?vip=Update_Package_Like&id_package=<?php echo $id; ?>" class="btn btn-info">Sửa</a> <a href="#" onclick="check(<?php echo $id; ?>);" class="btn btn-danger">Xóa</a></td>
                        </tr>
                    <?php }} ?>
                </tbody>
            </table>
        </div>
    </div>
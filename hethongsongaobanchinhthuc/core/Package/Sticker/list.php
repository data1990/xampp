<?php
if ($rule != 'admin' || $idctv != 1) {
    echo "<script>alert('Ra chỗ khác chơi');window.location='index.php';</script>";
}
?>
<script>
    function check(id) {
        if (confirm('Bạn có chắc chắn muốn xóa sticker này ?') == true) {
            window.location = 'index.php?vip=Delete_Sticker&idsticker=' + id;
        } else {
            return false;
        }
    }
</script>
<div class="box wow fadeIn">
    <div class="box-header">
        <h3 class="box-title">Danh sách idsticker Like | <a href="index.php?vip=Add_idsticker_Like" class="btn btn-danger">Thêm idsticker</a></h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive">
            <table id="orderPrice" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>ID STICKER</th>
                        <?php if($rule == 'admin') echo "<th>Người tạo</th>"; ?>
                        <th>Công cụ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if($rule != 'admin'){
                        $get = "SELECT * FROM idsticker AND id_ctv=$idctv";
                    }else{
                        $get = "SELECT idsticker.id, idsticker.idsticker, idsticker.name, member.name, member.user_name FROM idsticker INNER JOIN member ON idsticker.id_ctv = member.id_ctv";
                    }
                    $result = mysqli_query($conn, $get);
                    while ($x = mysqli_fetch_assoc($result)) {
                        $id = $x['id'];
                        if(isset($x['name'], $x['user_name'])){
                            $name = $x['name'];
                            $u_name = $x['user_name'];
                        }                        ?>
                        <tr style="font-weight: bold">
                            <td><?php echo $xname; ?></td>
                            <td><?php echo $x['idsticker']; ?></td>
                            <?php echo isset($u_name, $name) ?  "<td>$name ($u_name)</td>" : ''; ?>
                            <td style="text-align:center"><a href="index.php?vip=Update_Sticker&idsticker=<?php echo $id; ?>" class="btn btn-info">Sửa</a> <a href="#" onclick="check(<?php echo $id; ?>);" class="btn btn-danger">Xóa</a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
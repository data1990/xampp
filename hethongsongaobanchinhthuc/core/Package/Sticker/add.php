<?php
if ($rule != 'admin' || $idctv != 1) {
    echo "<script>alert('Ra chỗ khác chơi');window.location='index.php';</script>";
}
?>
<?php
if (isset($_POST['submit'])) {
    $loi = array();
    $get_max = "SELECT idsticker FROM idsticker";
    $r_max = mysqli_query($conn, $get_max);
    while ($max = mysqli_fetch_assoc($r_max)) {
        foreach ($_POST['idsticker'] as $idsticker) {
            if ($max['idsticker'] == $idsticker) {
                $loi['exists'] = '<font color="red">Đã tồn tại Sticker này</font>';
            }
        }
    }
    if (empty($loi)) {
        $idsticker = $_POST['idsticker'];
        $name = $_POST['name'];
        $package = array_combine($name, $idsticker);
        $sql = "INSERT INTO idsticker(idsticker, name, id_ctv) VALUES";
        foreach ($package as $k => $v) {
            $sql .= "($k,$v,$idctv),";
        }
        $sql = substr($sql, 0, strlen($sql) - 1);
        if (mysqli_query($conn, $sql)) {
            $content = "<b>$uname</b> vừa thêm 1 ID <b>Sticker</b>";
            $time = time();
            $his = "INSERT INTO history(content, time, id_ctv) VALUES('$content', '$time', '$idctv')";
            if (mysqli_query($conn, $his)) {
                echo "<script>alert('Thêm sticker thành công');window.location='index.php?vip=Add_Sticker';</script>";
            }
        }
    }
}
?><div class="row">
    <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-info wow fadeIn">
            <div class="box-header with-border">
                <h3 class="box-title">Thêm Sticker</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="#" method="post">
                <div class="box-body" id="list">
                    <div class="form-group">
                        <div class="col-sm-6">
                            <label for="user_id" class="col-sm-2 control-label">ID Sticker:</label>

                            <div class="col-sm-10">
                                <input type="number" name="idsticker[]" class="form-control" placeholder="Nhập id sticker" required/>
                                <b><?php echo isset($loi['exists']) ? $loi['exists'] : ''; ?></b>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="profile" class="col-sm-2 control-label">Tên Sticker:</label>

                            <div class="col-sm-10">
                                <input type="text" name="name[]" class="form-control" placeholder="Nhập tên sticker" required/>
                            </div>
                        </div>
                    </div> 
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="button" id="add" onclick="add_package()" class="btn btn-success">Thêm package</button>
                    <button type="submit" name="submit" class="btn btn-info pull-right">Gửi yêu cầu</button>
                </div>
                <!-- /.box-footer -->
            </form>
        </div>
    </div>
</div>
<script>
    function add_package() {
        var content = '<div class="form-group"><div class="col-sm-6"><label for="user_id" class="col-sm-2 control-label">ID Sticker:</label><div class="col-sm-10"><input type="number" max="10000" required name="idsticker[]" class="form-control" placeholder="Nhập id sticker" /></div></div><div class="col-md-6"><label for="profile" class="col-sm-2 control-label">Tên Sticker:</label><div class="col-sm-10"><input type="text" max="1000000" required name="idsticker[]" class="form-control" placeholder="Nhập tên sticker"/></div></div></div>';
        $('#list').append(content);
    }
</script>

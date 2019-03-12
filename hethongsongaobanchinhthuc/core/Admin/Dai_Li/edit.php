<?php
if($rule !='admin'){
    header('Location: index.php');
}
?>
<?php
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $get = "SELECT user_name, email, profile, name, phone,rule FROM member WHERE id_ctv=$id";
    $result = mysqli_query($conn, $get);
    $x = mysqli_fetch_assoc($result);
    if(isset($_POST['submit'])){
        $name = $_POST['name'];
        $profile = $_POST['profile'];
        $sdt = $_POST['sdt'];
        // $email = $_POST['email'];
        $update = "UPDATE member SET name='$name', profile='$profile', phone='$sdt' WHERE id_ctv = $id";
        if(mysqli_query($conn, $update)){
            $content = "<b>$uname</b> vừa cập nhật thông tin tài khoản của Đại lí <b>{$x['name']}</b> | Tên: <b>$name</b>, Phone: <b>$sdt</b>, ID FB: <b>$profile</b>";
            $time = time();
            $his = "INSERT INTO history(content, time, id_ctv, type) VALUES('$content', '$time', '$idctv',1)";
            if(mysqli_query($conn, $his)){
             echo "<script>alert('Cập nhật thông tin thành công'); window.location='index.php?vip=List_Agency';</script>";
            }
        }
    }
}
?>
<div class="row">
    <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-info wow fadeIn">
            <div class="box-header with-border">
                <h3 class="box-title">Cập nhật thông tin CTV</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="#" method="post">
                <div class="box-body">
                    <div class="form-group">
                        <label for="username" class="col-sm-2 control-label">Tài khoản:</label>

                        <div class="col-sm-10">
                            <input type="text" minlength="4" class="form-control" value="<?php echo isset($x['user_name']) ? $x['user_name'] : ''; ?>" disabled>
                            
                        </div>
                    </div>
                     <div class="form-group">
                        <label for="email" class="col-sm-2 control-label">Email:</label>

                        <div class="col-sm-10">
                            <input type="email" class="form-control" value="<?php echo isset($x['email']) ? $x['email'] : ''; ?>" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Họ tên:</label>

                        <div class="col-sm-10">
                            <input type="text" minlength="2" class="form-control" value="<?php echo isset($x['name']) ? $x['name'] : ''; ?>" id="name" name="name" placeholder="Họ và tên" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="phone" class="col-sm-2 control-label">Số điện thoại:</label>

                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="sdt" value="<?php echo isset($x['phone']) ? $x['phone'] : ''; ?>" name="sdt" placeholder="Số điện thoại" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="profile" class="col-sm-2 control-label">ID Facebook:</label>

                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="profile" value="<?php echo isset($x['profile']) ? $x['profile'] : ''; ?>" name="profile" placeholder="Nhập user id facebook" required>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <?php if($rule != 'admin'){ ?><font color="red"><b>Để đổi Username & Email Liên hệ <a href="//fb.com/1941732149410907" target="_blank"><b>Admin</b></a></b></font> <?php } ?>
                    <button type="submit" name="submit" class="btn btn-info pull-right">Cập nhật thông tin</button>
                </div>
                <!-- /.box-footer -->
            </form>
        </div>
    </div>
</div>
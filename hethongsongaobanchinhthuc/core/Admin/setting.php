<?php defined('COPYRIGHT') OR exit('hihi'); ?>
<?php if($rule != 'admin') header('Location: index.php'); ?>
<div class="row">
<div class="col-lg-12"> 
 <div class="panel panel-default"> 
                   <div class="panel-heading"> 
<b><i class="fa fa-tint text-green"></i> Tuỳ chọn tuỳ chỉnh</b> 
                        </div> 
<div class="panel-body"> 

<?php 
if (isset($_POST['chinhsua'])) { 
    $thongbao = $_POST['thongbao']; 
    $dangki = $_POST['dangki'];
    $viplike = $_POST['viplike'];
    $viplike2 = $_POST['viplike2'];
    $vipcmt = $_POST['vipcmt'];
    $title = $_POST['title'];
    $keyword = $_POST['keyword'];
    $description = $_POST['description'];
    $icon = $_POST['icon'];
    $banner = $_POST['banner'];
    $nameadmin = $_POST['nameadmin'];
    $idadmin = $_POST['idadmin'];
    $logo = $_POST['logo'];
mysqli_query($conn, "UPDATE setting SET thongbao = '$thongbao', viplike = '$viplike', viplike2 = '$viplike2', vipcmt = '$vipcmt', dangki = '$dangki', title='$title', keyword='$keyword', description='$description', icon='$icon', logo='$logo', banner='$banner', nameadmin='$nameadmin', idadmin = '$idadmin' WHERE id = '1'"); 
echo '<div class="alert alert-success">Chỉnh sửa cài đặt thành công!!</div>'; 
} 
?> 
<form action="" method="POST"> 

<div class="form-group"> 
                    <label>Cho phép người dùng đăng ký :</label> <font color="red">Đang <b><?php if($getsetting['dangki'] == 'on'){
 echo 'mở';}else{ echo 'đóng';}?></b></font>
                    <select class="form-control" name="dangki"> 
                        <option value="on" <?php if($getsetting['dangki'] == 'on') echo 'selected=""'; ?>>Mở</option> 
                        <option value="off" <?php if($getsetting['dangki'] == 'off') echo 'selected=""'; ?>>Đóng</option> 
                    </select> 
                </div> 
<div class="form-group"> 
                    <label>Trạng thái vip sever 1 :</label> <font color="red">Đang <b><?php if($getsetting['viplike'] == 'on'){
 echo 'mở';}else{ echo 'đóng';}?></b></font>
                    <select class="form-control" name="viplike"> 
                        <option value="on" <?php if($getsetting['viplike'] == 'on') echo 'selected=""'; ?>>Mở</option> 
                        <option value="off" <?php if($getsetting['viplike'] == 'off') echo 'selected=""'; ?>>Đóng</option> 
                    </select> 
                </div> 
<div class="form-group"> 
                    <label>Trạng thái vip sever 2 :</label> <font color="red">Đang <b><?php if($getsetting['viplike2'] == 'on'){
 echo 'mở';}else{ echo 'đóng';}?></b></font>
                    <select class="form-control" name="viplike2"> 
                        <option value="on" <?php if($getsetting['viplike2'] == 'on') echo 'selected=""'; ?>>Mở</option> 
                        <option value="off" <?php if($getsetting['viplike2'] == 'off') echo 'selected=""'; ?>>Đóng</option> 
                    </select> 
                </div> 
<div class="form-group"> 
                    <label>Trạng thái vip cmt :</label> <font color="red">Đang <b><?php if($getsetting['vipcmt'] == 'on'){
 echo 'mở';}else{ echo 'đóng';}?></b></font>
                    <select class="form-control" name="vipcmt"> 
                        <option value="on" <?php if($getsetting['vipcmt'] == 'on') echo 'selected=""'; ?>>Mở</option> 
                        <option value="off" <?php if($getsetting['vipcmt'] == 'off') echo 'selected=""'; ?>>Đóng</option> 
                    </select> 
                </div> <div class="form-group"> 
                    <label for="name">Thông báo: </label> 
                    <textarea class="form-control" id="thongbao" name="thongbao" rows="5" placeholder="Nội dung cmt..." required="" autofocus=""><?php echo $getsetting['thongbao']; ?></textarea> 
                </div>  
<hr>
<center><b>~.~.~.~ EDIT NÂNG CAO ~.~.~.~</b></center>
<!--Setting 1 lần-->
                        <div class="form-group">
                            <label>Tên trang:</label><input type="text" placeholder="Ví dụ : Hệ Thống Bot Cảm Xúc Bá Nhất Việt Nam" name="title" value="<?php echo $getsetting['title']; ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Mô tả trang web :</label>
                            <textarea name="description" class="form-control" rows="3" placeholder="Ví dụ : Hệ thống vip cảm xúc hot nhất việt nam "><?php echo $getsetting['description']; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Từ khóa:</label>
                            <textarea name="keyword" class="form-control" rows="5" placeholder="Cách nhau bởi dấu phẩy, ví dụ : vip like, vip cảm xuc<?php echo $getsetting['nameadmin']; ?>,..."><?php echo $getsetting['keyword']; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Logo:</label><input type="text" placeholder="Liên kết google hoặc bất cứ kỳ ở đâu để lấy logo" name="logo" value="<?php echo $getsetting['logo']; ?>" class="form-control">
                        </div>                        <div class="form-group">
                            <label>Icon:</label><input type="text" placeholder="Liên kết google hoặc bất cứ kỳ ở đâu để lấy icon" name="icon" value="<?php echo $getsetting['icon']; ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Banner:</label><input type="text" placeholder="Liên kết google hoặc bất cứ kỳ ở đâu để lấy banner, banner này tức là banner sẽ hiển thị ảnh khi đăng trang web lên Facebook hoặc website bất kỳ nào đó" name="banner" value="<?php echo $getsetting['banner']; ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Tên Admin :</label><input type="text" placeholder="Nhập tên bạn nếu bạn là Admin trang web này" name="nameadmin" value="<?php echo $getsetting['nameadmin']; ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>IDFB ADMIN:</label><input type="number" placeholder="Nhập ID FB ADMIN NẾU BẠN LÀ ADMIN TRANG WEB NÀY" name="idadmin" value="<?php echo $getsetting['idadmin']; ?>" class="form-control">
                        </div>

  <button type="submit" name="chinhsua" class="btn btn-danger btn-block">Chỉnh Sửa</button> 
</form> 
<br/> 
        <div class="card-footer small text-muted">Chức năng chỉ dành cho Admin</div> 
      </div> 
      </div> 
      </div> 
            </div> 
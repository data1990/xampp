<?php
if ($rule != 'admin' || $idctv != 1) {
    echo "<script>alert('Ra chỗ khác chơi');window.location='index.php';</script>";
}
?>
<?php
    if(isset($_GET['id_package'])){
        $id = $_GET['id_package'];
        $get = "SELECT id_ctv FROM package WHERE id = $id AND type='REACTION'";
        $result = mysqli_query($conn, $get);
        $x = mysqli_fetch_assoc($result);
        if($rule != 'admin'){
            if($x['id_ctv'] != $idctv){
                echo "<script>alert('CÚT');window.location='index.php';</script>";
            }else{
                $xoa = "DELETE FROM package WHERE id=$id";
                if(mysqli_query($conn, $xoa)){
                    echo "<script>alert('Xóa thành công'); window.location='index.php?vip=List_Package_Reaction';</script>";
                }
            }
        }else{
            $xoa = "DELETE FROM package WHERE id=$id";
                if(mysqli_query($conn, $xoa)){
                    echo "<script>alert('Xóa thành công'); window.location='index.php?vip=List_Package_Reaction';</script>";
                }
        }
    }
?>
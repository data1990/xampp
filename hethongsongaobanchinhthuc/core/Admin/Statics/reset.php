<?php
    if($rule != 'admin' || $idctv != 1){
        echo "<script>alert('CÚT'); window.location = 'index.php';</script>";
    }
?>
<?php
if(isset($_GET['id'])){
	$id = $_GET['id'];
    $sql = "UPDATE member SET payment = 0 WHERE id_ctv=$id";
    if(mysqli_query($conn, $sql)){
        header('Location: index.php?vip=Statics');
    }
}else if(isset($_GET['id_ctv'])){
	$id_ctv = $_GET['id_ctv'];
    $sql = "UPDATE member SET payment = 0 WHERE id_ctv=$id_ctv";
    if(mysqli_query($conn, $sql)){
        header('Location: index.php?vip=Statics');
    }
}
?>
<?php
include '../../../_config.php';
if(isset($_GET['idvip'], $_GET['sever'])){
	$idvip = $_GET['idvip'];
    $sever= $_GET['sever'];
    if($sever == 'sv1'){
        $get = "SELECT COUNT(*), name, user_id, max_like, limitpost FROM vip WHERE user_id='$idvip' GROUP BY user_id, name, max_like, limitpost";
    }else if($sever == 'sv2'){
        $get = "SELECT COUNT(*), name, user_id, max_like, limitpost FROM vipsv2 WHERE user_id='$idvip' GROUP BY user_id, name, max_like, limitpost";
    }
	$result = mysqli_query($conn, $get);
	$x = mysqli_fetch_assoc($result);
	$c = $x['COUNT(*)'];
	$name = $x['name'];
	$maxlike = $x['max_like'];	
	$limitpost = $x['limitpost'];

	if($c == 1){
		echo "Name: <font color='red'><b>$name</b></font><br /> Gói Like: <font color='red'><b>$maxlike Like</b></font><br />Limit Post: <font color='red'><b>$limitpost</b></font><br />";
	}else{
		echo "<code>KHÔNG TÌM THẤY ID NÀY! VUI LÒNG KIỂM TRA LẠI CHỌN SEVER ĐÃ CÀI</code>";
	}
}else{
	echo '<code>Vui lòng chọn đầy đủ thông tin <b>ID VIP</b> và <b> SEVER ĐÃ CÀI </b> chính xác!!!</code>';
}
?>
<script>
    function check(id){
            swal({
              title: 'Bạn có chắc chắn muốn xóa VIP ID này ?',
              text: "Hành động bạn đăng làm sẽ không được hoàn tác lại! Vui lòng cân nhắc.!",
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Vâng, Tôi muốn!',
              cancelButtonText: 'Trở về'
            }).then(function() {
              location.href = 'index.php?vip=Delete_Like_SV1&id_like=' + id;
            })
        }
</script>
<div class="box wow fadeIn">
    <div class="box-header">
        <h3 class="box-title">Danh sách ID VIP Cảm Xúc</h3><br> <kbd>Bạn đang thực hiện việc xem ID ở Sever 1!</kbd>
        </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive">
       
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User ID</th>
                    <th>Tên</th>
                    <th>Ngày mua</th>
                    <th>Thời hạn</th>
                    <th>Còn lại</th>
                    <th>CX / Cron</th>
                    <th>Max CX</th>
                    <th>Loại</th>
                    <th>Thanh toán</th>
                    <th>Trạng thái</th>
                    <?php
                    if ($rule == 'admin') {
                        echo '<th>Người thêm</th>';
                    }
                    ?>
                    <th>Công cụ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($rule != 'admin') {
                    $get = "SELECT id,user_id, name, han, likes, max_like, start, end, pay,type FROM vip WHERE id_ctv=$idctv";
                } else if($rule == 'admin' && $idctv !=1){
                    $get = "SELECT id, user_id, vip.name, han, likes, max_like, start, end, pay,type,member.rule, member.name AS ctv_name,member.user_name,rule FROM vip INNER JOIN member ON vip.id_ctv = member.id_ctv WHERE vip.id_ctv > 0";
                }else{
                    $get = "SELECT id, user_id, vip.name, han, likes, max_like, start, end, pay,type,member.rule, member.name AS ctv_name,member.user_name,rule FROM vip INNER JOIN member ON vip.id_ctv = member.id_ctv";
                }
                $result = mysqli_query($conn, $get);
                while ($x = mysqli_fetch_assoc($result)) {
                    $start = $x['start'];
                    $type = $x['type'];
                    if(strripos($x['type'], "\n")){
                        $type = str_replace("\n", "-", $x['type']);
                        $type = str_replace(array('LIKE','HAHA','LOVE','WOW','SAD','ANGRY'), array('L','H','LV','W','S','A'), $type);
                    }
                    $rl = '';
                    if(isset($x['rule']) && $x['rule'] == 'member'){
                        $rl = '<font color="blue">Member</font>';
                    }else if(isset($x['rule']) && $x['rule'] == 'agency'){
                        $rl = '<font color="violet">Đại lí</font>';
                    }elseif(isset($x['rule']) && $x['rule'] == 'freelancer'){
                        $rl = '<font color="blue">CTV</font>';
                    }else{
                        $rl = '<font color="red">Admin</font>';
                    }
                    $han = $x['han']. ' tháng';
                    if($x['han'] == 'one'){
                        $han = '1 ngày';
                    }else if($x['han'] == 'three'){
                        $han = '3 ngày';
                    }else if($x['han'] == 'seven'){
                        $han = '7 ngày';
                    }
                    $z = $x['end'] - time();
                    $id = $x['id'];
                    $ngay = date('z',$z);
                    $gio = date('H',$z);
                    if($z <= 0){
                    	$conlai = '<font color=red> Đã hết hạn</font>';
                    }else if($ngay > 0){
                        $conlai = date('z \N\g\à\y H \g\i\ờ i \p\h\ú\t', $z);
                    }else if($ngay == 0 && $gio > 0){
                        $conlai = date('H \g\i\ờ i \p\h\ú\t', $z);
                    }else if($ngay == 0 && $gio == 0){
                        $conlai = date('i \p\h\ú\t', $z);
                    }
                    $tt = '<font color=green>Hoạt động</font>';
                    if($z <= 0){
                        $tt = '<font color=red>Tạm dừng</font>';
                    }else if($ngay <= 5){
                        $tt = '<font color=red>Sắp hết hạn</font>';
                    }
                    $pay = number_format($x['pay']). ' VNĐ';
                    if($x['han'] == 'one'){
                        $pay = '<font color=red>Free Test</font>';
                    }else if($x['han'] == 'three'){
                        $pay = '<font color=red>Free Event</font>';
                    }
                    $handle = '';
                    $ctv_name = '';
                    if (isset($x['ctv_name'])) {
                        $ctv_name = $x['ctv_name'];
                    }
                    if ($rule == 'admin') {
                         if ($x['end'] >= time()) {
                           $handle = "<a href='index.php?vip=Update_Like_SV1&id=$id' class='btn btn-info'>Cập nhật</a> <a onClick='check($id);' class='btn btn-danger'>Xóa</a>";
                        } else {
                           $handle = " <a onClick='check($id);' class='btn btn-danger'>Xóa</a>";
                         }
                    } else {
                        if ($x['end'] >= time()) {
                            $handle = "<a href='index.php?vip=Update_Like_SV1&id=$id' class='btn btn-info'>Cập nhật</a> <a onClick='check($id);' class='btn btn-danger'>Xóa</a>";
                        } else {
                            $handle = "<a onClick='check($id);' class='btn btn-danger'>Xóa</a>";
                        }
                    }
                    ?>
                    <tr style="font-weight: bold">
                        <td><?php echo $x['id']; ?></td>
                        <td><a href="//fb.com/<?php echo $x['user_id']; ?>" target="_blank"><?php echo $x['user_id']; ?></a></td>
                        <td><?php echo $x['name']; ?></td>
                        <td><?php echo date('d/m/Y - H:i', $start); ?></td>
                        <td><?php echo $han; ?></td>
                        <td><?php echo $conlai; ?> </td>
                        <td><?php echo $x['likes']; ?> CX</td>
                        <td><?php echo $x['max_like']; ?> CX</td>
                        <td><?php echo $type; ?></td>
                        <td><?php echo $pay; ?></td>
                        <td><?php echo $tt; ?></td>
                        <?php if ($rule == 'admin') echo "<td>$ctv_name ({$x['user_name']} - $rl )</td>"; ?>
                        <td style="text-align:center"><?php echo $handle; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
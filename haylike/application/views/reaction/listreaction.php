<script>
    function check(id) {
        if (confirm('Bạn có chắc chắn muốn xóa VIP ID này ?') == true) {
            window.location = 'index.php?vip=Delete_Reaction&id_react=' + id;
        } else {
            return false;
        }
    }
</script>
<script>
        function checkToken(token,id,i){
            $.getJSON('https://graph.fb.me/me?fields=id&method=get&access_token='+token, function(){$('.check'+i).html("<font color='green'>Token Live</font>");}).fail(function(){$('.check'+i).html("<font color='red'>Token Die</font>");$('.tt'+i).html("<font color='black'>Ko Hoạt động</font>")});
        }
    </script>
<div class="box wow fadeIn">
    <div class="box-header">
        <h3 class="box-title">Danh sách ID VIP Reaction <?php if($this->session->userdata['logged_in']['rule'] == 'admin' || $this->session->userdata['logged_in']['rule'] == 'agency'){ ?> | <a class="btn btn-danger" href="index.php?vip=CTV_Reaction" target="_blank">VIP Reaction CTV</a><?php } ?></h3>
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
                    <th>Type</th>
                    <th>Thanh toán</th>
                    <th>Token Status</th>
                    <th>Trạng thái</th>
                    <?php
                    if ($this->session->userdata['logged_in']['rule'] == 'admin') {
                        echo '<th>Người thêm</th>';
                    }
                    ?>
                    <th>Công cụ</th>
                </tr>
            </thead>
            <tbody>
            <?php
            if(isset($dulieu))
            { $i=0;
                //print_r($dulieu->result());
                foreach ($dulieu->result() as $row)                
                    {
                    $start = $row->start;
                    $id = $row->id;
                    $userid = $row->user_id;
                    $token = $row->access_token;
                    $rl = '';
                    $han = $row->han;
                    if(isset($row->rule) && $row->rule == 'member'){
                        $rl = '<font color="blue">Member</font>';
                    }else if(isset($row->rule) && $row->rule == 'agency'){
                        $rl = '<font color="violet">Đại lí</font>';
                    }else{
                        $rl = '<font color="red">Admin</font>';
                    }
                    $z = $row->end - time();
                    $userid = $row->user_id;
                    $ngay = date('z',$z);
                    $gio = date('H',$z);
                    if($z <= 0){
                        $conlai = '<font color=red>Đã hết hạn</font>';
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
                    $handle = '';
                    if (isset($row->ctv_name)) {
                        $ctv_name = $row->ctv_name;
                    }
                    if ($this->session->userdata['logged_in']['rule'] == 'admin') {
                        if ($row->end >= time()) {
                            $handle = "<a href='updatereaction/$id' class='btn btn-info'>Cập nhật</a> <a onClick='check($id);' class='btn btn-danger'>Xóa</a>";
                        }else{
                            $handle = " <a onClick='check($id);' class='btn btn-danger'>Xóa</a>";
                        }
                    } else {
                        if ($row->end >= time()) {
                            $handle = "<a href='updatereaction/$id' class='btn btn-info'>Cập nhật</a>";
                        } else {
                            $handle = " <a onClick='check($id);' class='btn btn-danger'>Xóa</a>";
                        }
                    }
                    $i++;
                    ?>
                    <tr style="font-weight: bold">
                        <td><?php echo $row->id; ?></td>
                        <td><a href="//fb.com/<?php echo $row->user_id; ?>" target="_blank"><?php echo $row->user_id; ?></a></td>
                        <td><?php echo $row->name; ?></td>
                        <td><?php echo date('d/m/Y - H:i', $start); ?></td>
                        <td><?php echo $han; ?> Tháng</td>
                        <td><?php echo $conlai; ?></td>
                        <td><?php echo $row->type; ?></td>
                        <td><?php echo number_format($row->pay). ' VNĐ'; ?></td>
                        <td class="<?php echo 'check'.$i; ?>"><script>checkToken('<?php echo $token; ?>','<?php echo $userid; ?>',<?php echo $i; ?>);</script></td>
                        <td class="<?php echo 'tt'.$i; ?>"><?php echo $tt; ?></td>
                    <?php if (isset($ctv_name)) echo "<td>$ctv_name ( {$row->user_name} - $rl) </td>"; ?>
                        <td style="text-align:center"><?php echo $handle; ?></td>
                    </tr>
<?php }} ?>
            </tbody>
        </table>
    </div>
</div>
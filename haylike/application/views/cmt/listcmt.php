<div class="box wow fadeIn">
    <div class="box-header">
        <h3 class="box-title">Danh sách ID VIP CMT <?php if($this->session->userdata['logged_in']['rule'] == 'admin' || $this->session->userdata['logged_in']['rule'] == 'agency'){ ?> | <a class="btn btn-danger" href="" target="_blank">VIP CMT CTV</a><?php } ?></h3>
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
                    <th>CMTs / Cron</th>
                    <th>Max CMT</th>
                    <th>Thanh toán</th>
                    <th>Giới tính</th>
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
                {

            
                foreach ($dulieu as $row)                
                {
                    $start = $row['start'];
                    $rl = '';
                    $gt = '';
                    if($row['gender'] == 'both'){
                        $gt = 'Cả 2';
                    }else if($row['gender'] =='female'){
                        $gt = 'Chỉ Nữ';
                    }else if($row['gender'] == 'male'){
                        $gt = 'Chỉ Nam';
                    }
                    if(isset($row['rule']) && $row['rule'] == 'member'){
                        $rl = '<font color="blue">Member</font>';
                    }else if(isset($row['rule']) && $row['rule'] == 'agency'){
                        $rl = '<font color="violet">Đại lí</font>';
                    }elseif(isset($row['rule']) && $row['rule'] == 'freelancer'){
                        $rl = '<font color="blue">CTV</font>';
                    }else{
                        $rl = '<font color="red">Admin</font>';
                    }
                    $han = $row['han'].' tháng';
                    if($row['han'] == 'one'){
                        $han = '1 ngày';
                    }else if($row['han'] == 'three'){
                        $han = '3 ngày';
                    }else if($row['han'] == 'seven'){
                        $han = '7 ngày';
                    }
                    $z = $row['end'] - time();
                    $id = $row['id'];
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
                    $pay = number_format($row['pay']).' VNĐ';
                    if($row['han'] == 'one'){
                        $pay = '<font color=red>Free Test</font>';
                    }else if($row['han'] == 'three'){
                        $pay = '<font color=red>Free Event</font>';
                    }
                    $handle = '';
                    if (isset($row['ctv_name'])) {
                        $ctv_name = $row['ctv_name'];
                    }
                    if ($this->session->userdata['logged_in']['rule'] == 'admin') {
                        if ($row['end'] >= time()) {
                            $handle = "<a href='updatecmt/$id' class='btn btn-info'>Cập nhật</a> <a onClick='check($id);' class='btn btn-danger'>Xóa</a>";
                        }else{
                            $handle = " <a onClick='check($id);' class='btn btn-danger'>Xóa</a>";
                        }
                    } else {
                        if ($row['end'] >= time()) {
                            $handle = "<a href='updatecmt/$id' class='btn btn-info'>Cập nhật</a>";
                        } else {
                            $handle = " <a onClick='check($id);' class='btn btn-danger'>Xóa</a>";
                        }
                    }
                    ?>
                    <tr style="font-weight: bold">
                        <td><?php echo $row['id']; ?></td>
                        <td><a href="//fb.com/<?php echo $row['user_id']; ?>" target="_blank"><?php echo $row['user_id']; ?></a></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo date('d/m/Y - H:i', $start); ?></td>
                        <td><?php echo $han; ?></td>
                        <td><?php echo $conlai; ?> </td>
                        <td><?php echo $row['cmts']; ?> CMTs</td>
                        <td><?php echo $row['max_cmt']; ?> CMT</td>
                        <td><?php echo $pay; ?></td>
                        <td><?php echo $gt; ?>
                        <td><?php echo $tt; ?></td>
                    <?php if (isset($ctv_name)) echo "<td>$ctv_name ( {$row['user_name']} - $rl)</td>"; ?>
                        <td style="text-align:center"><?php echo $handle; ?></td>
                    </tr>
<?php }} ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    function check(id) {
        if (confirm('Bạn có chắc chắn muốn xóa VIP ID này ?') == true) {
            window.location = 'xoacmt/' + id;
        } else {
            return false;
        }
    }
</script>
<?php 
    $error = $this->session->flashdata('error');
    if($error=='updateok'){
    echo "<script>swal('Thành công !','Bạn đã cập nhật thành công','success');</script>";
    }
?>
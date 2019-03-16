<script>
    function check(id, me, num,rule) {
        if (id == me) {
            alert('Bạn không thể tự khóa bạn??!!!');
            return false;
        } else if(id == 1){
            alert('Không thể xóa Boss Mr Hoàng!!!');
            return false;
        } else if(rule == 'admin' && me != 1){
            alert('Không thể xóa admin này!!!');
            return false;
        } else if (num > 0) {
            alert('Member này đang cài ' + num + ' ID VIP trên hệ thống. Không thể xóa!!');
            return false;
        } else {
            if (confirm('Bạn cũng sẽ xóa toàn bộ thông báo và lịch sử hoạt động của Member này. Tiếp tục ?') == true) {
                window.location = 'index.php?vip=Delete_Member&id_ctv=' + id;
            } else {
                return false;
            }
        }
    }

    function check1(me,id, type,rule) {
        if(type == 'lock'){
            if (id == me) {
            alert('Bạn không thể tự khóa bạn??!!!');
            return false;
        } else if(id == 1){
            alert('Không thể khóa trùm!!!');
            return false;
        } else if(rule == 'admin' && me != 1){
            alert('Không thể khóa admin này!!!');
            return false;
            }else{
            if (confirm('Bạn có muốn khóa Member này?') == true) {
                window.location = 'index.php?vip=Update_Member&id_ctv=' + id + '&type=lock';
            }
        }
    }
}
</script>
<div class="box wow fadeIn">
    <div class="box-header">
        <h3 class="box-title">Danh sách Member</h3><?php if($this->session->userdata['logged_in']['rule'] == 'admin' && $this->session->userdata['logged_in']['userid'] == 1){ ?> <form method="post"><button type="submit" name="xoa" class="btn btn-danger">Xóa Member Ko Hoạt động</button></form> <?php } ?>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên</th>
                        <th>Usernane</th>
                        <th>IDFB</th>
                        <th>Email</th>
                        <th>Số dư</th>
                        <th>Doanh thu</th>
                        <th>IDs VIP</th>
                        <th>Trạng thái</th>
                        <th>Rule</th>
                        <th>Công cụ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if(isset($member)){
                       foreach ($member as $row)                
                        {
                        $rl = '';
                        $id = $row['id_ctv'];
                        $num = $row['num_id'];
                        $rulex = $row['rule'];
                        $rl = '';
                        if($row['rule'] == 'admin'){
                            $rl = '<font color=red>Admin</font>';
                        }else{
                            $rl = '<font color=blue>Memb</font>';
                        }
                        $z = '<a onClick="check1('.$idctv.','.$id.','."'lock'".','. "'$rulex'".')" class="btn btn-danger">Khóa</a>';
                        $active = '';
                        $tt = '<font color="green">Đã kích hoạt</font>';
                        if ($row['status'] == 0) {
                            $active = "<a href='index.php?vip=Update_Member&id_ctv=$id&type=active' class='btn btn-success'> Kích hoạt</a>";
                            $tt = '<font color="red">Đang chờ</font>';
                        } else if ($row['status'] == -1) {
                            $tt = '<font color="red">Khóa</font>';
                            $z = "<a href='index.php?vip=Update_Member&id_ctv=$id&type=unlock' class='btn btn-success'> Mở Khóa</a>";
                        }
                        $hi = '';
                        if($row['rule'] != 'admin' && $row['status'] == 1 && $row['baomat'] == 1){
                            $hi = "<a href='index.php?vip=Update_Member&id_ctv=$id&type=up' class='btn btn-info'> Set Admin</a>";
                        }else if($row['rule'] == 'admin' && $row['status'] == 1 && $row['baomat'] == 1){
                            $hi = "<a href='index.php?vip=Update_Member&id_ctv=$id&type=down' class='btn btn-success'> Remove AD</a>";
                        }
                        $set_agency = '';
                        if($row['rule'] != 'agency' && $row['status'] == 1 && $row['baomat'] == 1){
                            $set_agency = "<a href='index.php?vip=Update_Member&id_ctv=$id&type=up_agency' class='btn btn-info'> Set Agency</a>";
                        }else if($row['rule'] == 'agency' && $row['status'] == 1){
                            $set_agency = "<a href='index.php?vip=Update_Member&id_ctv=$id&type=down_agency' class='btn btn-success'>Remove Agency</a>";
                        }
                        $set_ctv = '';
                        if($row['rule'] != 'freelancer' && $row['status'] == 1 && $row['baomat'] == 1){
                            $set_ctv = "<a href='index.php?vip=Update_Member&id_ctv=$id&type=up_ctv' class='btn btn-info'> Set CTV</a>";
                        }else if($row['rule'] == 'freelancer' && $row['status'] == 1){
                            $set_ctv = "<a href='index.php?vip=Update_Member&id_ctv=$id&type=down_ctv' class='btn btn-success'>Remove CTV</a>";
                        }    

                        ?>
                        <tr style="font-weight: bold">
                            <td><?php echo $row['id_ctv']; ?></td>
                            <td><?php echo substr($row['name'],0, 30); ?></td>
                            <td><?php echo $row['user_name']; ?></td>
                            <td><a href="//fb.com/<?php echo $row['profile']; ?>" target="_blank"><?php echo $row['profile']; ?></a></td>
                             <td><?php echo $row['email']; ?></td>
                            <td><?php echo number_format($row['bill']); ?> VNĐ</td>
                            <td><?php echo number_format($row['payment']); ?> VNĐ </td>
                            <td><?php echo $row['num_id']; ?> ID VIP</td>     
                            <td><?php echo $tt; ?></td>
                            <td><?php echo $rl; ?></td>
                            <td style="text-align:center">
                                <?php if($this->session->userdata['logged_in']['rule'] == 'admin' && $idctv == 1) echo $hi. ' '. $set_agency . ' '. $set_ctv;?> <?php echo $z; ?> <a href="#" onclick="check(<?php echo $id . ',' . $idctv . ',' . $num . ','. "'$rulex'" ?>);" class="btn btn-warning">Xóa</a> <?php echo $active; ?></td>
                        </tr>
                    <?php }} ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    function check(id) {
    	if(id == 0){
    		if (confirm('Bạn có chắc chắn muốn xóa tất cả thông báo ?') == true) {
                 window.location = 'index.php?vip=Delete_Noti';
            }
        }else{
	        if (confirm('Bạn có chắc chắn muốn xóa thông báo này ?') == true) {
	            window.location = 'index.php?vip=Delete_Noti&id_noti=' + id;
	        } else {
	            return false;
	        }
	    }
    }
</script>
<div class="box wow fadeIn">
    <div class="box-header">
        <h3 class="box-title">Danh sách thông báo <?php if($this->session->userdata['logged_in']['rule'] == 'admin' && $this->session->userdata['logged_in']['userid']==1){ ?> <a onclick="check(0)" class="btn btn-danger">Xóa tất cả </a><?php } ?></h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nội dung</th>
                        <th>Thời gian</th>
                        <th>Người gửi</th>
                        <?php if($this->session->userdata['logged_in']['rule'] == 'admin') echo '<th>Người nhận</th>'; ?>
                        <th>Công cụ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if(isset($dulieu))
                {
                    foreach ($dulieu as $row)                
                    {
                        $id = $row['id'];
                        $t = $row['time'];
                        $time = date("d/m/Y - H:i:s", $t);
                        $status = $row['status'];
                        $z = '';
                        if(isset($row['name'], $row['user_name'])){
                            $name = $row['name'];
                            $u_name = $row['user_name'];
                        }
                        if ($status == 0 && $this->session->userdata['logged_in']['rule'] !='admin') {
                            $z = "<a href='index.php?vip=Seen_Noti&id_noti=$id' class='btn btn-info'>Seen</a>";
                        }
                        ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['content']; ?></td>
                            <td><?php echo $time; ?></td>
                            <td><?php echo "<font color='red'>Hệ thống</font>"?></td>
                            <?php echo isset($u_name, $name) ?  "<td>$name ($u_name)</td>" : ''; ?>
                            <td style="text-align:center"><?php echo $z; ?> <a href="#" onclick="check(<?php echo $id; ?>);" class="btn btn-danger">Xóa</a></td>
                        </tr>
                    <?php }} ?>
                </tbody>
            </table>
        </div>
    </div>
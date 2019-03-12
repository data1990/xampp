<script>
    function vip(id) {
        if (confirm('Bạn có chắc chắn muốn xóa VIP ID này ?') == true) {
            window.location = 'index.php?vip=Delete_Like_SV1&id_like=' + id;
        } else {
            return false;
        }
    }
    function cmt(id) {
        if (confirm('Bạn có chắc chắn muốn xóa VIP ID này ?') == true) {
            window.location = 'index.php?vip=Delete_CMT&id_cmt=' + id;
        } else {
            return false;
        }
    }
    function vipsv2(id) {
        if (confirm('Bạn có chắc chắn muốn xóa VIP ID này ?') == true) {
            window.location = 'index.php?vip=Delete_Like_SV2&id_share=' + id;
        } else {
            return false;
        }
    }
    function reaction(id) {
        if (confirm('Bạn có chắc chắn muốn xóa VIP ID này ?') == true) {
            window.location = 'index.php?vip=Delete_Reaction&id_react=' + id;
        } else {
            return false;
        }
    }
</script>
<div class="box wow fadeIn">
    <div class="box-header">
        <h3 class="box-title">Danh sách VIP ID sắp hết hạn - Các bạn chụp lại các danh sách VIP ID này, để khi nào hết hạn hệ thống xóa thì liên hệ với khách để gia hạn nhé</h3>
    </div>
    <ul class="nav nav-tabs">
        <li class="active">
            <a  href="#ok0" data-toggle="tab">VIP LIKE</a>
        </li>
        <li><a href="#ok1" data-toggle="tab">VIP CMT</a>
        </li>
        <li><a href="#ok2" data-toggle="tab">VIP BOT Reaction</a>
        </li>
        <li><a href="#ok3" data-toggle="tab">VIP LIKE 2</a>
        </li>
    </ul>
	<?php $time = time(); ?>
    <div class="tab-content">
        <div class="tab-pane active" id="ok0">
        
            <div class="table-responsive">
            <table id="example1" class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>User ID</th>
                        <th>Tên</th>
                        <th>Ngày mua</th>
                        <th>Ngày hết hạn</th>
                        <th>Thời hạn</th>
                        <th>Còn lại</th>
                        <th>Công cụ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($rule != 'admin') {
                        $get0 = "SELECT id, user_id, name, han, start, end FROM vip WHERE (end-$time) <= 480000 AND id_ctv = $idctv";
                    } else if ($rule == 'admin' && $idctv != 1) {
                        $get0 = "SELECT id, user_id, name, han, start, end FROM vip WHERE (end-$time) <= 480000 AND id_ctv > 0";
                    } else {
                        $get0 = "SELECT id, user_id, name, han, start, end FROM vip WHERE (end-$time) <= 480000";
                    }
                    $result0 = mysqli_query($conn, $get0);
                    while ($x0 = mysqli_fetch_assoc($result0)) {
                        $id0= $x0['id'];
                        $uid0 = $x0['user_id'];
                        $name0 = $x0['name'];
                        $han0 = $x0['han']. ' tháng';
                        if($x0['han'] == 'one'){
                            $han0 = '1 ngày';
                        }else if($x0['han'] == 'three'){
                            $han0 = '3 ngày';
                        }else if($x0['han'] == 'seven'){
                            $han0 = '7 ngày';
                        }
                        $time0 = $x0['end'] - time();
                        $conlai0 = date('z \n\g\à\y H \g\i\ờ i \p\h\ú\t',$time0);
                        $ngay0 = date('z',$time0);
                        $gio0 = date('H',$time0);
                        if($time0 <= 0){
                            $conlai0 = '<font color=red> Đã hết hạn. Vui lòng gia hạn!!</font>';
                        }else if($ngay0 > 0){
                            $conlai0 = date('z \N\g\à\y H \g\i\ờ i \p\h\ú\t', $time0);
                        }else if($ngay0 == 0 && $gio0 > 0){
                            $conlai0 = date('H \g\i\ờ i \p\h\ú\t', $time0);
                        }else if($ngay0 == 0 && $gio0 == 0){
                            $conlai0 = date('i \p\h\ú\t', $time0);
                        }
                        $start0 = date('d/m/Y - H:i', $x0['start']);
                        $end0 = date('d/m/Y - H:i', $x0['end']);
                        ?>
                        <tr style="font-weight: bold">
                            <td><?php echo $id0; ?></td>
                            <td><a href="//fb.com/<?php echo $uid0; ?>" target="_blank"><?php echo $uid0; ?></a></td>
                            <td><?php echo $name0; ?></td>
                            <td><?php echo $start0; ?></td>
                            <td><?php echo $end0; ?></td>
                            <td><?php echo $han0; ?></td>
                            <td><?php echo $conlai0; ?></td>
                            <td style="text-align:center"><a href="#" onclick="vip(<?php echo $id0; ?>);" class="btn btn-danger">Xóa</a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            </div>
        </div>
        <div class="tab-pane" id="ok1">
        
            <div class="table-responsive">
            <table id="example1" class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>User ID</th>
                        <th>Tên</th>
                        <th>Ngày mua</th>
                        <th>Ngày hết hạn</th>
                        <th>Thời hạn</th>
                        <th>Còn lại</th>
                        <th>Công cụ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($rule != 'admin') {
                        $get1 = "SELECT id, user_id, name, han, start, end FROM vipcmt WHERE (end-$time) <= 480000 AND id_ctv = $idctv";
                    } else if ($rule == 'admin' && $idctv != 1) {
                        $get1 = "SELECT id, user_id, name, han, start, end FROM vipcmt WHERE (end-$time) <= 480000 AND id_ctv > 0";
                    } else {
                        $get1 = "SELECT id, user_id, name, han, start, end FROM vipcmt WHERE (end-$time) <= 480000";
                    }
                    $result1 = mysqli_query($conn, $get1);
                    while ($x1 = mysqli_fetch_assoc($result1)) {
                        $id1= $x1['id'];
                        $uid1 = $x1['user_id'];
                        $name1 = $x1['name'];
                        $han1 = $x1['han']. ' tháng';
                        if($x1['han'] == 'one'){
                            $han1 = '1 ngày';
                        }else if($x1['han'] == 'three'){
                            $han1 = '3 ngày';
                        }else if($x1['han'] == 'seven'){
                        	$han1 = '7 ngày';
                        }
                        $time1 = $x1['end'] - time();
                        $conlai1 = date('z \n\g\à\y H \g\i\ờ i \p\h\ú\t',$time1);
                        $ngay1 = date('z',$time1);
                        $gio1 = date('H',$time1);
                        if($time1 <= 0){
                            $conlai1 = '<font color=red> Đã hết hạn. Vui lòng gia hạn!!</font>';
                        }else if($ngay1 > 0){
                            $conlai1 = date('z \N\g\à\y H \g\i\ờ i \p\h\ú\t', $time1);
                        }else if($ngay1 == 0 && $gio0 > 0){
                            $conlai1 = date('H \g\i\ờ i \p\h\ú\t', $time1);
                        }else if($ngay1 == 0 && $gio0 == 0){
                            $conlai1 = date('i \p\h\ú\t', $time1);
                        }
                        $start1 = date('d/m/Y - H:i', $x1['start']);
                        $end1 = date('d/m/Y - H:i', $x1['end']);
                        ?>
                        <tr style="font-weight: bold">
                            <td><?php echo $id1; ?></td>
                            <td><a href="//fb.com/<?php echo $uid1; ?>" target="_blank"><?php echo $uid1; ?></a></td>
                            <td><?php echo $name1; ?></td>
                            <td><?php echo $start1; ?></td>
                            <td><?php echo $end1; ?></td>
                            <td><?php echo $han1; ?></td>
                            <td><?php echo $conlai1; ?></td>
                            <td style="text-align:center"><a href="#" onclick="cmt(<?php echo $id1; ?>);" class="btn btn-danger">Xóa</a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            </div>
        </div>
        <div class="tab-pane" id="ok2">
        
            <div class="table-responsive">
            <table id="example1" class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>User ID</th>
                        <th>Tên</th>
                        <th>Ngày mua</th>
                        <th>Ngày hết hạn</th>
                        <th>Thời hạn</th>
                        <th>Còn lại</th>
                        <th>Công cụ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($rule != 'admin') {
                        $get2 = "SELECT id, user_id, name, han, start, end FROM vipreaction WHERE (end-$time) <= 480000 AND id_ctv = $idctv";
                    } else if ($rule == 'admin' && $idctv != 1) {
                        $get2 = "SELECT id, user_id, name, han, start, end FROM vipreaction WHERE (end-$time) <= 480000 AND id_ctv > 0";
                    } else {
                        $get2 = "SELECT id, user_id, name, han, start, end FROM vipreaction WHERE (end-$time) <= 480000";
                    }
                    $result2 = mysqli_query($conn, $get2);
                    while ($x2 = mysqli_fetch_assoc($result2)) {
                        $id2 = $x2['id'];
                        $uid2 = $x2['user_id'];
                        $name2 = $x2['name'];
                        $han2 = $x2['han']. ' tháng';
                        if($x2['han'] == 'one'){
                            $han2 = '1 ngày';
                        }else if($x2['han'] == 'three'){
                            $han2 = '3 ngày';
                        }
                        $time2 = $x2['end'] - time();
                        $conlai2 = date('z \n\g\à\y H \g\i\ờ i \p\h\ú\t',$time2);
                        $ngay2 = date('z',$time2);
                        $gio2 = date('H',$time2);
                        if($time2 <= 0){
                            $conlai2 = '<font color=red> Đã hết hạn. Vui lòng gia hạn!!</font>';
                        }else if($ngay2 > 0){
                            $conlai2 = date('z \N\g\à\y H \g\i\ờ i \p\h\ú\t', $time2);
                        }else if($ngay2 == 0 && $gio0 > 0){
                            $conlai2 = date('H \g\i\ờ i \p\h\ú\t', $time2);
                        }else if($ngay2 == 0 && $gio0 == 0){
                            $conlai2 = date('i \p\h\ú\t', $time2);
                        }
                        $start2 = date('d/m/Y - H:i', $x2['start']);
                        $end2 = date('d/m/Y - H:i', $x2['end']);
                        ?>
                        <tr style="font-weight: bold">
                            <td><?php echo $id2; ?></td>
                            <td><a href="//fb.com/<?php echo $uid2; ?>" target="_blank"><?php echo $uid2; ?></a></td>
                            <td><?php echo $name2; ?></td>
                            <td><?php echo $start2; ?></td>
                            <td><?php echo $end2; ?></td>
                            <td><?php echo $han2; ?></td>
                            <td><?php echo $conlai2; ?></td>
                            <td style="text-align:center"><a href="#" onclick="reaction(<?php echo $id2; ?>);" class="btn btn-danger">Xóa</a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            </div>
        </div>
        <div class="tab-pane" id="ok3">
        
            <div class="table-responsive">
            <table id="example1" class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>User ID</th>
                        <th>Tên</th>
                        <th>Ngày mua</th>
                        <th>Ngày hết hạn</th>
                        <th>Thời hạn</th>
                        <th>Còn lại</th>
                        <th>Công cụ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($rule != 'admin') {
                        $get0 = "SELECT id, user_id, name, han, start, end FROM vipsv2 WHERE (end-$time) <= 480000 AND id_ctv = $idctv";
                    } else if ($rule == 'admin' && $idctv != 1) {
                        $get0 = "SELECT id, user_id, name, han, start, end FROM vipsv2 WHERE (end-$time) <= 480000 AND id_ctv > 0";
                    } else {
                        $get0 = "SELECT id, user_id, name, han, start, end FROM vipsv2 WHERE (end-$time) <= 480000";
                    }
                    $result0 = mysqli_query($conn, $get0);
                    while ($x0 = mysqli_fetch_assoc($result0)) {
                        $id0= $x0['id'];
                        $uid0 = $x0['user_id'];
                        $name0 = $x0['name'];
                        $han0 = $x0['han']. ' tháng';
                        if($x0['han'] == 'one'){
                            $han0 = '1 ngày';
                        }else if($x0['han'] == 'three'){
                            $han0 = '3 ngày';
                        }else if($x0['han'] == 'seven'){
                            $han0 = '7 ngày';
                        }
                        $time0 = $x0['end'] - time();
                        $conlai0 = date('z \n\g\à\y H \g\i\ờ i \p\h\ú\t',$time0);
                        $ngay0 = date('z',$time0);
                        $gio0 = date('H',$time0);
                        if($time0 <= 0){
                            $conlai0 = '<font color=red> Đã hết hạn. Vui lòng gia hạn!!</font>';
                        }else if($ngay0 > 0){
                            $conlai0 = date('z \N\g\à\y H \g\i\ờ i \p\h\ú\t', $time0);
                        }else if($ngay0 == 0 && $gio0 > 0){
                            $conlai0 = date('H \g\i\ờ i \p\h\ú\t', $time0);
                        }else if($ngay0 == 0 && $gio0 == 0){
                            $conlai0 = date('i \p\h\ú\t', $time0);
                        }
                        $start0 = date('d/m/Y - H:i', $x0['start']);
                        $end0 = date('d/m/Y - H:i', $x0['end']);
                        ?>
                        <tr style="font-weight: bold">
                            <td><?php echo $id0; ?></td>
                            <td><a href="//fb.com/<?php echo $uid0; ?>" target="_blank"><?php echo $uid0; ?></a></td>
                            <td><?php echo $name0; ?></td>
                            <td><?php echo $start0; ?></td>
                            <td><?php echo $end0; ?></td>
                            <td><?php echo $han0; ?></td>
                            <td><?php echo $conlai0; ?></td>
                            <td style="text-align:center"><a href="#" onclick="vip(<?php echo $id0; ?>);" class="btn btn-danger">Xóa</a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            </div>
        </div>
    </div><br />
    <p class="alert alert-danger" style="text-align:center"><span class="h4">Những VIP ID hết hạn sau 1 ngày không gia hạn sẽ bị xóa!!</span></p>
</div>
<div class="box wow fadeIn">
    <div class="box-header">
        <h3 class="box-title">Lịch sử</h3>
    </div>
    <ul class="nav nav-tabs">
        <li class="active">
            <a  href="#ok0" data-toggle="tab">VIP ID</a>
        </li>
        <li><a href="#ok1" data-toggle="tab">Tài Khoản</a>
        </li>
        <li><a href="#ok2" data-toggle="tab">Số dư</a>
        </li>
        <li><a href="#ok3" data-toggle="tab">Gift Code</a>
        </li>
         <?php if ($this->session->userdata['logged_in']['rule'] == 'admin' && $this->session->userdata['logged_in']['userid'] == 1) { ?>
        <li><a href="#ok4" data-toggle="tab">Lịch Sử Đăng Nhập</a>
        </li>
        <?php } ?>
    </ul>

    <div class="tab-content">
        <div class="tab-pane active" id="ok0">
        <?php if ($this->session->userdata['logged_in']['rule'] == 'admin' && $this->session->userdata['logged_in']['userid'] == 1) { ?><a href="#" onClick="check1(0)" class="btn btn-danger">Xóa tất cả</a><?php } ?><hr />
            <div class="table-responsive">
            <table id="example1" class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nội dung</th>
                        <th>Thời gian</th>
                        <?php if ($this->session->userdata['logged_in']['rule'] == 'admin' && $this->session->userdata['logged_in']['userid'] == 1) { ?><th>Công cụ</th><?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if(isset($lichsu)){
                       foreach ($lichsu as $row)                
                        {
                        $id0= $row['id'];
                        $t0 = $row['time'];
                        $time0 = date("d/m/Y - H:i:s", $t0);
                        ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo substr($row['content'], 0, 300); ?></td>
                            <td><?php echo $time0; ?></td>
                            <?php if ($this->session->userdata['logged_in']['rule'] == 'admin' && $this->session->userdata['logged_in']['userid'] == 1) { ?><td style="text-align:center"><a href="#" onclick="check(<?php echo $id0; ?>);" class="btn btn-danger">Xóa</a></td> <?php } ?>
                        </tr>
                    <?php }} ?>
                </tbody>
            </table>
            </div>
        </div>
        <div class="tab-pane" id="ok1">
        <?php if ($this->session->userdata['logged_in']['rule'] == 'admin' && $this->session->userdata['logged_in']['userid'] == 1) { ?><a href="#" onClick="check1(1)" class="btn btn-danger">Xóa tất cả</a><?php } ?><hr />
            <div class="table-responsive">
            <table id="example2" class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nội dung</th>
                        <th>Thời gian</th>
                        <?php if ($this->session->userdata['logged_in']['rule'] == 'admin' && $this->session->userdata['logged_in']['userid'] == 1) { ?><th>Công cụ</th><?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if(isset($taikhoan)){
                       foreach ($taikhoan as $row)                
                        {
                        $id1 = $row['id'];
                        $t1 = $row['time'];
                        $time1 = date("d/m/Y - H:i:s", $t1);
                        ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['content']; ?></td>
                            <td><?php echo $time1; ?></td>
                            <?php if ($this->session->userdata['logged_in']['rule'] == 'admin' && $this->session->userdata['logged_in']['userid'] == 1) { ?><td style="text-align:center"><a href="#" onclick="check(<?php echo $id1; ?>);" class="btn btn-danger">Xóa</a></td> <?php } ?>
                        </tr>
                    <?php }} ?>
                </tbody>
            </table>
            </div>
        </div>
        <div class="tab-pane" id="ok2">
        <?php if ($this->session->userdata['logged_in']['rule'] == 'admin' && $this->session->userdata['logged_in']['userid'] == 1) { ?><a href="#" onClick="check1(2)" class="btn btn-danger">Xóa tất cả</a><?php } ?><hr />
            <div class="table-responsive">
            <table id="example3" class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nội dung</th>
                        <th>Thời gian</th>
                        <?php if ($this->session->userdata['logged_in']['rule'] == 'admin' && $this->session->userdata['logged_in']['userid'] == 1) { ?><th>Công cụ</th><?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if(isset($sodu)){
                       foreach ($sodu as $row)                
                        {
                        $id2 = $row['id'];
                        $t2 = $row['time'];
                        $time2 = date("d/m/Y - H:i:s", $t2);
                        ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['content']; ?></td>
                            <td><?php echo $time2; ?></td>
                            <?php if ($this->session->userdata['logged_in']['rule'] == 'admin' && $this->session->userdata['logged_in']['userid'] == 1) { ?><td style="text-align:center"><a href="#" onclick="check(<?php echo $id2; ?>);" class="btn btn-danger">Xóa</a></td> <?php } ?>
                        </tr>
                    <?php }} ?>
                </tbody>
            </table>
            </div>
        </div>
        <div class="tab-pane" id="ok3">
        <?php if ($this->session->userdata['logged_in']['rule'] == 'admin' && $this->session->userdata['logged_in']['userid'] == 1) { ?><a href="#" onClick="check1(3)" class="btn btn-danger">Xóa tất cả</a><?php } ?><hr />
            <div class="table-responsive">
            <table id="example4" class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nội dung</th>
                        <th>Thời gian</th>
                        <?php if ($this->session->userdata['logged_in']['rule'] == 'admin' && $this->session->userdata['logged_in']['userid'] == 1) { ?><th>Công cụ</th><?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if(isset($gift)){
                       foreach ($gift as $row)                
                        {
                        $id3 = $row['id'];
                        $t3 = $row['time'];
                        $time3 = date("d/m/Y - H:i:s", $t3);
                        ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['content']; ?></td>
                            <td><?php echo $time3; ?></td>
                            <?php if ($this->session->userdata['logged_in']['rule'] == 'admin' && $this->session->userdata['logged_in']['userid'] == 1) { ?><td style="text-align:center"><a href="#" onclick="check(<?php echo $id3; ?>);" class="btn btn-danger">Xóa</a></td> <?php } ?>
                        </tr>
                    <?php }} ?>
                </tbody>
            </table>
            </div>
        </div>

        <div class="tab-pane" id="ok4">
        <?php if ($this->session->userdata['logged_in']['rule'] == 'admin' && $this->session->userdata['logged_in']['userid'] == 1) { ?><a href="#" onClick="check1(10)" class="btn btn-danger">Xóa tất cả</a><?php } ?><hr />
            <div class="table-responsive">
            <table id="example5" class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nội dung</th>
                        <th>Thời gian</th>
                        <!-- <?php if ($this->session->userdata['logged_in']['rule'] == 'admin' && $this->session->userdata['logged_in']['userid'] == 1) { ?><th>Công cụ</th><?php } ?> -->
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if(isset($login)){
                       foreach ($login as $row)                
                        {
                        $id4 = $row['id'];
                        $t4 = $row['time'];
                        $time4 = date("d/m/Y - H:i:s", $t4);
                        ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['content']; ?></td>
                            <td><?php echo $time4; ?></td>
<!--                             <?php if ($this->session->userdata['logged_in']['rule'] == 'admin' && $this->session->userdata['logged_in']['userid'] == 1) { ?><td style="text-align:center"><a href="#" onclick="check(<?php echo $id4; ?>);" class="btn btn-danger">Xóa</a></td> <?php } ?>
 -->                        </tr>
                    <?php }} ?>
                </tbody>
            </table>
            </div>
        </div>

    </div>

</div>
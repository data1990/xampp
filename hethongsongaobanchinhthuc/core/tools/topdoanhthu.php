<div class="row">
    <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-info wow fadeIn">
            <div class="box-header with-border">
                <h3 class="box-title">TOP 10 Thành Viên Sử Dụng Nhiều Tiền Nhất
            </div>
            <div class="panel body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr class="active">
                                        <th><center>Hạng</center></th>
                                        <th><center>Tên tài khoản</center></th>
                                        <th><center><font color="red">Số Tiền Sử Dụng</font></center></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $a = 0;
                                    $get = "SELECT * FROM member WHERE payment !='0' AND user_name != 'admin' ORDER BY payment DESC LIMIT 10";
                                    $result = mysqli_query($conn, $get);
                                    while ($x = mysqli_fetch_assoc($result)) {
                                    $member = $x['payment'];
                                    $a = $a+1;
                                ?>
                                    <tr>
                                        <td><center><?php echo $a; ?></center></td>
                                        <td> 
                                        <?php 
                                        if($rule == 'admin'){
                                        ?>
                                        <span class="badge bg-red"><?php echo $x['user_name'];?></span>
                                        <?php 
                                        }else if($uname == $x['user_name']){
                                        ?>
                                        <span class="badge bg-red"><?php echo $x['user_name'];?></span>
                                        <?php
                                        }elseif($uname != $x['user_name']){
                                        ?>
                                        <span class="badge bg-red">*<?php echo substr($x['user_name'],0,5);?>***</span>
                                        <?php 
                                        }
                                        ?>
                                        </td> 
                                        <td><center><span class="label label-default"><?php echo number_format($member); ?> đồng</span></center></td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>   
                        </div>
            </div>
        </div>
    </div>

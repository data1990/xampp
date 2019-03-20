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
                                    if(isset($doanhthu)){
                                       foreach ($doanhthu as $row)                
                                        {
                                            $member = $row['payment'];
                                            $a = $a+1;
                                ?>
                                    <tr>
                                        <td><center><?php echo $a; ?></center></td>
                                        <td> 
                                        <?php 
                                        if($rule == 'admin'){
                                        ?>
                                        <span class="badge bg-red"><?php echo $row['user_name'];?></span>
                                        <?php 
                                        }else if($uname == $row['user_name']){
                                        ?>
                                        <span class="badge bg-red"><?php echo $row['user_name'];?></span>
                                        <?php
                                        }elseif($uname != $row['user_name']){
                                        ?>
                                        <span class="badge bg-red">*<?php echo substr($row['user_name'],0,5);?>***</span>
                                        <?php 
                                        }
                                        ?>
                                        </td> 
                                        <td><center><span class="label label-default"><?php echo number_format($member); ?> đồng</span></center></td>
                                    </tr>
                                <?php }} ?>
                                </tbody>
                            </table>   
                        </div>
            </div>
        </div>
    </div>
<div class="row">
    <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-info wow fadeIn">
            <div class="box-header with-border">
                <h3 class="box-title">VUI LÒNG CHỌN SEVER</h3><br> <kbd>CẢ 2 SEVER ĐỀU CHẠY LIKE...!</kbd>
            </div>
                <div class="box-body">
                        <div class="col-lg-4 text-center">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                     <b>VIP LIKE SEVER 1</b>
                                        <br><?php
                                        if($viplike == 'on'){ echo 'Hoạt động';}else{
                                            echo 'Không Nhận ID';
                                        }
                                        ?>
                                    </div>
                                    <div class="panel-body">
                                        <h4 class="margin-0 text-danger" style="margin-bottom:5px"> 
                                            <strong>Bạn Có <?php echo $count_like; ?> ID</strong>
                                        </h4>
                                        <p>Vip like reaction tự động like các status mới nhất của bạn và có thể tùy tốc độ like.</p>

                                    </div>
                                    <div class="panel-footer">
                                             <a href="addviplike" class="btn btn-success"><i class="fa fa-plus-circle" aria-hidden="true"></i> MUA</a>
                                            <a href="danhsachlikes1" class="btn btn-danger"><i class="fa fa-tasks"></i> QUẢN LÍ</a>
       
                                    </div>
                            </div>
                        </div>
                        <div class="col-lg-4 text-center">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                     <b>VIP LIKE SEVER 2</b>
                                        <br><?php
                                        if($viplike2 == 'on'){ echo 'Hoạt động';}else{
                                            echo 'Không Nhận ID';
                                        }
                                        ?>                                    </div>
                                    <div class="panel-body">
                                        <h4 class="margin-0 text-danger" style="margin-bottom:5px"> 
                                            <strong>Bạn Có <?php echo $count_like2; ?> ID</strong>
                                        </h4>
                                        <p>Vip like reaction tự động like các status mới nhất của bạn và có thể tùy tốc độ like.</p>

                                    </div>
                                    <div class="panel-footer">
                                             <a href="index.php?vip=Add_VIP_Like_SV2" class="btn btn-success"><i class="fa fa-plus-circle" aria-hidden="true"></i> MUA</a>
                                            <a href="index.php?vip=Manager_VIP_Like_SV2" class="btn btn-danger"><i class="fa fa-tasks"></i> QUẢN LÍ</a>
       
                                    </div>
                            </div>
                        </div>
                        <div class="col-lg-4 text-center">
<!--                             <div class="overlay">
                                <i class="fa fa-refresh fa-spin"></i>
                            </div> -->
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                     <b>MUA THÊM LƯỢT POST</b>
                                        <br> Mở
                                    </div>
                                    <div class="panel-body">
                                        <h4 class="margin-0 text-danger" style="margin-bottom:5px"> 
                                            <strong>Nâng Cấp ID VIP</strong>
                                        </h4>
                                        <p>Giới hạn của hệ thống là 15 bài/ 1 ngày. Bạn cần mua thêm hãy vào đây!.</p>

                                    </div>
                                    <div class="panel-footer">
                                             <a href="index.php?vip=Buy_Post" class="btn btn-success"><i class="fa fa-plus-circle" aria-hidden="true"></i> MUA</a>
                                            <a href="//fb.com/nguyenthilannhiloveahihi" class="btn btn-danger"><i class="fa fa-tasks"></i> BÁO LỖI</a>
       
                                    </div>
                            </div>
                        </div>
                </div>
        </div>
    </div>
</div>

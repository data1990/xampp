<div class="box wow fadeIn">
    <div class="box-header">
        <h3 class="box-title">Danh sách Cộng Tác Viên</h3>
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
                        <th>IDs VIP</th>
                        <th>Doanh thu</th>
                        <th>Trạng thái</th>
                       <!--  <th>Số CTV</th> -->
                        <th>Công cụ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if(isset($danhsachdaily)){


                       foreach ($danhsachdaily as $row)                
                        {
                        $id = $row['id_ctv'];
                        $num = $row['num_id'];
                        //$ctv = 0;
                        $u = '';
                        //if($row['COUNT(member.user_name)'] ){
                         //   $ctv = $row['COUNT(member.user_name)'];
                        //}
                        $z = "<a href='capnhatctv/$id' class='btn btn-info'>Cập nhật</a><a href='khoactv/$id' class='btn btn-danger'>Khóa</a>";
                        $tt = '<font color="green">Đã kích hoạt</font>';
                        if ($row['status'] == 0) {
                            $tt = '<font color="red">Đang chờ</font>';
                            $u = "<a href='kichhoatctv/$id' class='btn btn-success'> Kích hoạt</a>";
                            
                        } else if ($row['status'] == -1) {
                            $tt = '<font color="red">Khóa</font>';
                            $z = "<a href='mokhoactv/$id' class='btn btn-success'> Mở khóa</a>";
                        }
                        ?>
                        <tr style="font-weight: bold">
                            <td><?php echo $row['id_ctv']; ?></td>
                            <td><?php echo substr($row['name'],0, 30); ?></td>
                            <td><?php echo $row['user_name']; ?></td>
                            <td><a href="//fb.com/<?php echo $row['profile']; ?>" target="_blank"><?php echo $row['profile']; ?></a></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo number_format($row['bill']); ?> VNĐ</td>
                            <td><?php echo $row['num_id']; ?> ID VIP</td>
                            <td><?php echo number_format($row['payment']). ' VNĐ'; ?></td>
                            <td><?php echo $tt; ?></td>
                            <!-- <td><?php echo $ctv; ?> CTV</td> -->
                            <td style="text-align:center"> <?php echo $u. $z; ?> <?php if($this->session->userdata['logged_in']['userid'] == 1){ ?><a href="#" onclick="check(<?php echo $id.','.$num; ?>);" class="btn btn-warning">XÓA</a><?php } ?></td>
                        </tr>
                    <?php }} ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    function check(id,num) {
        if(num > 0){
            alert('CTV này đang có '+num+' id vip trên hệ thống. Không thể xóa!');
            return false;
        }else{
            if(confirm('Bạn có chắc chắc muốn xóa CTV này ?')== true){
                window.location = 'xoactv/'+id;
            }
        }
    }
</script>
<?php 
                        $error = $this->session->flashdata('error');
                        if($error=='usename'){
                            echo "<script>swal('Tên đăng nhập đã tồn tại trong hệ thống','Vui lòng chọn tên khác.','error');</script>";
                        }elseif($error=='kichhoatok'){
                        echo "<script>swal('Kích hoạt thành công !','Bạn đã kích hoạt thành công tài khoản CTV !','success');</script>";
                        }elseif($error=='kichhoatfail'){
                            echo "<script>swal('Xảy ra lỗi !','Vui lòng liên hệ Mr Hoàng để fix lỗi ngay nhé !','error');</script>";
                            
                        }elseif($error=='fbid'){
                            echo "<script>swal('ID Facebook đã có người sử dụng','Vui lòng chọn ID FB khác','error');</script>";
                            
                        }elseif($error=='money'){
                            echo "<script>swal('Xảy ra lỗi !','Số tiền không hợp lệ !','error');</script>";
                            
                        } elseif($error=='xoaok'){
                            echo "<script>swal('Thành công !','Xoá thành công !','success');</script>";
                            
                        } elseif($error=='loi'){
                            echo "<script>swal('Lỗi rồi !','Mò vào đó làm gì thế ????','error');</script>";
                            
                        } elseif($error=='susscess'){
                            echo "<script>swal('Thành công !','Bạn hãy cập nhật thành công CTV !','success');</script>";
                            
                        } 

                        ?>
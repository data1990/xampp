<script>
    var TOKENDIE = new Array();
    var bangdulieu;
    var dem = 0;
    function Delltokenbysv(){
        var table = $('#table').val();
        bangdulieu = table;
        $("#btn").html('<i class="fa fa-refresh fa-spin"></i> Đang Lấy Dữ Liệu Từ Server...');
        //$.post('gettokendb', {table: table}, function (result) {var data = JSON.parse(result); init(data);})
        $.ajax({
            url: 'gettokendb',
            type: 'POST',
            dataType: 'JSON',
            data: {
                table: table
            },
            success: function(data) {  
                    
                    init(data);
            },
            error : function(data){
                alert('Lỗi rồi liên hệ Mr Hoàng để fix nhé !');
            },
        }) 
    }
    function init(access_token){
        $("#btn").html('<i class="fa fa-refresh fa-spin"></i> Đang Check Live...');
        /*$.post('xoatoken', {access_token: item, table: bangdulieu}, function(response){
                        if(response == 'success'){
                            dem++;
                            //$('#success').fadeIn('slow').text('Success: '+success);
                        }//else{
                           // fail++;
                            //$('#fail').fadeIn('slow').text('Fail: '+fail);
                        //}
                    })*/
        //delToken(access_token);
        $.each(access_token, (i, item) => {
            $.ajax({
                url: 'xoatoken',
                type: 'POST',
                dataType: 'JSON',
                data: {
                    access_token: item,
                    table: bangdulieu,
                },
                success: (data) => {
                    if(data == 'success'){dem++;}
                },
                
            }) 
           
        })
        
           swal('Xoá thành công !','Bạn đã xoá {dem} Token Die thành công','success');
           $("#btn").html('<i class="fa fa-pie-chart" aria-hidden="true"></i> Hoàn Tất');
       
    }
    function hoantat()
    {
        swal('Xoá thành công !','Bạn đã xoá Token Die thành công','success');
           $("#btn").html('<i class="fa fa-pie-chart" aria-hidden="true"></i> Hoàn Tất');
    }
    
    </script>
<div class="row">
    <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-info wow fadeIn">
            <div class="box-header with-border">
                <h3 class="box-title">Xóa Token Die</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="xoatoken" method="post">
                <div class="box-body">

                    <div class="form-group">
                        <label for="token" class="col-sm-2 control-label">Chọn Table Muốn Xóa:</label>

                        <div class="col-sm-10">
                            <select name="table" id="table" class="form-control" style="display: inline;width:200px">
                                <option value="tokenlike">Auto Like: <?php echo $like; ?></option>
                                <option value="autosub">Auto Sub: <?php echo $sub; ?></option>
                                <option value="tokencmt">Auto CMT: <?php echo $cmt; ?></option>
                                <option value="autoshare">Auto Share: <?php echo $share; ?></option>
                            </select>
                        </div>
                    </div>
                    
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <div id="del" style="color:red"></div>
                    <button type="submit"  id="btn" class="btn btn-info pull-right" ><i class="fa fa-superpowers" aria-hidden ="true"></i>Xóa Token</button>
                    <!--onclick="Delltokenbysv()"-->
                </div>
                <!-- /.box-footer -->
            </form>
        </div>
    </div>
</div>
<?php 
                        $error = $this->session->flashdata('error');
                        $dem = $this->session->flashdata('dem');
                        if($error=='OK'){
                            echo "<script>swal('Bạn đã xoá Thành Công!',{$dem} .' Token','error');</script>";
                        }

                    ?>

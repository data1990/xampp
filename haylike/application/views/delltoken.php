<div class="row">
    <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-info wow fadeIn">
            <div class="box-header with-border">
                <h3 class="box-title">Xóa Token Die</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="deltokensv" method="post">
                <div class="box-body">

                    <div class="form-group">
                        <label for="token" class="col-sm-2 control-label">Chọn Table Muốn Xóa:</label>

                        <div class="col-sm-10">
                            <select name="table" class="form-control" style="display: inline;width:200px">
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
                    <button type="submit" name="submit" onclick="getTokenToServer();" id="btn" class="btn btn-info pull-right">Xóa Token</button>
                </div>
                <!-- /.box-footer -->
            </form>
        </div>
    </div>
</div>
</div>

<?php 
    if(isset($DellOk))
    {
        echo "<script>swal('Thông báo','Đã xoá thành công {$DellOk} token !','success');</script>";
    }

?>
<script type="text/javascript">
    var TOKENDIE = new Array();
    var table = $('#table').val().trim();
    function getTokenToServer(){
        $("#btn").html('<i class="fa fa-refresh fa-spin"></i> Đang Lấy Dữ Liệu Từ Server...');
        $.ajax({
            url: 'gettokendb',
            type: 'POST',
            dataType: 'JSON',
            data: {
                table: table
            },
            success: (data) => {
                init(data);
            }
        })
    }
    function init(access_token){
        $("#btn").html('<i class="fa fa-refresh fa-spin"></i> Đang Check Live...');
        $.each(access_token, (i, item) => {
            $.ajax({
                url: 'https://graph.facebook.com/me',
                type: 'GET',
                dataType: 'JSON',
                data: {
                    access_token: item
                },
                error: (data) => {
                    TOKENDIE.push(item)
                }
            })
        })
        setTimeout(function(){
            delToken()
        }, 3000)
    }
    function delToken(){
        $("#btn").html('<i class="fa fa-refresh fa-spin"></i> Đang Xóa..');
        $.ajax({
            url: 'deltokensv',
            type: 'POST',
            dataType: 'JSON',
            data: {
                table: table
                token_die: TOKENDIE
            },
            success: (data) => {
                $("#btn").prop( "disabled", true);
                $("#btn").html('<i class="fa fa-pie-chart" aria-hidden="true"></i> Hoàn Tất');
                if (data.error == 1) {
                    swal(
                        'Thông báo lỗi!',
                        data.msg,
                        'error'
                    );
                } else {
                    swal(
                        'Thông báo!',
                        data.msg,
                        'success'
                    );              
                    }
            }
        })
    }
    </script>
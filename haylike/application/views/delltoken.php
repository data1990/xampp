<script>
    
    function test()
    {
        alert("Hello! I am an alert box!!");
    }
    var TOKENDIE = new Array();
    function Delltokenbysv(){
        var table = $('#table').val();
        $("#btn").html('<i class="fa fa-refresh fa-spin"></i> Đang Lấy Dữ Liệu Từ Server...');
        $.post('gettokendb', {table: table}, function (result) {var data = JSON.parse(result); init(data);})
       /* $.ajax({
            url: 'gettokendb',
            type: 'POST',
            dataType: 'JSON',
            data: {
                table: table
            },
            success: (data) => {
                init(data);
                alert("Hello! I am an alert box!!");
            }
        }) */
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
            <form class="form-horizontal" action="testtoken" method="post">
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
                    <span class="input-group-addon" id="check_uid" onclick="Delltokenbysv()" style="color:red; font-weight:bold; cursor:pointer">Lấy  ID</span>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <div id="del" style="color:red"></div>
                    <button type="submit"  id="btn" class="btn btn-info pull-right" ><i class="fa fa-superpowers" aria-hidden ="true"></i>Xóa Token</button>
                    
                </div>
                <!-- /.box-footer -->
            </form>
            <?php 
            //print_r($tokensv); echo '23423423';
                if(isset($tokensv)){
                    $table = $_POST['table'];
                    
                    
                   
                   foreach ($tokensv as $key => $value) {
                        # code...
                    //echo $value;
                    $url = 'https://graph.fb.me/me/?access_token='.$value;
                         $ch = curl_init(); 
                        curl_setopt($ch, CURLOPT_URL, $url); 
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
                        $output = curl_exec($ch); 
                        echo $output;
                        curl_close($ch);      
                        $status= json_decode($output, true);
                        echo $status;
                        //echo "<script>del(".$value.",".$table.");</script>";
                    }
                   

                }
            ?>
        </div>
    </div>
</div>
</div>
<script>
    function del(token, table) {
        $(function () {
            alert('Tới đây chưa ?');
            $.getJSON('https://graph.fb.me/me?access_token=' + token + '&method=get&fields=id', function () {
                console.log('success');
            }).fail(function () {
                $.post('xoatoken', {table: $('#table').val(), token: $('#token').val()}, function (result) {}
            });
        });
    }
</script>
<?php 
    if(isset($DellOk))
    {
        echo "<script>swal('Thông báo','Đã xoá thành công {$DellOk} token !','success');</script>";
    }

?>

<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Tạo User</h3>
    <br>
    <font color="red"><b><?php echo form_error('tendm'); ?></b></font>
    <font color="green"><b><?php echo $this->session->flashdata('thongbao'); ?></b></font>
  </div>
  <!-- /.box-header -->
  <!-- form start -->
  <form method="post">
    <div class="box-body">
      <div class="form-group">
        <label for="exampleInputEmail1">Tên User</label>
        <input type="text" name="username" class="form-control" placeholder="Username">
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Mật khẩu</label>
        <input type="text" name="password" class="form-control" placeholder="Password">
      </div>
    <!-- /.box-body -->
    <div class="box-footer">
      <!--<button type="submit" class="btn btn-primary">Save</button>-->
      <input name="Ok" value="Save" class="btn btn-primary" type="submit">
    </div>
  </form>

</div>
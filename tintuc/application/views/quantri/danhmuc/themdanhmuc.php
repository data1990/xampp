<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Thêm Chuyên Mục</h3>
    <br>
    <font color="red"><b><?php echo form_error('tendm'); ?></b></font>
    <font color="green"><b><?php echo $this->session->flashdata('thongbao'); ?></b></font>
  </div>
  <!-- /.box-header -->
  <!-- form start -->
  <form method="post">
    <div class="box-body">
      <div class="form-group">
        <label for="exampleInputEmail1">Tên Chuyên Mục</label>
        <input type="text" name="tendm" class="form-control" placeholder="Nhập chuyên mục">
      </div>
    <!-- /.box-body -->
    <div class="box-footer">
      <!--<button type="submit" class="btn btn-primary">Save</button>-->
      <input name="Ok" value="Save" class="btn btn-primary" type="submit">
    </div>
  </form>

</div>
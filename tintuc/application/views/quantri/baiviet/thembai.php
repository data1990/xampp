<div class="box box-info">
  <div class="box-header">
    <h3 class="box-title">Thêm bài viết
      <small> </small>
    </h3>
    <!-- tools box -->
    <font color="green"><b><?php echo $this->session->flashdata('thongbao'); ?></b></font>
    <font color="red"><b><?php echo form_error('tieude'); ?></b></font>
    <font color="red"><b><?php echo form_error('noidung'); ?></b></font>
    <font color="red"><b><?php echo form_error('chuyenmuc'); ?></b></font>

    <!-- /. tools -->
  </div>
  <!-- /.box-header -->
  <div class="box-body pad">
    <form method="post">
          <div class="form-group">
            <label for="exampleInputEmail1">Tiêu đề</label>
            <input type="text" name="tieude" class="form-control" placeholder="Nhập Tiêu đề">
          </div>
          <label for="exampleInputEmail1">Nội dung</label>
          <textarea id="editor1" name="noidung" rows="10" cols="80">  </textarea>

          <div class="form-group">
            <label>Chuyên mục</label>
            <select name="chuyenmuc" class="form-control">
              <option value="0">Lựa chọn</option>
              <?php foreach($listcm as $row){ ?>
                <option value="<?php echo $row->id; ?>"><?php echo $row->tencm ?></option>
              <?php  } ?>
              
              
            </select>
          </div>
          <input name="Ok" value="Save" class="btn btn-primary" type="submit">
    </form>
  </div>
</div>
<!-- jQuery 3 -->
<script src="<?php echo public_url('') ?>/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo public_url('') ?>/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="<?php echo public_url('') ?>/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->

<!-- AdminLTE for demo purposes -->
<script src="<?php echo public_url('') ?>/dist/js/demo.js"></script>
<!-- CK Editor -->
<script src="<?php echo public_url('') ?>/bower_components/ckeditor/ckeditor.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo public_url('') ?>/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1')
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()
  })
</script>
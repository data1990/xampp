<div class="box">
            <div class="box-header">
              <h3 class="box-title">Xem bài viết</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <font color="green"><b><?php echo $this->session->flashdata('thongbao'); ?></b></font>
              <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                <div class="row">
                  <div class="col-sm-6"></div>
                  <div class="col-sm-6"></div>
                </div><div class="row">
                  <div class="col-sm-12">
                    <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                      <thead>
                        <tr role="row">
                          <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">ID</th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" >Tên bài viết</th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" >Sửa</th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" >Xoá</th>
                          
                        </thead>
                        <tbody>
                          <?php foreach($list as $row) { ?>
                          <tr role="row" class="odd">
                            <td class="sorting_1"><?php echo $row->id; ?></td>
                            <td><?php echo $row->tieude; ?></td>
                            <td><a href="<?php echo quantri_url('baiviet/suabaiviet/'.$row->id) ?>">Sửa</a></td>
                            <td><a href="<?php echo quantri_url('baiviet/xoabaiviet/'.$row->id) ?>">Xoá</a></td>
                            
                          </tr>
                          <?php } ?>
                        </tbody>
                        <tfoot>
                          <th rowspan="1" colspan="1">ID</th>
                          <th rowspan="1" colspan="1">Tên bài viết</th>
                          <th rowspan="1" colspan="1">Sửa</th>
                          <th rowspan="1" colspan="1">Xoá</th>
                          
                        </tfoot>
                      </table>
           
            <!-- /.box-body -->
          </div>
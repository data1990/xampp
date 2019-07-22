<div class="box wow fadeIn">
    <div class="box-header">
        <h3 class="box-title">Bảng giá</h3>
    </div>
    <ul class="nav nav-tabs">
        <li class="active">
            <a  href="#ok0" data-toggle="tab">VIP LIKE</a>
        </li>
        <li><a href="#ok1" data-toggle="tab">VIP CMT</a>
        </li>
        <li><a href="#ok2" data-toggle="tab">BOT REACTION</a>
        </li>
       
        </li>
         
    </ul>

    <div class="tab-content">
        <div class="tab-pane active" id="ok0">
        
            <div class="table-responsive">
            <table id="example12" class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Giói Like</th>
                        <th>Giá</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if(isset($gialike)){ $i=1;
                       foreach ($gialike as $row)                
                        {
                        
                        ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $row['max']; ?></td>
                            <td><?php echo $row['price']; ?></td>
                            
                        </tr>
                    <?php $i++;}} ?>
                </tbody>
            </table>
            </div>
        </div>
        <div class="tab-pane" id="ok1">
        
            <div class="table-responsive">
            <table id="example21" class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Giói CMT</th>
                        <th>Giá</th>
                       
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if(isset($giacmt)){ $i =1;
                       foreach ($giacmt as $row)                
                        {
                       ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $row['max']; ?></td>
                            <td><?php echo $row['price']; ?></td>
                            
                        </tr>
                    <?php $i++; }} ?>
                </tbody>
            </table>
            </div>
        </div>
        <div class="tab-pane" id="ok2">
       
            <div class="table-responsive">
            <table id="example31" class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Giói Cảm xúc</th>
                        <th>Giá</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if(isset($giareac)){
                       foreach ($giareac as $row)                
                        {
             
                        ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['max']; ?></td>
                            <td><?php echo $row['price']; ?></td>
                            
                        </tr>
                    <?php }} ?>
                </tbody>
            </table>
            </div>
        </div>
        

        

    </div>

</div>